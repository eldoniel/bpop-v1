<?php

namespace WebsiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WebsiteBundle\Entity\Video;
use WebsiteBundle\Form\VideoType;

class VideoController extends Controller {

  /**
   * @Route("/video/show", name="video_show")
   */
  public function showAction() {
    $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('WebsiteBundle:Video');

    $latestVideo = $repository->findLatestVideo();

    return $this->render(
      'WebsiteBundle:Video:show.html.twig', array('video' => $latestVideo)
    );
  }

  /**
   * @Route("/video/add", name="video_add")
   */
  public function addAction(Request $request) {
    $video = new Video();

    $form = $this->createForm(VideoType::class, $video, array('action' => $this->generateUrl('video_add')));

    if ($request->isMethod('POST')) {
      $form->handleRequest($request);

      if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($video);
        $em->flush();

        return $this->redirectToRoute('news_index');
      }
    }

    return $this->render('WebsiteBundle:Video:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

}
