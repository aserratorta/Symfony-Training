<?php
namespace TestBundle\Entity;
use Doctrine\ORM\EntityRepository;

class CityRepository extends EntityRepository
{
    public function findNear($city_id)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('SELECT c FROM TestBundle:City c
WHERE c.id != :id ORDER BY c.name ASC');
        $query->setMaxResults(5);
        $query->setParameter('id', $city_id);

        return $query->getResult();
    }

}