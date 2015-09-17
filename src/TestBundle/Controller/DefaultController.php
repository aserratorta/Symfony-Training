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

        $offer = $em->getRepository('TestBundle:Offer')->findOneBy(array(
                'city' => $city,
                'publicationDate' => new \DateTime('today')
            ));

        if (!$offer) {
            throw $this->createNotFoundException(
                'No se ha encontrado ninguna oferta del día en la ciudad seleccionada');
        }

        return $this->render('TestBundle:Default:front.html.twig', array('offer' => $offer));
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
            array('cities' => $cities)
        );
    }

}
