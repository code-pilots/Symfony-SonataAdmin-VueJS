<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FranchiseeEntityTypeProperty
 *
 * @ORM\Table(name="franchisee__entity_type__property")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FranchiseeEntityTypePropertyRepository")
 */
class FranchiseeEntityTypeProperty
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
     * @ORM\ManyToOne(targetEntity="Franchisee", inversedBy="properties")
     * @ORM\JoinColumn(name="franchisee_id", referencedColumnName="id")
     */
    private $franchisee;

    /**
     * @ORM\ManyToOne(targetEntity="EntityType", inversedBy="properties")
     * @ORM\JoinColumn(name="entity_type_id", referencedColumnName="id")
     */
    private $entityType;

    /**
     * @ORM\ManyToOne(targetEntity="Property", inversedBy="properties")
     * @ORM\JoinColumn(name="property_id", referencedColumnName="id")
     */
    private $property;


    public function __construct(Franchisee $franchisee, EntityType $entityType, Property $property) {
        $this->franchisee = $franchisee;
        $this->entityType = $entityType;
        $this->property = $property;
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
     * Set franchisee
     *
     * @param \AppBundle\Entity\Franchisee $franchisee
     *
     * @return FranchiseeEntityTypeProperty
     */
    public function setFranchisee(\AppBundle\Entity\Franchisee $franchisee)
    {
        $this->franchisee = $franchisee;

        return $this;
    }

    /**
     * Get franchisee
     *
     * @return \AppBundle\Entity\Franchisee
     */
    public function getFranchisee()
    {
        return $this->franchisee;
    }

    /**
     * Set entityType
     *
     * @param \AppBundle\Entity\EntityType $entityType
     *
     * @return FranchiseeEntityTypeProperty
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
     * @return FranchiseeEntityTypeProperty
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
}
