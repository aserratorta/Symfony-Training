<?php

namespace HelloBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HelloController extends Controller
{
    public function indexAction()
    {
        return new RedirectResponse($this->generateUrl('homepage'));
    }
}