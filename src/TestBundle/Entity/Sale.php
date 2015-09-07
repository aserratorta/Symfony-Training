<?php

namespace TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="sale"))
 * @ORM\Entity
 */
class Sale
{
    /**
     * @ORM\Column(name="date", type="datetime")
     */
    protected $date;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Offer")
     */
    protected $offer;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $user;


    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Sale
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set offer
     *
     * @param string $offer
     * @return Sale
     */
    public function setOffer($offer)
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * Get offer
     *
     * @return string 
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * Set user
     *
     * @param string $user
     * @return Sale
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }
}
