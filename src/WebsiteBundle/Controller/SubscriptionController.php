<?php

namespace WebsiteBundle\Controller;

use WebsiteBundle\Entity\Subscription;
use WebsiteBundle\Form\SubscriptionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionController extends Controller
{
  /**
  * @Route("/subscription", name="subscription_index")
  */
  public function indexAction()
  {
    return $this->showAction();
  }

  /**
   * @Route("/subscription/show", name="subscription_show")
   */
  public function showAction()
  {
    return $this->render(
      'WebsiteBundle:Subscription:show.html.twig'
    );
  }

  /**
  * @Route("/subscription/add", name="subscription_add")
  */
  public function addAction(Request $request)
  {
    $subscription = new Subscription();

    $form = $this->createForm(SubscriptionType::class, $subscription, array('action' => $this->generateUrl('subscription_add')));

    if ($request->isMethod('POST')) {
      $form->handleRequest($request);

      if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($subscription);
        $em->flush();

        $message = (new \Swift_Message('Confirmation de votre inscription à la newsletter'))
          ->setFrom('bpop.website@gmail.com')
          ->setTo($subscription->getMail())
          ->setBody(
            $this->renderView(
              // app/Resources/views/Emails/registration.html.twig
              'WebsiteBundle:Emails:subscription.html.twig',
              array(
                'news' => $subscription->getNews(),
                'music' => $subscription->getMusic(),
                'dates' => $subscription->getDates()
                )
            ),
            'text/html'
          )
        ;

        $this->get('mailer')->send($message);

        return $this->redirectToRoute('news_index');
      }
    }

    return $this->render('WebsiteBundle:Subscription:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  private function sendMail($mail, $mailer)
  {
    $message = (new \Swift_Message('Hello Email'))
        ->setFrom('bpop@noreply.com')
        ->setTo($mail)
        ->setBody(
            $this->renderView(
                "Ceci est le premier mail de test!"
            ),
            'text/html'
        )
    ;

    $mailer->send($message);
  }
}
