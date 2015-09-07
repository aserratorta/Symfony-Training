<?php

namespace TestBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TestBundle\Entity\Shop;

/**
 * Fixtures de la entidad Tienda.
 * Crea para cada ciudad entre 2 y 5 tiendas con información muy realista.
 */
class Shops extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function getOrder()
    {
        return 20;
    }

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        // Obtener todas las ciudades de la base de datos
        $cities = $manager->getRepository('CiudadBundle:Ciudad')->findAll();

        $i = 1;
        foreach ($cities as $city) {
            $shopNumber = rand(2, 5);
            for ($j=1; $j<=$shopNumber; $j++) {
                $shop = new Shop();

                $shop->setName($this->getName());

                $shop->setLogin('shop'.$i);
                $shop->setSalt(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));

                $passwordEnClaro = 'shop'.$i;
                $encoder = $this->container->get('security.encoder_factory')->getEncoder($shop);
                $passwordCodificado = $encoder->encodePassword($passwordEnClaro, $shop->getSalt());
                $shop->setPassword($passwordCodificado);

                $shop->setDescription($this->getDescription());
                $shop->setAddress($this->getAddress($city));
                $shop->setCity($city);

                $manager->persist($shop);

                $i++;
            }
        }

        $manager->flush();
    }

    /**
     * Generador aleatorio de nombres de tiendas
     *
     * @return string Nombre aleatorio generado para la tienda.
     */
    private function getName()
    {
        $prefixes = array('Restaurante', 'Cafetería', 'Bar', 'Pub', 'Pizza', 'Burger');
        $names = array(
            'Lorem ipsum', 'Sit amet', 'Consectetur', 'Adipiscing elit',
            'Nec sapien', 'Tincidunt', 'Facilisis', 'Nulla scelerisque',
            'Blandit ligula', 'Eget', 'Hendrerit', 'Malesuada', 'Enim sit'
        );

        return $prefixes[array_rand($prefixes)].' '.$names[array_rand($names)];
    }

    /**
     * Generador aleatorio de descripciones de tiendas
     *
     * @return  string Descripción aleatoria generada para la tienda.
     */
    private function getDescription()
    {
        $description = '';

        $phrases = array_flip(array(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'Mauris ultricies nunc nec sapien tincidunt facilisis.',
            'Nulla scelerisque blandit ligula eget hendrerit.',
            'Sed malesuada, enim sit amet ultricies semper, elit leo lacinia massa, in tempus nisl ipsum quis libero.',
            'Aliquam molestie neque non augue molestie bibendum.',
            'Pellentesque ultricies erat ac lorem pharetra vulputate.',
            'Donec dapibus blandit odio, in auctor turpis commodo ut.',
            'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
            'Nam rhoncus lorem sed libero hendrerit accumsan.',
            'Maecenas non erat eu justo rutrum condimentum.',
            'Suspendisse leo tortor, tempus in lacinia sit amet, varius eu urna.',
            'Phasellus eu leo tellus, et accumsan libero.',
            'Pellentesque fringilla ipsum nec justo tempus elementum.',
            'Aliquam dapibus metus aliquam ante lacinia blandit.',
            'Donec ornare lacus vitae dolor imperdiet vitae ultricies nibh congue.',
        ));

        $phraseNumber = rand(3, 6);

        return implode(' ', array_rand($phrases, $phraseNumber));
    }

    /**
     * Generador aleatorio de direcciones postales.
     *
     * @param  City $city Objeto de la ciudad para la que se genera una dirección postal.
     * @return string         Dirección postal aleatoria generada para la tienda.
     */
    private function getAddress(City $city)
    {
        $prefixes = array('Calle', 'Avenida', 'Plaza');
        $names = array(
            'Lorem', 'Ipsum', 'Sitamet', 'Consectetur', 'Adipiscing',
            'Necsapien', 'Tincidunt', 'Facilisis', 'Nulla', 'Scelerisque',
            'Blandit', 'Ligula', 'Eget', 'Hendrerit', 'Malesuada', 'Enimsit'
        );

        return $prefixes[array_rand($prefixes)].' '.$names[array_rand($names)].', '.rand(1, 100)."\n"
               .$this->getPostalCode().' '.$city->getName();
    }

    /**
     * Generador aleatorio de códigos postales
     *
     * @return string Código postal aleatorio generado para la tienda.
     */
    private function getPostalCode()
    {
        return sprintf('%02s%03s', rand(1, 52), rand(0, 999));
    }
}
