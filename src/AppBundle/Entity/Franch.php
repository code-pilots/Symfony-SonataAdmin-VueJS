<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Franch
 *
 * @ORM\Table(name="franch")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FranchRepository")
 */
class Franch
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
     * @ORM\OneToMany(targetEntity="FranchEntityProperty", mappedBy="franch")
     */
    private $entityProperties;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->entityProperties = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Franch
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
     * Add entityProperty
     *
     * @param \AppBundle\Entity\FranchEntityProperty $entityProperty
     *
     * @return Franch
     */
    public function addEntityProperty(\AppBundle\Entity\FranchEntityProperty $entityProperty)
    {
        $this->entityProperties[] = $entityProperty;

        return $this;
    }

    /**
     * Remove entityProperty
     *
     * @param \AppBundle\Entity\FranchEntityProperty $entityProperty
     */
    public function removeEntityProperty(\AppBundle\Entity\FranchEntityProperty $entityProperty)
    {
        $this->entityProperties->removeElement($entityProperty);
    }

    /**
     * Get entityProperties
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntityProperties()
    {
        return $this->entityProperties;
    }
}
