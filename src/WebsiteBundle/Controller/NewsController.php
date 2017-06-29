<?php

namespace WebsiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
  /**
  * @Route("/news", name="news_index")
  */
  public function indexAction()
  {
    return $this->showAction(14);
  }

  /**
  * @Route("/news/show", defaults={"id" = 1}, name="news_show")
  */
  public function showAction($id)
  {
    return $this->render(
      'WebsiteBundle:News:show.html.twig',
      array('id' => $id)
    );
  }
}
