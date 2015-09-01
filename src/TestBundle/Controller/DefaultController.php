<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TestBundle:Default:index.html.twig', array());
    }

    public function serviciosAction()
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
}