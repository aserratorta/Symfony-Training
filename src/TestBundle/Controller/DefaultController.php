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

    public function helpAction()
    {
        return $this->render('TestBundle:Default:help.html.twig', array());
    }

    public function contactAction()
    {
        return $this->render('TestBundle:Default:contact.html.twig', array());

    }

    public function dayofferAction()
    {
        return $this->render('TestBundle:Default:dayoffer.html.twig', array());
    }

}
