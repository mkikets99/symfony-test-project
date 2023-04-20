<?php

namespace App\Admin;

use App\Entity\Record;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class RecordAdmin extends AbstractAdmin
{
  protected function configureFormFields(FormMapper $formMapper): void
  {
    $formMapper
      ->add('title')
      ->add('description')
      ->add('published')
      ->add('recordPhotos', null, [
        'associated_property' => 'photoName'
      ])
      ->add('recordTexts', null, [
        'associated_property' => 'bodyHTML'
      ]);
  }

  protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
  {
    $datagridMapper
      ->add('title')
      ->add('published');
  }

  protected function configureListFields(ListMapper $listMapper): void
  {
    $listMapper
      ->addIdentifier('title')
      ->add('description')
      ->add('published')
      ->add('recordPhotos', null, [
        'associated_property' => 'photoName'
      ])
      ->add('recordTexts', null, [
        'associated_property' => 'bodyHTML'
      ]);
  }
}
