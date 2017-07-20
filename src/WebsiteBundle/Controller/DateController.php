<?php

namespace WebsiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DateController extends Controller
{
  /**
  * @Route("/date", name="date_index")
  */
  public function indexAction()
  {
    return $this->showAction();
  }

  /**
  * @Route("/date/show", name="date_show")
  */
  public function showAction()
  {
    return $this->render(
      'WebsiteBundle:Date:show.html.twig'
    );
  }

  /**
   * @Route("/date/next", name="date_next")
   */
  public function nextAction()
  {
    return $this->render(
      'WebsiteBundle:Date:next.html.twig'
    );
  }
}
