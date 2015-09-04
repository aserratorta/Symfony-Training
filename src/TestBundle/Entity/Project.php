<?php

namespace TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="project")
 */
class Project
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
    private $title;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $authorname;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $authorsurname;

    /**
     * @ORM\Column(type="date")
     */
    private $redaction;


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
     * Set title
     *
     * @param string $title
     * @return Project
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set authorname
     *
     * @param string $authorname
     * @return Project
     */
    public function setAuthorname($authorname)
    {
        $this->authorname = $authorname;

        return $this;
    }

    /**
     * Get authorname
     *
     * @return string 
     */
    public function getAuthorname()
    {
        return $this->authorname;
    }

    /**
     * Set authorsurname
     *
     * @param string $authorsurname
     * @return Project
     */
    public function setAuthorsurname($authorsurname)
    {
        $this->authorsurname = $authorsurname;

        return $this->authorsurname;
    }

    /**
     * get redaction
     *
     * @return mixed
     */
    public function getRedaction()
    {
        return $this->redaction;
    }

    /**
     * Set redaction
     *
     * @param mixed $redaction
     * @return Project
     */
    public function setRedaction($redaction)
    {
        $this->redaction = $redaction;

        return $this;
    }
}
