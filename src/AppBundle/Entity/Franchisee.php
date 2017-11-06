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
     * @ORM\OneToMany(targetEntity="FranchiseeEntityTypeProperty", mappedBy="franchisee", cascade={"ALL"})
     */
    private $properties;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->properties = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function addProperty(EntityType $entityType, Property $property) {
        $this->properties[] = new FranchiseeEntityTypeProperty($this, $entityType, $property);
    }

    /**
     * Remove property
     *
     * @param \AppBundle\Entity\FranchiseeEntityTypeProperty $property
     */
    public function removeProperty(\AppBundle\Entity\FranchiseeEntityTypeProperty $property)
    {
        $this->properties->removeElement($property);
    }

    /**
     * Get properties
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProperties()
    {
        return $this->properties;
    }
}
