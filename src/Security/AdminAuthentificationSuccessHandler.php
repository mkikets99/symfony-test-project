<?php
// src/Security/AdminAuthenticationSuccessHandler.php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

class AdminAuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
  private $router;

  public function __construct(RouterInterface $router)
  {
    $this->router = $router;
  }

  public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
  {
    $user = $token->getUser();

    if ($user->isAdmin()) {
      $url = $this->router->generate('sonata_admin_dashboard'); // Replace with your Sonata Admin dashboard route
      return new RedirectResponse($url);
    }

    // If user is not an admin, redirect to the default target path
    return new RedirectResponse($this->router->generate('default_target_path'));
  }
}
