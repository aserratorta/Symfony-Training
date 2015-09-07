<?php

/*
 * (c) Javier Eguiluz <javier.eguiluz@gmail.com>
 *
 * Este archivo pertenece a la aplicación de prueba Cupon.
 * El código fuente de la aplicación incluye un archivo llamado LICENSE
 * con toda la información sobre el copyright y la licencia.
 */

namespace TestBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TestBundle\Entity\Sale;
/**
 * Fixtures de la entidad Venta.
 * Crea para cada usuario registrado entre 0 y 3 ventas.
 */
class Sales extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 50;
    }

    public function load(ObjectManager $manager)
    {
        // Obtener todas las ofertas y usuarios de la base de datos
        $offers = $manager->getRepository('TestBundle:Offer')->findAll();
        $users = $manager->getRepository('TestBundle:User')->findAll();

        foreach ($users as $user) {
            $shopping = rand(0, 3);
            $comprado = array();

            for ($i=0; $i<$shopping; $i++) {
                $sale = new Sale();

                $sale->setDate(new \DateTime('now - '.rand(0, 250).' hours'));

                // Sólo se añade una venta:
                //   - si este mismo usuario no ha comprado antes la misma oferta
                //   - si la oferta seleccionada ha sido revisada
                //   - si la fecha de publicación de la oferta es posterior a ahora mismo
                $offer = $offers[array_rand($offers)];
                while (in_array($offer->getId(), $comprado)
                       || $offer->getChecked() == false
                       || $offer->getPublicationDate() > new \DateTime('now')) {
                    $offer = $offers[array_rand($offers)];
                }
                $comprado[] = $offer->getId();

                $sale->setOffer($offer);
                $sale->setUser($user);

                $manager->persist($sale);

                $offer->setCompras($offer->getCompras() + 1);
                $manager->persist($offer);
            }

            unset($comprado);
        }

        $manager->flush();
    }
}
