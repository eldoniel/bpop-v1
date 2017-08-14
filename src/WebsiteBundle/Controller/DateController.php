<?php

namespace WebsiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WebsiteBundle\Entity\Date;
use WebsiteBundle\Form\DateType;

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
    $repository = $this->getDoctrine()
      ->getManager()
      ->getRepository('WebsiteBundle:Date');

    $dates = $repository->findUpcomingDates();

    return $this->render(
      'WebsiteBundle:Date:show.html.twig',
      array('dates' => $dates)
    );
  }

  /**
   * @Route("/date/next", name="date_next")
   */
  public function nextAction()
  {
    $repository = $this->getDoctrine()
      ->getManager()
      ->getRepository('WebsiteBundle:Date');

    $dates = $repository->findThreeNextDates();

    return $this->render(
      'WebsiteBundle:Date:next.html.twig',
      array('dates' => $dates)
    );
  }

  /**
   * @Route("/date/add", name="date_add")
   */
   public function addAction(Request $request)
   {
     $date = new Date();

     $form = $this->createForm(DateType::class, $date, array('action' => $this->generateUrl('date_add')));

     if ($request->isMethod('POST')) {
       $form->handleRequest($request);

       if ($form->isValid()) {
         $em = $this->getDoctrine()->getManager();
         $em->persist($date);
         $em->flush();

         $listSubscribers = $this->getSubscribers();

         foreach ($listSubscribers as $subscriber) {
           $message = (new \Swift_Message('Nouvelle date B!pop !'))
             ->setFrom('bpop.website@gmail.com')
             ->setTo($subscriber->getMail())
             ->setBody(
               $this->renderView(
                 // app/Resources/views/Emails/registration.html.twig
                 'WebsiteBundle:Emails:newsletter.html.twig',
                 array(
                   'type' => 'dates'
                   )
               ),
               'text/html'
             )
           ;

           $this->get('mailer')->send($message);
         }

         return $this->redirectToRoute('date_index');
       }
     }

     return $this->render('WebsiteBundle:Date:add.html.twig', array(
       'form' => $form->createView(),
     ));
   }

   public function getSubscribers() {
     $repository = $this->getDoctrine()
       ->getManager()
       ->getRepository('WebsiteBundle:Subscription');

     $listSubscribers = $repository->findBy(
       array('dates' => 1)
     );

     return $listSubscribers;
   }
}
