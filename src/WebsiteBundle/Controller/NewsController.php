<?php

namespace WebsiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    /**
    * @Route("/accueil")
    */
    public function indexAction()
    {
        $content = $this->get('templating')->render('WebsiteBundle:News:accueil.html.twig');

        return new Response($content);
    }
}
