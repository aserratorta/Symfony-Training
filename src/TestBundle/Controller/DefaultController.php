<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TestBundle\Entity\City;
use TestBundle\Entity\Shop;
use TestBundle\Entity\Offer;
use TestBundle\Entity\User;
use TestBundle\Entity\Sale;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function frontAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $offer = $em->getRepository('TestBundle:Offer')->findOneBy(
            array(
                'city' => 1,
                'publicationDate' => new \DateTime('today')
            )
        );

        return $this->render('TestBundle:Default:front.html.twig', array('offer' => $offer));
    }

    public function staticAction($page)
    {
        return $this->render('TestBundle:Default:'.$page.'.html.twig');
    }

    public function dayofferAction()
    {
        return $this->render('TestBundle:Default:dayoffer.html.twig', array());
    }

}
