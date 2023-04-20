<?php

namespace App\Security;

use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Security\Handler\SecurityHandlerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class AdminSecurity implements SecurityHandlerInterface
{
  private $authorizationChecker;

  public function __construct(AuthorizationCheckerInterface $authorizationChecker)
  {
    $this->authorizationChecker = $authorizationChecker;
  }

  public function isGranted(AdminInterface $admin, $attributes, $object = null): bool
  {
    if (!$this->authorizationChecker->isGranted('ROLE_ADMIN')) {
      return false;
    }

    if ($object && $object->isIsAdmin()) {
      return true;
    }

    return false;
  }

  public function createObjectSecurity(AdminInterface $admin, object $object): void
  {
    // Check if the user has the isAdmin property set to true
    if ($object->isIsAdmin()) {
      $this->authorizationChecker->isGranted('ROLE_ADMIN');
    }
  }

  public function deleteObjectSecurity(AdminInterface $admin, object $object): void
  {
    // Check if the user has the isAdmin property set to true
    if ($object->isIsAdmin()) {
      $this->authorizationChecker->isGranted('ROLE_ADMIN');
    }
  }

  public function getBaseRole(AdminInterface $admin): string
  {
    return 'ROLE_ADMIN';
  }

  public function buildSecurityInformation(AdminInterface $admin): array
  {
    return [];
  }
}
