<?php

namespace App\Service;

use App\ValueObject\ContactForm;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class EmailSender
{
    private MailerInterface $mailer;


    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;

    }

    /**
     * @param ContactForm $contactForm
     * @throws TransportExceptionInterface
     */
    public function sendContactUsForm(ContactForm $contactForm): void
    {
        $email = (new TemplatedEmail())
            ->to('example@gmail.ocm') // Replace with your email address
            ->from($contactForm->email)
            ->subject($contactForm->subject)
            ->HtmlTemplate('emails/contact_us.html.twig')
            ->context([
                'name' => $contactForm->name,
                'fromEmail' => $contactForm->email,
                'subject' => $contactForm->subject,
                'message' => $contactForm->message,
            ]);
        $this->mailer->send($email);
    }
}
