<?php

namespace App\Form;

use App\ValueObject\ContactForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('name', TextType::class, ['constraints' => [
                new NotBlank(message: 'Please enter your name.'),],])
            ->add('email', EmailType::class, ['constraints' => [
                new NotBlank(message :'Please enter your email address.')],
            ])
            ->add('subject', TextType::class, [
                'constraints' => [
                    new NotBlank(message: 'Please enter a subject.'),
                ],
            ])
            ->add('message', TextareaType::class, ['constraints' => [
                new NotBlank(message: 'Please enter your message.'),],]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactForm::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'contact_form',
            'csrf_cookie' => false, // Disable double-submit cookie
        ]);
    }
}
