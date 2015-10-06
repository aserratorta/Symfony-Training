<?php
namespace Symfony\TestBundle\Twig\Extension;

class SymfonyExtension extends \Twig_Extension
{
    public function getName()
    {
        return 'symfony';
    }

    public function getFunctions()
    {
        return array(
            'discount' => new \Twig_Function_Method($this, 'discount')
        );
    }
}