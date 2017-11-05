<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmployeeRepository")
 */
class Employee
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
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="middlename", type="string", length=255)
     */
    private $middlename;

    /**
     * @ORM\OneToMany(targetEntity="EmployeePropertyValue", mappedBy="employee")
     */
    private $employeePropertyValues;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->employeePropertyValues = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Employee
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Employee
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set middlename
     *
     * @param string $middlename
     *
     * @return Employee
     */
    public function setMiddlename($middlename)
    {
        $this->middlename = $middlename;

        return $this;
    }

    /**
     * Get middlename
     *
     * @return string
     */
    public function getMiddlename()
    {
        return $this->middlename;
    }

    /**
     * Add employeePropertyValue
     *
     * @param \AppBundle\Entity\EmployeePropertyValue $employeePropertyValue
     *
     * @return Employee
     */
    public function addEmployeePropertyValue(\AppBundle\Entity\EmployeePropertyValue $employeePropertyValue)
    {
        $this->employeePropertyValues[] = $employeePropertyValue;

        return $this;
    }

    /**
     * Remove employeePropertyValue
     *
     * @param \AppBundle\Entity\EmployeePropertyValue $employeePropertyValue
     */
    public function removeEmployeePropertyValue(\AppBundle\Entity\EmployeePropertyValue $employeePropertyValue)
    {
        $this->employeePropertyValues->removeElement($employeePropertyValue);
    }

    /**
     * Get employeePropertyValues
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmployeePropertyValues()
    {
        return $this->employeePropertyValues;
    }
}
