<?php

namespace TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="project")
 */
class Proyecto
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titol;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nomautor;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $cognomautor;

    /**
     * @ORM\Column(type="date")
     */
    private $redaccio;


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
     * Set titol
     *
     * @param string $titol
     * @return Proyecto
     */
    public function setTitol($titol)
    {
        $this->titol = $titol;

        return $this;
    }

    /**
     * Get titol
     *
     * @return string 
     */
    public function getTitol()
    {
        return $this->titol;
    }

    /**
     * Set nomautor
     *
     * @param string $nomautor
     * @return Proyecto
     */
    public function setNomautor($nomautor)
    {
        $this->nomautor = $nomautor;

        return $this;
    }

    /**
     * Get nomautor
     *
     * @return string 
     */
    public function getNomautor()
    {
        return $this->nomautor;
    }

    /**
     * Set cognomautor
     *
     * @param string $cognomautor
     * @return Proyecto
     */
    public function setCognomautor($cognomautor)
    {
        $this->cognomautor = $cognomautor;

        return $this;
    }

    /**
     * Get cognomautor
     *
     * @return string 
     */
    public function getCognomautor()
    {
        return $this->cognomautor;
    }

    /**
     * Set redaccio
     *
     * @param \DateTime $redaccio
     * @return Proyecto
     */
    public function setRedaccio($redaccio)
    {
        $this->redaccio = $redaccio;

        return $this;
    }

    /**
     * Get redaccio
     *
     * @return \DateTime 
     */
    public function getRedaccio()
    {
        return $this->redaccio;
    }
}
