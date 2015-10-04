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

    public function findOffer($city, $slug)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('SELECT o,c, s FROM TestBundle:Offer
o JOIN o.city c JOIN o.shop s WHERE o.checked = true AND o.slug = :slug
AND c.slug = :city');
        $query->setParameter('slug' , $slug);
        $query->setParameter('city', $city);
        $query->setMaxResults(1);

        return $query->getSingleResult();
    }
}
