<?php

namespace App\Controller;

use App\Form\ContactFormType;
use App\Service\EmailSender;
use App\ValueObject\ContactForm;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;


final class ContactUsController extends AbstractController
{
    #[Route('/contact-us', name: 'app_contact_us', methods: ['GET', 'POST'])]
    public function index(Request $request, EmailSender $emailSender, LoggerInterface $logger): Response
    {
        $form = $this->createForm(ContactFormType::class, new ContactForm());
        $form->handleRequest($request);

        $successMessage = null;

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var ContactForm $contactForm */
            $contactForm = $form->getData();

            try {
                $emailSender->sendContactUsForm($contactForm);;
                $successMessage = 'Thank you for contacting us! We will get back to you shortly.';
                $logger->info('Contact form submitted successfully.', [
                    'email' => $contactForm->email,
                    'subject' => $contactForm->subject,

                ]);
                $logger->info('Email sent via DSN: ' . $_ENV['MAILER_DSN']);
            } catch (TransportExceptionInterface $e) {
                $form->addError(new FormError('There was an error sending your message. Please try again later.'));
                $logger->error('Email sending failed: ' . $e->getMessage());
            }


        }
        return $this->render('widget/contact_us.html.twig', [
            'form' => $form->createView(),
            'successMessage' => $successMessage,
        ]);
    }
}
