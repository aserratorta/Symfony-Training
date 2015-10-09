<?php

namespace TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use TestBundle\Util\Util;

/**
 * @ORM\Table(name="offer")
 * @ORM\Entity(repositoryClass="TestBundle\Entity\OfferRepository")
 */
class Offer
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\Column(name="conditions", type="text")
     */
    private $conditions;

    /**
     * @ORM\Column(name="picture", type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(name="price", type="decimal")
     */
    private $price;

    /**
     * @ORM\Column(name="discount", type="decimal")
     */
    private $discount;

    /**
     * @ORM\Column(name="publication_date", type="datetime")
     */
    private $publicationDate;

    /**
     * @ORM\Column(name="expiration_date", type="datetime")
     */
    private $expirationDate;

    /**
     * @ORM\Column(name="shopping", type="integer")
     */
    private $shopping;

    /**
     * @ORM\Column(name="threshold", type="integer")
     */
    private $threshold;

    /**
     * @ORM\Column(name="checked", type="boolean")
     */
    private $checked;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="Shop")
     */
    private $shop;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Offer
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->slug = Util::getSlug($name);
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Offer
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Offer
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set conditions
     *
     * @param string $conditions
     * @return Offer
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;

        return $this;
    }

    /**
     * Get conditions
     *
     * @return string 
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return Offer
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Offer
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set discount
     *
     * @param string $discount
     * @return Offer
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return string 
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set publicationDate
     *
     * @param \DateTime $publicationDate
     * @return Offer
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Get publicationDate
     *
     * @return \DateTime 
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * Set expirationDate
     *
     * @param \DateTime $expirationDate
     * @return Offer
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * Get expirationDate
     *
     * @return \DateTime 
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * Set shopping
     *
     * @param integer $shopping
     * @return Offer
     */
    public function setShopping($shopping)
    {
        $this->shopping = $shopping;

        return $this;
    }

    /**
     * Get shopping
     *
     * @return integer 
     */
    public function getShopping()
    {
        return $this->shopping;
    }

    /**
     * Set threshold
     *
     * @param integer $threshold
     * @return Offer
     */
    public function setThreshold($threshold)
    {
        $this->threshold = $threshold;

        return $this;
    }

    /**
     * Get threshold
     *
     * @return integer 
     */
    public function getThreshold()
    {
        return $this->threshold;
    }

    /**
     * Set checked
     *
     * @param boolean $checked
     * @return Offer
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * Get checked
     *
     * @return boolean 
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Offer
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set shop
     *
     * @param string $shop
     * @return Offer
     */
    public function setShop($shop)
    {
        $this->shop = $shop;

        return $this;
    }

    /**
     * Get shop
     *
     * @return string 
     */
    public function getShop()
    {
        return $this->shop;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
