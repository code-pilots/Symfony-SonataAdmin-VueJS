<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Franchisee
 *
 * @ORM\Table(name="franchisee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FranchiseeRepository")
 */
class Franchisee
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="FranchiseeEntityProperty", mappedBy="franchisee")
     */
    private $franchiseeEntityProperties;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->franchiseeEntityProperties = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Franchisee
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
     * Add franchiseeEntityProperty
     *
     * @param \AppBundle\Entity\FranchiseeEntityProperty $franchiseeEntityProperty
     *
     * @return Franchisee
     */
    public function addFranchiseeEntityProperty(\AppBundle\Entity\FranchiseeEntityProperty $franchiseeEntityProperty)
    {
        $this->franchiseeEntityProperties[] = $franchiseeEntityProperty;

        return $this;
    }

    /**
     * Remove franchiseeEntityProperty
     *
     * @param \AppBundle\Entity\FranchiseeEntityProperty $franchiseeEntityProperty
     */
    public function removeFranchiseeEntityProperty(\AppBundle\Entity\FranchiseeEntityProperty $franchiseeEntityProperty)
    {
        $this->franchiseeEntityProperties->removeElement($franchiseeEntityProperty);
    }

    /**
     * Get franchiseeEntityProperties
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFranchiseeEntityProperties()
    {
        return $this->franchiseeEntityProperties;
    }
}
