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
        if (!is_numeric($price) || !is_numeric($discount)) {
            return '-';
        }

        if ($discount == 0 || $discount ==null) {
            return 'o%';
        }

        $original_price = $price + $discount;
        $percentage= ($discount/$original_price)*100;

        return '-'.number_format($percentage, $decimals).'%';
    }

    public function getFilters()
    {
        return array(
            'showing_as_a_list' => new \Twig_Filter_Method($this,
            'showing_as_a_list', array('is_safe' => array('html')))
        );
    }

    public function showingAsAList($value, $type='ul')
    {
        $html = "<".$type.">\n";
        $html .= " <li>".str_replace("\n", "</li>\n <li>", $value)."</li>\n";
        $html .= "</".$type.">\n";

        return $html;
    }

    public function countDown($date)
    {
        $date = $date->format('Y,')
           .($date->format('m')-1
            .($date->format(',d,H,i,s');

        $html = <<<EOJ
        <script type="text/javascript">
        function sowingCountDown(){
        var hours, minutes, seconds;
        var now = new Date();
        var expirationDate = new Date($date);
        var falta = Math.floor
        </script>
EOJ;

        return $html;
    }

}