<?php

namespace WebsiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MediaController extends Controller
{
  /**
  * @Route("/media", name="media_index")
  */
  public function indexAction()
  {
    return $this->showAction();
  }

  /**
  * @Route("/media/show", name="media_show")
  */
  public function showAction()
  {
    return $this->render(
      'WebsiteBundle:Media:show.html.twig'
    );
  }
}
