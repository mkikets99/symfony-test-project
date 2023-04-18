<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
// create a class named "HomeController" which extends the AbstractController class in php for symfony with a default route which will return a twig render responce
class HomeController extends AbstractController
{
  #[Route('/', name: 'home')]
  public function home()
  {

    return $this->render('pages/home.html.twig');
    // return new Response('Hello World');
    // return $this->render('home.html.twig');
  }
  // create a function named "login" which will return a twig render responce
  #[Route('/login', name: 'login')]
  public function login()
  {
    return $this->render('pages/login.html.twig');
  }
  // create a function named "signup" which will return a twig render responce
  #[Route('/signup', name: 'signup')]
  public function signup()
  {
    return $this->render('pages/signup.html.twig');
  }
  // create a function named "article" which will return a twig render responce
  #[Route('/article', name: 'article')]
  public function article()
  {
    return $this->render('pages/article.html.twig');
  }
}