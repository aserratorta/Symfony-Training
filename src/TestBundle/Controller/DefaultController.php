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
    public function indexAction()
    {
        return $this->render('TestBundle:Default:index.html.twig', array());
    }

    public function servicesAction()
    {
        return $this->render('TestBundle:Default:servicios.html.twig', array());
    }

    public function contactosAction()
    {
        return $this->render('TestBundle:Default:contactos.html.twig', array());
    }

    public function proyectosAction()
    {
        return $this->render('TestBundle:Default:proyectos.html.twig', array());
    }

    public function baseAction()
    {
        return $this->render('TestBundle:Default:base.html.twig', array());
    }

    public function fillaAction()
    {
        return $this->render('TestBundle:Default:filla.html.twig', array());
    }

    public function createProductAction()
    {
        $category = new Category();
        $category->setName('Main Products');

        $product = new Product();
        $product->setName('Foo');
        $product->setPrice(19.99);
        // relaciona este producto con una categoría
        $product->setCategory($category);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();

        return new Response('Created product id: '.$product->getId()
            .' and category id: '.$category->getId()
        );
    }

    public function ShowProductsAction()
    {
        $products = $this->getDoctrine()
            ->getRepository('TestBundle:Product')
            ->findAll();

        return $this->render('TestBundle:Default:productos.html.twig', array($products));
    }
}
