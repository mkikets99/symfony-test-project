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
      'links' => array_merge($this->default_links, array(
        array('href' => (($userID == null) ? "/login" : "/logout"), 'label' => ($userID == null) ? "Login" : "Logout")
      ))
    ));
    // return new Response('Hello World');
    // return $this->render('home.html.twig');
  }

  #[Route('/article', name: 'article')]
  public function article()
  {
    return $this->render('pages/article.html.twig');
  }

  #[Route('/articles', name: 'articles')]
  public function articles()
  {
    return $this->render('pages/articles.html.twig');
  }

  #[Route('/user/home', name: 'user-home')]
  public function userHome()
  {
    return $this->render('pages/user/home.html.twig');
  }
}
