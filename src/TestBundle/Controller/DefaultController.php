<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TestBundle\Entity\Product;
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

    public function createAction()
    {
        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');
        $product->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return new Response('Created product id '.$product->getId());
    }

    public function productosAction()
    {
        return $this->render('TestBundle:Default:productos.html.twig', array());
    }
}
