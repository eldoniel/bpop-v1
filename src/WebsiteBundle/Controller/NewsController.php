<?php

namespace WebsiteBundle\Controller;

use WebsiteBundle\Entity\Advert;
use WebsiteBundle\Form\AdvertType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
  * @Route("/news/show", name="news_show")
  */
  public function showAction()
  {
    $adverts = $this->getDoctrine()
      ->getRepository('WebsiteBundle:Advert')
      ->findAll();

    return $this->render(
      'WebsiteBundle:News:show.html.twig',
      array('adverts' => $adverts)
    );
  }

  /**
   * @Route(name="news_add")
   */
  public function addAction(Request $request)
  {
    $advert = new Advert();

    $form = $this->createForm(AdvertType::class, $advert, array('action' => $this->generateUrl('news_add')));

    if ($request->isMethod('POST')) {
      $form->handleRequest($request);

      if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($advert);
        $em->flush();

        return $this->redirectToRoute('news_index');
      }
    }

    return $this->render('WebsiteBundle:News:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }
}
