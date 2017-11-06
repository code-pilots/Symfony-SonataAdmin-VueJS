<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntityTypeProperty
 *
 * @ORM\Table(name="entity_type__property")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EntityTypePropertyRepository")
 */
class EntityTypeProperty
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
     * @ORM\ManyToOne(targetEntity="EntityType")
     * @ORM\JoinColumn(name="entity_type_id", referencedColumnName="id", unique=false, nullable=false)
     */
    private $entityType;

    /**
     * @ORM\ManyToOne(targetEntity="Property")
     * @ORM\JoinColumn(name="property_id", referencedColumnName="id", unique=false, nullable=false)
     */
    private $property;

    /**
     * @ORM\ManyToMany(targetEntity="Franchisee", mappedBy="entityTypeProperties")
     */
    private $franchisee;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->franchisee = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set entityType
     *
     * @param \AppBundle\Entity\EntityType $entityType
     *
     * @return EntityTypeProperty
     */
    public function setEntityType(\AppBundle\Entity\EntityType $entityType)
    {
        $this->entityType = $entityType;

        return $this;
    }

    /**
     * Get entityType
     *
     * @return \AppBundle\Entity\EntityType
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * Set property
     *
     * @param \AppBundle\Entity\Property $property
     *
     * @return EntityTypeProperty
     */
    public function setProperty(\AppBundle\Entity\Property $property)
    {
        $this->property = $property;

        return $this;
    }

    /**
     * Get property
     *
     * @return \AppBundle\Entity\Property
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Add franchisee
     *
     * @param \AppBundle\Entity\Franchisee $franchisee
     *
     * @return EntityTypeProperty
     */
    public function addFranchisee(\AppBundle\Entity\Franchisee $franchisee)
    {
        $this->franchisee[] = $franchisee;

        return $this;
    }

    /**
     * Remove franchisee
     *
     * @param \AppBundle\Entity\Franchisee $franchisee
     */
    public function removeFranchisee(\AppBundle\Entity\Franchisee $franchisee)
    {
        $this->franchisee->removeElement($franchisee);
    }

    /**
     * Get franchisee
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFranchisee()
    {
        return $this->franchisee;
    }
}
