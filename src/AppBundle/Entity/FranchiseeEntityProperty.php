<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * FranchiseeEntityProperty
 *
 * @ORM\Table(name="franchisee__entity_property", uniqueConstraints={@UniqueConstraint(name="property_uix", columns={"franchisee_id", "entityType", "property"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FranchiseeEntityPropertyRepository")
 */
class FranchiseeEntityProperty
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
     * @ORM\ManyToOne(targetEntity="Franchisee", inversedBy="franchiseeEntityProperties")
     * @ORM\JoinColumn(name="franchisee_id", referencedColumnName="id", unique=false, nullable=false)
     */
    private $franchisee;

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
     * Get id
     *
     * @return integer
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
     * @return FranchiseeEntityProperty
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
     * @return FranchiseeEntityProperty
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
     * @return FranchiseeEntityProperty
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
