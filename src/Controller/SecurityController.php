<?php
// create an class of AbstractController for symfony called same as this file name

namespace App\Controller;

use App\Entity\Session;
use Doctrine\ORM\EntityManagerInterface;
use Marvin255\RandomStringGenerator\Generator\RandomStringGenerator;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Entity\User;
use App\Types\LoginForm;

class SecurityController extends AbstractController
{



  #[Route('/login', name: 'login', methods: ['GET', 'POST'])]
  public function login(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, RandomStringGenerator $randomStringGenerator, LoggerInterface $logger)
  {
    $request->getSession()->start();
    $error = array();

    $form = $this->createForm(LoginForm::class);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $email = $form->get("email")->getData();
      $password = $form->get("password")->getData();
      $user = $entityManager->getRepository(User::class)->findOneBy(["email" => $email]);
      $logger->info("User $email is trying to login");
      $logger->info("User $email is trying to login with password $password");
      if ($passwordHasher->isPasswordValid($user, $password)) {
        $user->setIpAddress($request->getClientIp());
        $user->setBrowserINFO($request->headers->get('User-Agent'));
        $user->setLastLogin(new \DateTime());
        $user->setLastAction(new \DateTime());
        $entityManager->persist($user);
        $entityManager->flush();
        $this->addFlash('success', "You are logged in");
        $request->getSession()->set("user_id", $user->getId());
        $request->getSession()->save();
        return $this->redirectToRoute('home');
      } else {
        array_push($error, "Invalid credentials");
      }
    }
    return $this->render('pages/login.html.twig', array(
      'form' => $form->createView(),
      'error' => $error,
    ));
  }

  // create logout function

  #[Route('/logout', name: 'logout')]
  public function logout(Request $request)
  {
    $request->getSession()->clear();
    $request->getSession()->save();
    return $this->redirectToRoute('home');
    //return new Response('Redirecting to homepage. Please wait...<br/>Click <a href="/">here</a> if you are not redirected automatically');
  }

  #[Route('/signup', name: 'signup')]
  public function signup()
  {
    return $this->render('pages/signup.html.twig');
  }
}
