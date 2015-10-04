<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TestBundle\Entity\Offer;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    public function frontAction($city = null)
    {
        if (null == $city) {
            $city = $this->container
                         ->getParameter('symfony.defaultcity');

            return new RedirectResponse(
                $this->generateUrl('front', array('city' => $city))
            );
        }

        $em = $this->getDoctrine()->getEntityManager();

        $cityEntity = $em->getRepository('TestBundle:City')->findOneBy(array(
            'slug' => $city,
        ));
        if (!$cityEntity) {
            throw $this->createNotFoundException(
                'No se ha encontrado ninguna ciudad con el atributo slug = ' . $city);
        }

        $offer = $em->getRepository('TestBundle:Offer')->findOneBy(array(
                'city' => $cityEntity, // you must search by a city instance,
                // not by a slug string because offers are not related to cities by his slug...
                'publicationDate' => new \DateTime('today') // be careful here,
                // because today returns a '00:00:00' time but in your fixtures you are setting '23:59:59' time
            ));
        if (!$offer) {
            throw $this->createNotFoundException(
                'No se ha encontrado ninguna oferta del día en la ciudad seleccionada');
        }

        return $this->render('TestBundle:Default:front.html.twig', array(
                'offer' => $offer,
                'currentCity' => $city,
            )
        );
    }

    public function staticAction($page)
    {
        return $this->render('TestBundle:Default:'.$page.'.html.twig');
    }

    public function changeAction($city)
    {
        return new RedirectResponse($this->generateUrl(
            'front',
            array('city'=> $city)
        ));
    }

    public function cityListAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $cities = $em->getRepository('TestBundle:City')->findAll();

        return $this->render(
            'TestBundle:Default:cityList.html.twig',
            array(
                'currentCity' => $city,
                'cities' => $cities)
        );
    }

    public function offerAction($city, $slug)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $offer = $em->getRepository('TestBundle:Offer')
                    ->findOffer($city, $slug);

        return $this->render('TestBundle:Default:detail.html.twig' , array(
            'offer'=> $offer
        ));
    }



}
