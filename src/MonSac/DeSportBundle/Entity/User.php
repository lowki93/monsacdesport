<?php

namespace MonSac\DeSportBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text", name="first_name", length=255, nullable=true)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="text", name="last_name", length=255, nullable=true)
     */
    protected $lastName;

    /**
     * @ORM\Column(type="text", name="address", length=255, nullable=true)
     */
    protected $address;

    /**
     * @ORM\Column(type="text", name="zipcode", length=10, nullable=true)
     */
    protected $zipcode;

    /**
     * @ORM\Column(type="text", name="city", length=255, nullable=true)
     */
    protected $city;

    /**
     * @ORM\Column(type="text", name="phone", length=15, nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(type="text", name="complementary_info", nullable=true)
     */
    protected $complementary_info;

    /**
     * @ORM\OneToMany(targetEntity="Commande", mappedBy="owner")
     */
    protected $commandes;


    public function __construct()
    {
        parent::__construct();
    }

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
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
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
     * Set zipcode
     *
     * @param string $zipcode
     * @return User
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string 
     */
    public function getZipcode()
    {
        return $this->zipcode;
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

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set complementary_info
     *
     * @param \textarea $complementaryInfo
     * @return User
     */
    public function setComplementaryInfo(\textarea $complementaryInfo)
    {
        $this->complementary_info = $complementaryInfo;

        return $this;
    }

    /**
     * Get complementary_info
     *
     * @return \textarea 
     */
    public function getComplementaryInfo()
    {
        return $this->complementary_info;
    }

    /**
     * Add commandes
     *
     * @param \MonSac\DeSportBundle\Entity\Commande $commandes
     * @return User
     */
    public function addCommande(\MonSac\DeSportBundle\Entity\Commande $commandes)
    {
        $this->commandes[] = $commandes;

        return $this;
    }

    /**
     * Remove commandes
     *
     * @param \MonSac\DeSportBundle\Entity\Commande $commandes
     */
    public function removeCommande(\MonSac\DeSportBundle\Entity\Commande $commandes)
    {
        $this->commandes->removeElement($commandes);
    }

    /**
     * Get commandes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommandes()
    {
        return $this->commandes;
    }
}
