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
            array('name' => 'Madrid', 'slug' => 'madrid'),
            array('name' => 'Barcelona', 'slug' => 'barcelona'),
        );

        foreach ($cities as $city) {
            $entity = new City();

            $entity->setName($city['name']);
            $entity->setSlug($city['slug']);

            $manager->persist($entity);
        }

        $manager->flush();
    }
}