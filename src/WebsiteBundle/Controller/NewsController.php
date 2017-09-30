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
  * @Route("/", name="news_index")
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
    $repository = $this->getDoctrine()
      ->getManager()
      ->getRepository('WebsiteBundle:Advert');

    $lastAdvert = $repository->findLastAdvert();
/*
    $adverts = $this->getDoctrine()
      ->getRepository('WebsiteBundle:Advert')
      ->findAll();
*/
    return $this->render(
      'WebsiteBundle:News:show.html.twig',
      array('lastAdvert' => $lastAdvert)
    );
  }

  /**
   * @Route("/news/add", name="news_add")
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

        $listSubscribers = $this->getSubscribers();

        foreach ($listSubscribers as $subscriber) {
          $message = (new \Swift_Message('Nouvelle news B!pop !'))
            ->setFrom('bpop.website@gmail.com')
            ->setTo($subscriber->getMail())
            ->setBody(
              $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                'WebsiteBundle:Emails:newsletter.html.twig',
                array(
                  'type' => 'news'
                  )
              ),
              'text/html'
            )
          ;

          $this->get('mailer')->send($message);
        }

        return $this->redirectToRoute('news_index');
      }
    }

    return $this->render('WebsiteBundle:News:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }
  
  /**
   * @Route("/news/delete/{id}", name="news_delete")
   */
  public function deleteAction($id)
  {
    $repository = $this->getDoctrine()
      ->getManager()
      ->getRepository('WebsiteBundle:Advert');
    
    $advert = $repository->find($id);
    
    $em = $this->getDoctrine()->getManager();
    $em->remove($advert);
    $em->flush();

    return $this->redirectToRoute('news_index');
  }

  public function getSubscribers() {
    $repository = $this->getDoctrine()
      ->getManager()
      ->getRepository('WebsiteBundle:Subscription');

    $listSubscribers = $repository->findBy(
      array('news' => 1)
    );

    return $listSubscribers;
  }
}
