<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * EmployeePropertyValue
 *
 * @ORM\Table(name="employee__property_value")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmployeePropertyValueRepository")
 */
class EmployeePropertyValue
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
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="employeePropertyValues")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     */
    private $employee;

    /**
     * @ORM\ManyToOne(targetEntity="FranchiseeEntityProperty")
     * @ORM\JoinColumn(name="franchisee_entity_property_id", referencedColumnName="id")
     */
    private $franchiseeEntityProperty;


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
     * Set value
     *
     * @param string $value
     *
     * @return EmployeePropertyValue
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
     * Set employee
     *
     * @param \AppBundle\Entity\Employee $employee
     *
     * @return EmployeePropertyValue
     */
    public function setEmployee(\AppBundle\Entity\Employee $employee = null)
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * Get employee
     *
     * @return \AppBundle\Entity\Employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * Set franchiseeEntityProperty
     *
     * @param \AppBundle\Entity\FranchiseeEntityProperty $franchiseeEntityProperty
     *
     * @return EmployeePropertyValue
     */
    public function setFranchiseeEntityProperty(\AppBundle\Entity\FranchiseeEntityProperty $franchiseeEntityProperty = null)
    {
        $this->franchiseeEntityProperty = $franchiseeEntityProperty;

        return $this;
    }

    /**
     * Get franchiseeEntityProperty
     *
     * @return \AppBundle\Entity\FranchiseeEntityProperty
     */
    public function getFranchiseeEntityProperty()
    {
        return $this->franchiseeEntityProperty;
    }
}
