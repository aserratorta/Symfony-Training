<?php

namespace TestBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TestBundle\Entity\Offer;

/**
 * Fixtures de la entidad Oferta.
 * Crea para cada ciudad 15 ofertas con información muy realista.
 */
class Offers extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    public function getOrder()
    {
        return 30;
    }

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        // Obtener todas las tiendas y ciudades de la base de datos
        $cities = $manager->getRepository('TestBundle:City')->findAll();
        $shops = $manager->getRepository('TestBundle:Shop')->findAll();

        foreach ($cities as $city) {
            $shops = $manager->getRepository('TestBundle:Shop')->findByCiudad(
                $city->getId()
            );

            for ($j=1; $j<=15; $j++) {
                $offer = new Offer();

                $offer->setName($this->getName());
                $offer->setDescription($this->getDescription());
                $offer->setConditions($this->getConditions());
                $offer->setPicture('picture'.rand(1,20).'.jpg');
                $offer->setPrice(number_format(rand(100, 10000)/100, 2));
                $offer->setDiscount($offer->getPrice() * (rand(10, 70)/100));

                // Una oferta se publica hoy, el resto se reparte entre el pasado y el futuro
                if (1 == $j) {
                    $date = 'today';
                    $offer->setChecked(true);
                } elseif ($j < 10) {
                    $date = 'now - '.($j-1).' days';
                    // el 80% de las ofertas pasadas se marcan como revisadas
                    $offer->setChecked((rand(1, 1000) % 10) < 8);
                } else {
                    $date = 'now + '.($j - 10 + 1).' days';
                    $offer->setChecked(true);
                }

                $publicationDate = new \DateTime($date);
                $publicationDate->setTime(23, 59, 59);

                // Se debe clonar el valor de la fechaPublicacion porque si se usa directamente
                // el método ->add(), se modificaría el valor original, que no se guarda en la BD
                // hasta que se hace el ->flush()
                $expirationDate = clone $publicationDate;
                $expirationDate->add(\DateInterval::createFromDateString('24 hours'));

                $offer->setPublicationDate($publicationDate);
                $offer->setExpirationDate($expirationDate);

                $offer->setShopping(0);
                $offer->setThreshold(rand(25, 100));

                $offer->setCity($city);

                // Seleccionar aleatoriamente una tienda que pertenezca a la ciudad anterior
                $shop = $shops[array_rand($shops)];
                $offer->setShop($shop);

                $manager->persist($offer);
                $manager->flush();
            }
        }
    }

    /**
     * Generador aleatorio de nombres de ofertas.
     *
     * @return string Nombre/título aletorio generado para la oferta.
     */
    private function getName()
    {
        $words = array_flip(array(
            'Lorem', 'Ipsum', 'Sitamet', 'Et', 'At', 'Sed', 'Aut', 'Vel', 'Ut',
            'Dum', 'Tincidunt', 'Facilisis', 'Nulla', 'Scelerisque', 'Blandit',
            'Ligula', 'Eget', 'Drerit', 'Malesuada', 'Enimsit', 'Libero',
            'Penatibus', 'Imperdiet', 'Pendisse', 'Vulputae', 'Natoque',
            'Aliquam', 'Dapibus', 'Lacinia'
        ));

        $wordsNumber = rand(4, 8);

        return implode(' ', array_rand($words, $wordsNumber));
    }

    /**
     * Generador aleatorio de descripciones de ofertas.
     *
     * @return string Descripción aletoria generada para la oferta.
     */
    private function getDescription()
    {
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

        $phrasesNumber = rand(4, 7);

        return implode("\n", array_rand($phrases, $phrasesNumber));
    }

    /**
     * Generador aleatorio de condiciones de ofertas.
     *
     * @return string Condiciones aletorias generadas para la oferta.
     */
    private function getConditions()
    {
        $conditions = '';

        $phrases = array_flip(array(
            'Máximo 1 consumición por persona.',
            'No acumulable a otras ofertas.',
            'No disponible para llevar. Debe consumirse en el propio local.',
            'Válido para cualquier día entre semana.',
            'No válido en festivos ni fines de semana.',
            'Reservado el derecho de admisión.',
            'Oferta válida si se realizan consumiciones adicionales por valor de 50 euros.',
            'Válido solamente para comidas, no para cenas.',
        ));

        $phraseNumber = rand(2, 4);

        return implode(' ', array_rand($phrases, $phraseNumber));
    }
}
