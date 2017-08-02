<?php

namespace WebsiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WebsiteBundle\Entity\Media;
use WebsiteBundle\Form\MediaType;

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
    $medias = $this->getDoctrine()
      ->getRepository('WebsiteBundle:Media')
      ->findAll();

    return $this->render(
      'WebsiteBundle:Media:show.html.twig',
      array('medias' => $medias)
    );
  }

  /**
   * @Route("/media/latest", name="media_latest")
   */
  public function latestAction()
  {
    $repository = $this->getDoctrine()
      ->getManager()
      ->getRepository('WebsiteBundle:Media');

    $media = $repository->findLastMedia();

    return $this->render(
      'WebsiteBundle:Media:latest.html.twig',
      array('media' => $media));
  }

  /**
   * @Route("/media/add", name="media_add")
   */
  public function addAction(Request $request)
  {
    $media = new Media();

    $form = $this->createForm(MediaType::class, $media, array('action' => $this->generateUrl('media_add')));

    if ($request->isMethod('POST')) {
      $form->handleRequest($request);

      if ($form->isValid()) {
        $file = $media->getPath();

        //$fileName = md5(uniqid()).'.'.$file->guessExtension();
        $fileName = md5(uniqid()).".mp3";

        $file->move(
          $this->getParameter('media_directory'),
          $fileName
        );

        $media->setPath($fileName);

        $em = $this->getDoctrine()->getManager();
        $em->persist($media);
        $em->flush();

        return $this->redirectToRoute('media_index');
      }
    }

    return $this->render('WebsiteBundle:Media:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }
}
