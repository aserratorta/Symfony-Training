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

    public function discount($price, $discount, $decimals=0)
    {
        if (!is_numeric($price) || !is_nemeric($discount)) {
            return '-';
        }

        if ($discount == 0 || $discount ==null) {
            return 'o%';
        }

        $original_price = $price + $discount;
        $percentage= ($discount/$original_price)*100;

        return '-'.number_format($percentage, $decimals).'%';
    }

    public function getName()
    {
        return 'symfony';
    }
}