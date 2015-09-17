<?php
namespace TestBundle\Entity;

use Doctrine\ORM\EntityRepository;

class OfferRepository extends EntityRepository
{
    public function findDayOffer($city)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('SELECT o
                FROM TestBundle:Offer o
                JOIN o.city c
                WHERE c.slug = :city
                AND o.publicationDate = :date');

        $query->setParameter('city' , 'barcelona');
        $query->setParameter('date', '201X-XX-XX 00:00:00');
        $offer = $query->getResult();
    }
}
