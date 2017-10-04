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
  * @Route("/date/delete/show/{id}", name="date_delete_show")
  */
  public function deleteShowAction($id)
  {
    $repository = $this->getDoctrine()
      ->getManager()
      ->getRepository('WebsiteBundle:Date');

    $date = $repository->find($id);

    return $this->render(
      'WebsiteBundle:Date:delete_show.html.twig',
      array('date' => $date)
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
         $file = $date->getPoster();

         //$fileName = md5(uniqid()).'.'.$file->guessExtension();
         $fileName = md5(uniqid()).".jpg";

         $file->move(
           $this->getParameter('image_directory'),
           $fileName
         );

         $date->setPoster($fileName);

         $em = $this->getDoctrine()->getManager();
         $em->persist($date);
         $em->flush();

         $listSubscribers = $this->getSubscribers();
         $date_show = $date->getDateShow()->format('d/m/Y');
         $date_location = $date->getCity();

         foreach ($listSubscribers as $subscriber) {
           $message = (new \Swift_Message('B!pop à ' . $date_location . ' le ' . $date_show . '!'))
             ->setFrom('bpop.website@gmail.com')
             ->setTo($subscriber->getMail())
             ->setBody(
               $this->renderView(
                 'WebsiteBundle:Emails:newdate.html.twig', array(
                     'date' => $date
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
  
  /**
   * @Route("/date/delete/{id}", name="date_delete")
   */
  public function deleteAction($id)
  {
    $repository = $this->getDoctrine()
      ->getManager()
      ->getRepository('WebsiteBundle:Date');
    
    $advert = $repository->find($id);
    
    $em = $this->getDoctrine()->getManager();
    $em->remove($advert);
    $em->flush();

    return $this->redirectToRoute('date_index');
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
