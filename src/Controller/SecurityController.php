<?php
// create an class of AbstractController for symfony called same as this file name

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{


  #[Route('/login', name: 'login', methods: ['GET', 'POST'])]
  public function login(Request $request, AuthenticationUtils $authenticationUtils, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
  {
    $error = $authenticationUtils->getLastAuthenticationError();

    $lastUsername = $authenticationUtils->getLastUsername();

    $form = $this->createForm(LoginForm::class);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $email = $form->get("email")->getData();
      $password = $form->get("password")->getData();
      $user = $entityManager->getRepository(User::class)->findOneBy(["email" => $email]);
      $passwordHasher->isPasswordValid($user, $password);

      return $this->redirectToRoute('homepage');
    }
    return $this->render('pages/login.html.twig', array(
      'form' => $form->createView(),
      'last_username' => $lastUsername,
      'error' => $error,
    ));
  }

  #[Route('/signup', name: 'signup')]
  public function signup()
  {
    return $this->render('pages/signup.html.twig');
  }
}
