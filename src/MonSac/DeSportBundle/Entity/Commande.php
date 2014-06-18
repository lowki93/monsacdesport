<?php

namespace MonSac\DeSportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="num_commande", type="string", length=255)
     */
    private $numCommande;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=20)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sentAt", type="datetime")
     */
    private $sentAt;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="commandes")
     */
    protected $owner;

    /**
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="commandes")
     */
    protected $products;


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
     * Set numCommande
     *
     * @param string $numCommande
     * @return Commande
     */
    public function setNumCommande($numCommande)
    {
        $this->numCommande = $numCommande;

        return $this;
    }

    /**
     * Get numCommande
     *
     * @return string 
     */
    public function getNumCommande()
    {
        return $this->numCommande;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Commande
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set sentAt
     *
     * @param \DateTime $sentAt
     * @return Commande
     */
    public function setSentAt($sentAt)
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    /**
     * Get sentAt
     *
     * @return \DateTime 
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set customer
     *
     * @param \MonSac\DeSportBundle\Entity\User $customer
     * @return Commande
     */
    public function setCustomer(\MonSac\DeSportBundle\Entity\User $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \MonSac\DeSportBundle\Entity\User 
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Add products
     *
     * @param \MonSac\DeSportBundle\Entity\Product $products
     * @return Commande
     */
    public function addProduct(\MonSac\DeSportBundle\Entity\Product $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \MonSac\DeSportBundle\Entity\Product $products
     */
    public function removeProduct(\MonSac\DeSportBundle\Entity\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set owner
     *
     * @param \MonSac\DeSportBundle\Entity\User $owner
     * @return Commande
     */
    public function setOwner(\MonSac\DeSportBundle\Entity\User $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \MonSac\DeSportBundle\Entity\User 
     */
    public function getOwner()
    {
        return $this->owner;
    }
}
