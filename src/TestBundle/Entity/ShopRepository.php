<?php
namespace TestBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ShopRepository extends EntityRepository
{
    public function findLastPublishedOffers($shop_id, $limit = 10)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('
            SELECT o, s
            FROM TestBundle:Offer o JOIN o.shop s
            WHERE o.checked = true AND o.publicationDate < :date AND o.shop = :id
            ORDER BY o.expirationDate DESC
        ');
        $query->setMaxResults($limit);
        $query->setParameter('id', $shop_id);
        $query->setParameter('date', new \DateTime('now'));

        return $query->getResult();
    }

    public function findNear($shop, $city)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('SELECT s FROM TestBundle:Shop s JOIN s.city c
WHERE c.slug = :city AND s.slug != :shop');
        $query->setMaxResults(5);
        $query->setParameter('city', $city);
        $query->setParameter('shop', $shop);

        return $query->getResult();
    }
}

