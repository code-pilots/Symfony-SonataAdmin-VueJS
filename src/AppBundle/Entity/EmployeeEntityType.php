<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmployeeEntityType
 *
 * @ORM\Table(name="employee__entity_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmployeeEntityTypeRepository")
 */
class EmployeeEntityType
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
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id", unique=false)
     */
    private $employee;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="EntityType")
     * @ORM\JoinColumn(name="entity_type_id", referencedColumnName="id", unique=false)
     */
    private $entityType;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

