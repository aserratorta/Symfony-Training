<?php
namespace TestBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TestBundle\Entity\City;

class Cities implements  FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $cities = array(
            'Madrid',
            'Barcelona',
            'Valencia',
            'Sevilla',
            'Zaragoza',
            'Málaga',
            'Murcia',
            'Palma de Mallorca',
            'Las Palmas de Gran Canaria',
            'Bilbao',
            'Alicante',
            'Córdoba',
            'Valladolid',
            'Vigo',
            'Gijón',
            'Hospitalet de Llobregat',
            'La Coruña',
            'Granada',
            'Vitoria-Gasteiz',
            'Elche',
            'Oviedo',
            'Santa Cruz de Tenerife',
            'Badalona',
            'Cartagena',
            'Tarrasa',
        );

        foreach ($cities as $city) {
            $entity = new City();
            $entity->setName($city['name']);
            $manager->persist($entity);
        }

        $manager->flush();
    }
}