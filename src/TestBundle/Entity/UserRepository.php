<?php
namespace TestBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findAllShopping($user)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('
            SELECT sale, o, s
            FROM TestBundle:Sale sale
            JOIN sale.offer o JOIN o.shop s
            WHERE sale.user = :id ORDER BY sale.date DESC
            ');

        $query->setParameter('id', $user);

        return $query->getResult();
    }

}

