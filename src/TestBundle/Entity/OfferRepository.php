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

        $query = $em->createQuery('SELECT o, c, s FROM TestBundle:Offer
o JOIN o.city c JOIN o.shop s WHERE o.checked = true AND o.slug = :slug
AND c.slug = :city');
        $query->setParameter('slug' , $slug);
        $query->setParameter('city', $city);
        $query->setMaxResults(1);

        return $query->getSingleResult();
    }

    public function findLinked($city)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('SELECT o, c FROM TestBundle:Offer o
JOIN o.city c WHERE o.checked = true AND o.publicationDate <= : date AND
c.slug != :city ORDER BY o.publicationDate DESC');
        $query->setMaxResults(5);
        $query->setParameter('city', $city);
        $query->setParameter('date', new \DateTime('today'));

        return $query->getResult();
    }

    public function findRecent($city_id)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('SELECT o, s FROM TestBundle:Offer o
JOIN o.shop s WHERE o.checked = true AND o.publicationDate < :date AND
o.city = :id ORDER BY o.publicationDate DESC');
        $query->setMaxResults(5);
        $query->setParameter('id', $city_id);
        $query->setParameter('date', new \DateTime('today'));

        return $query->getResult();
    }

}
