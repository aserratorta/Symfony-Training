<?php
namespace TestBundle\Entity;

use Doctrine\ORM\EntityRepository;

class OfferRepository extends EntityRepository
{
    public function findDayOffer($city)
    {
        $em = $this->getEntityManager();

        $dql = 'SELECT o, c, s
                FROM TestBundle:Offer o
                JOIN o.city c JOIN o.shop s
                WHERE o.checked = true
                AND o.publicationDate < :date
                and c.slug = :city
                ORDER  BY o.publicationDate DESC';

        $query=$em->createQuery($dql);
        $query->setParameter('date', new\DateTime('now'));
        $query->setParameter('city', $city);
        $query->setMaxResults(1);

        return $query->getSingleResult();
    }
}
