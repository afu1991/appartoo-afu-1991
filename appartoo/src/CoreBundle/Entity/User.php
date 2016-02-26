<?php
// src/AppBundle/Entity/User.php

namespace CoreBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\UserRepository")
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\CarnetAdresse", mappedBy="user", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $carnetAdresses;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @Assert\Regex(pattern= "/[0-9]/")
     *
     * @ORM\Column(name="number", type="integer", nullable=true)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="web_address", type="string", length=255, nullable=true)
     */
    private $web_address;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set address
     *
     * @param string $address
     *
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
     * Set number
     *
     * @param integer $number
     *
     * @return User
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set webAddress
     *
     * @param string $webAddress
     *
     * @return User
     */
    public function setWebAddress($webAddress)
    {
        $this->web_address = $webAddress;

        return $this;
    }

    /**
     * Get webAddress
     *
     * @return string
     */
    public function getWebAddress()
    {
        return $this->web_address;
    }

    /**
     * Add carnetAdress
     *
     * @param \CoreBundle\Entity\CarnetAdresse $carnetAdress
     *
     * @return User
     */
    public function addCarnetAdress(\CoreBundle\Entity\CarnetAdresse $carnetAdress)
    {
        $this->carnetAdresses[] = $carnetAdress;

        return $this;
    }

    /**
     * Remove carnetAdress
     *
     * @param \CoreBundle\Entity\CarnetAdresse $carnetAdress
     */
    public function removeCarnetAdress(\CoreBundle\Entity\CarnetAdresse $carnetAdress)
    {
        $this->carnetAdresses->removeElement($carnetAdress);
    }

    /**
     * Get carnetAdresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCarnetAdresses()
    {
        return $this->carnetAdresses;
    }
}
