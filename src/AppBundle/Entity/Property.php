<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Property
 *
 * @ORM\Table(name="property")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PropertyRepository")
 */
class Property
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
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var array
     *
     * @ORM\Column(name="options", type="json_array", nullable=true, unique=false)
     */
    private $options;

    /**
     * @ORM\ManyToOne(targetEntity="PropertyType")
     * @ORM\JoinColumn(name="property_type_id", referencedColumnName="id", nullable=false, unique=false)
     */
    private $propertyType;

    /**
     * @ORM\OneToMany(targetEntity="FranchiseeEntityTypeProperty", mappedBy="property", cascade={"ALL"})
     */
    private $properties;

    /**
     * @ORM\OneToMany(targetEntity="EmployeePropertyValue", mappedBy="property", cascade={"ALL"})
     */
    private $propertyValues;


    public function __construct()
    {
        $this->properties = new \Doctrine\Common\Collections\ArrayCollection();
        $this->propertyValues = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Property
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Property
     */
    public function setIsActive($isActive = false)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set options
     *
     * @param array $options
     *
     * @return Property
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set propertyType
     *
     * @param \AppBundle\Entity\PropertyType $propertyType
     *
     * @return Property
     */
    public function setPropertyType(\AppBundle\Entity\PropertyType $propertyType)
    {
        $this->propertyType = $propertyType;

        return $this;
    }

    /**
     * Get propertyType
     *
     * @return \AppBundle\Entity\PropertyType
     */
    public function getPropertyType()
    {
        return $this->propertyType;
    }

    public function addProperty(FranchiseeEntityTypeProperty $franchiseeProperty) {
        $this->properties[] = $franchiseeProperty;
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

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Property
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Add propertyValue
     *
     * @param \AppBundle\Entity\EmployeePropertyValue $propertyValue
     *
     * @return Property
     */
    public function addPropertyValue(\AppBundle\Entity\EmployeePropertyValue $propertyValue)
    {
        $this->propertyValues[] = $propertyValue;

        return $this;
    }

    /**
     * Remove propertyValue
     *
     * @param \AppBundle\Entity\EmployeePropertyValue $propertyValue
     */
    public function removePropertyValue(\AppBundle\Entity\EmployeePropertyValue $propertyValue)
    {
        $this->propertyValues->removeElement($propertyValue);
    }

    /**
     * Get propertyValues
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPropertyValues()
    {
        return $this->propertyValues;
    }
}
