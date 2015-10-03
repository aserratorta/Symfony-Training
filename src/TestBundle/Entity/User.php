<?php

namespace TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="user"))
 * @ORM\Entity
 */
class User
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
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @ORM\Column(name="address", type="text")
     */
    private $address;

    /**
     * @ORM\Column(name="email_allows", type="boolean")
     */
    private $emailAllows;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="discharge_date", type="datetime")
     */
    private $dischargeDate;

    /**
     * @ORM\Column(name="birth_date", type="datetime")
     */
    private $birthDate;

    /**
     * @ORM\Column(name="dni", type="string", length=9)
     */
    private $dni;

    /**
     * @ORM\Column(name="credit_number", type="string", length=20)
     */
    private $creditNumber;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     */
    private $city;


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
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set emailAllows
     *
     * @param boolean $emailAllows
     * @return User
     */
    public function setEmailAllows($emailAllows)
    {
        $this->emailAllows = $emailAllows;

        return $this;
    }

    /**
     * Get emailAllows
     *
     * @return boolean 
     */
    public function getEmailAllows()
    {
        return $this->emailAllows;
    }

    /**
     * Set dischargeDate
     *
     * @param \DateTime $dischargeDate
     * @return User
     */
    public function setDischargeDate($dischargeDate)
    {
        $this->dischargeDate = $dischargeDate;

        return $this;
    }

    /**
     * Get dischargeDate
     *
     * @return \DateTime 
     */
    public function getDischargeDate()
    {
        return $this->dischargeDate;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     * @return User
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime 
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set dni
     *
     * @param string $dni
     * @return User
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set creditNumber
     *
     * @param string $creditNumber
     * @return User
     */
    public function setCreditNumber($creditNumber)
    {
        $this->creditNumber = $creditNumber;

        return $this;
    }

    /**
     * Get creditNumber
     *
     * @return string 
     */
    public function getCreditNumber()
    {
        return $this->creditNumber;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return User
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

    public function __toString()
    {
        return $this->getName().' '.$this->getSurname();
    }

    public function __construct()
    {
        $this->discharge_date = new \DateTime();
    }
}
