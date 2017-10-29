<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FranchEntityProperty
 *
 * @ORM\Table(name="franch_entity_property")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FranchEntityPropertyRepository")
 */
class FranchEntityProperty
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
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="Franch", inversedBy="entityProperties")
     * @ORM\JoinColumn(name="franch_id", referencedColumnName="id")
     */
    private $franch;

    /**
     * @ORM\OneToOne(targetEntity="EntityType")
     * @ORM\JoinColumn(name="entity_type_id", referencedColumnName="id", unique=false)
     */
    private $entityType;

    /**
     * @ORM\OneToOne(targetEntity="PropertyType")
     * @ORM\JoinColumn(name="property_type_id", referencedColumnName="id", unique=false)
     */
    private $propertyType;


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
     * @return FranchEntityProperty
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
     * Set franch
     *
     * @param \AppBundle\Entity\Franch $franch
     *
     * @return FranchEntityProperty
     */
    public function setFranch(\AppBundle\Entity\Franch $franch)
    {
        $this->franch = $franch;

        return $this;
    }

    /**
     * Get franch
     *
     * @return \AppBundle\Entity\Franch
     */
    public function getFranch()
    {
        return $this->franch;
    }

    /**
     * Set entityType
     *
     * @param \AppBundle\Entity\EntityType $entityType
     *
     * @return FranchEntityProperty
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
     * Set propertyType
     *
     * @param \AppBundle\Entity\PropertyType $propertyType
     *
     * @return FranchEntityProperty
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

    /**
     * Set code
     *
     * @param string $code
     *
     * @return FranchEntityProperty
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
}
