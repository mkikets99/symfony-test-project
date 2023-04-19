<?php

namespace App\Types;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationForm extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('email', EmailType::class, [
        'attr' => ['class' => 'form-control'],
        'label' => 'Email',
      ])
      ->add('name', TextType::class, [
        'attr' => ['class' => 'form-control'],
        'label' => 'Name',
      ])
      ->add('birthdate', BirthdayType::class, [
        'attr' => ['class' => 'form-control'],
        'label' => 'Birthdate',
      ])
      ->add('plainPassword', RepeatedType::class, [
        'type' => PasswordType::class,
        'invalid_message' => 'The password fields must match.',
        'options' => ['attr' => ['class' => 'form-control']],
        'required' => true,
        'first_options' => ['label' => 'Password'],
        'second_options' => ['label' => 'Repeat Password'],
      ])
      ->add('register', SubmitType::class, [
        'attr' => ['class' => 'btn btn-primary'],
        'label' => 'Register',
      ]);
  }
}
