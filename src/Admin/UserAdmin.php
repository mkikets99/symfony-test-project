<?php

namespace App\Admin;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class UserAdmin extends AbstractAdmin
{
  protected function configureFormFields(FormMapper $formMapper): void
  {
    $formMapper
      ->add('email', EmailType::class, ['label' => 'Email'])
      ->add('password', RepeatedType::class, [
        'type' => PasswordType::class,
        'invalid_message' => 'The password fields must match.',
        'required' => true,
        'first_options' => ['label' => 'Password'],
        'second_options' => ['label' => 'Repeat Password'],
      ])
      ->add('name', TextType::class, ['required' => false])
      ->add('birth_date', DateType::class, [
        'required' => false, 'years' => range(1920, 2013),
        'widget' => 'single_text'
      ])
      ->add('isAdmin', null, ['required' => false]);
  }

  protected function configureShowFields(ShowMapper $showMapper): void
  {
    $showMapper
      ->add('email')
      ->add('ip_address')
      ->add('name')
      ->add('blocked')
      ->add('isAdmin')
      ->add('browserINFO')
      ->add('lastAction');
  }

  protected function configureListFields(ListMapper $listMapper): void
  {
    $listMapper
      ->addIdentifier('id')
      ->add('email')
      ->add('ip_address')
      ->add('name')
      ->add('birth_date')
      ->add('blocked')
      ->add('isAdmin')
      ->add('browserINFO')
      ->add('lastAction');
  }


  public function toString(object $object): string
  {
    return $object instanceof User ? $object->getEmail() : 'User'; // change getEmail() to any other field you want to use for the string representation of your User entity
  }
}
