<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TestBundle\Entity\Offer;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public function frontAction($city, $shop)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $cityEntity = $em->getRepository('TestBundle:City')->findOneBy(array('slug' => $city));
        $shopsManager = $em->getRepository('TestBundle:Shop');
        $parameter =  array('slug' => $shop, 'city' => $cityEntity->getId());
        $shop = $shopsManager->findOneBy($parameter);

        if (!$shop) {
            throw $this->createNotFoundException( 'No existeix aquesta tenda' );
        }

        $offer = $em->getRepository('TestBundle:Shop')
            ->findLastPublishedOffers($shop->getId());

        $near = $em->getRepository('TestBundle:Shop')->findNear(
            $shop->getSlug(),
            $shop->getCity()->getSlug()
        );

        return $this->render('TestBundle:Default:front.html.twig', array(
                'shop' => $shop,
                'offer' => $offer,
                'near' => $near
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
            'static_page',
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
        $linked = $em->getRepository('TestBundle:Offer')
                     ->findLinked($city);

        return $this->render('TestBundle:Default:detail.html.twig' , array(
            'offer'=> $offer,
            'linked' => $linked
        ));
    }

    public function recentAction($city)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $city = $em->getRepository('TestBundle:City')
            ->findOneBySlug($city);
        $near = $em->getRepository('TestBundle:City')
            ->findNear($city->getId());
        $offers = $em->getRepository('TestBundle:Offer')
            ->findRecent($city->getId());

        return $this->render('TestBundle:Default:recent.html.twig',
            array(
                'city'=>$city,
                'near'=>$near,
                'offers'=>$offers
            )
        );
    }

    public function shoppingAction()
    {
        $user_id = 1;

        $em = $this->getDoctrine()->getEntityManager();
        $shoppings = $em->getRepository('TestBundle:User')
            ->findAllShopping($user_id);

        return $this->render('TestBundle:Default:shopping.html.twig', array(
            'shoppings' => $shoppings
        ));
    }

}
