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
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="properties")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     */
    private $employee;

    /**
     * @ORM\ManyToOne(targetEntity="Property", inversedBy="propertyValues")
     * @ORM\JoinColumn(name="property_id", referencedColumnName="id")
     */
    private $property;


    public function __construct(Employee $employee, Property $property, $value) {
        $this->employee = $employee;
        $this->property = $property;
        $this->value = $value;
    }

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
    public function setEmployee(\AppBundle\Entity\Employee $employee)
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
     * Set property
     *
     * @param \AppBundle\Entity\Property $property
     *
     * @return EmployeePropertyValue
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
