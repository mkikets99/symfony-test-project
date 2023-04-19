<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\User;
use App\Types\LoginForm;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MainRouteController extends AbstractController
{
  private $default_links = array(
    array('href' => "/", 'label' => 'Home'),
    array('href' => "/articles", 'label' => 'Articles')
  );

  private function link_gen(Request $request, EntityManagerInterface $entityManager, LoggerInterface $logger)
  {
    $userID = $request->getSession()->get('user_id');
    $additional = array();
    if ($userID != null)
      array_push($additional, array('href' => "/user/home", 'label' => 'User Space'));
    array_push($additional, array('href' => (($userID == null) ? "/login" : "/logout"), 'label' => ($userID == null) ? "Login" : "Logout"));
    return array_merge($this->default_links, $additional);
  }

  #[Route('/', name: 'home')]
  public function home(Request $request, EntityManagerInterface $entityManager, LoggerInterface $logger)
  {
    $userID = $request->getSession()->get('user_id');
    if ($userID !=  null) {
      $user = $entityManager->getRepository(User::class)->find($userID);

      $user->setLastAction(new \DateTime());
      $entityManager->persist($user);
      $entityManager->flush();
    }

    return $this->render('pages/home.html.twig', array(
      'links' => $this->link_gen($request, $entityManager, $logger)
    ));
    // return new Response('Hello World');
    // return $this->render('home.html.twig');
  }

  #[Route('/article', name: 'article')]
  public function article(Request $request, EntityManagerInterface $entityManager, LoggerInterface $logger)
  {
    $userID = $request->getSession()->get('user_id');
    if ($userID !=  null) {
      $user = $entityManager->getRepository(User::class)->find($userID);

      $user->setLastAction(new \DateTime());
      $entityManager->persist($user);
      $entityManager->flush();
    }

    return $this->render('pages/article.html.twig', array(
      'links' => $this->link_gen($request, $entityManager, $logger)
    ));
  }

  #[Route('/articles', name: 'articles')]
  public function articles(Request $request, EntityManagerInterface $entityManager, LoggerInterface $logger)
  {
    $userID = $request->getSession()->get('user_id');
    if ($userID !=  null) {
      $user = $entityManager->getRepository(User::class)->find($userID);

      $user->setLastAction(new \DateTime());
      $entityManager->persist($user);
      $entityManager->flush();
    }

    return $this->render('pages/articles.html.twig', array(
      'links' => $this->link_gen($request, $entityManager, $logger)
    ));
  }

  #[Route('/user/home', name: 'user-home')]
  public function userHome(Request $request, EntityManagerInterface $entityManager, LoggerInterface $logger)
  {
    $userID = $request->getSession()->get('user_id');
    if ($userID !=  null) {
      $user = $entityManager->getRepository(User::class)->find($userID);

      $user->setLastAction(new \DateTime());
      $entityManager->persist($user);
      $entityManager->flush();
    }

    return $this->render('pages/user/home.html.twig', array(
      'links' => $this->link_gen($request, $entityManager, $logger)
    ));
  }
}
