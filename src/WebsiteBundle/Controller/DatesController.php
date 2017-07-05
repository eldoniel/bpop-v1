<?php

namespace WebsiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DatesController extends Controller
{
  /**
  * @Route("/dates", name="dates_index")
  */
  public function indexAction()
  {
    return $this->showAction();
  }

  /**
  * @Route("/dates/show", name="dates_show")
  */
  public function showAction()
  {
    return $this->render(
      'WebsiteBundle:Dates:show.html.twig'
    );
  }
}
