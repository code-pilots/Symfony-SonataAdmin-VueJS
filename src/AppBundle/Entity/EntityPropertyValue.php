<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * EntityPropertyValue
 *
 * @ORM\Table(name="entity_property_value")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EntityPropertyValueRepository")
 */
class EntityPropertyValue
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
     * @ORM\Column(name="value", type="string", length=3000, nullable=true)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="propertyValues")
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id")
     */
    private $entity;

    /**
     * @ORM\OneToOne(targetEntity="FranchEntityProperty")
     * @ORM\JoinColumn(name="entity_property_id", referencedColumnName="id")
     */
    private $property;

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
     * Set value
     *
     * @param string $value
     *
     * @return EntityPropertyValue
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set entity
     *
     * @param \AppBundle\Entity\Employee $entity
     *
     * @return EntityPropertyValue
     */
    public function setEntity(\AppBundle\Entity\Employee $entity)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get entity
     *
     * @return \AppBundle\Entity\Employee
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set property
     *
     * @param \AppBundle\Entity\FranchEntityProperty $property
     *
     * @return EntityPropertyValue
     */
    public function setProperty(\AppBundle\Entity\FranchEntityProperty $property)
    {
        $this->property = $property;

        return $this;
    }

    /**
     * Get property
     *
     * @return \AppBundle\Entity\FranchEntityProperty
     */
    public function getProperty()
    {
        return $this->property;
    }
}
