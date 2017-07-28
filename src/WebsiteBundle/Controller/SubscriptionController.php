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

    $form = $this->createForm(SubscriptionType::class, $subscription);

    if ($request->isMethod('POST')) {
      $form->handleRequest($request);

      if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($subscription);
        $em->flush();

        return $this->redirectToRoute('news_index');
      }
    }

    return $this->render('WebsiteBundle:Subscription:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }
}
