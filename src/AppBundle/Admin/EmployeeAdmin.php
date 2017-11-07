<?php

namespace AppBundle\Admin;


use AppBundle\Entity\Employee;
use AppBundle\Entity\EmployeePropertyValue;
use AppBundle\Entity\FranchiseeEntityTypeProperty;
use AppBundle\Entity\Property;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\DoctrineORMAdminBundle\Filter\CallbackFilter;

class EmployeeAdmin extends AbstractAdmin
{
    public function configure()
    {
        parent::configure();
        $this->classnameLabel = 'Работники';
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var Employee $oEmployee */
        $oEmployee = $this->getSubject();
        $cPropertyValues = $oEmployee->getProperties();

        $aPropertyValues = [];
        foreach ($cPropertyValues as $oPropertyValue) {
            $oProperty = $oPropertyValue->getProperty();
            $aPropertyValues[$oProperty->getId()] = $oPropertyValue;
        }

        $formMapper
            ->with('General')
                ->add('firstname', 'text')
                ->add('lastname', 'text')
                ->add('middlename', 'text')
            ->end()
        ;

        $aPropertyKeys = [];
        $aFranchiseeEntityTypeProperties = $this->getProperties();

        /** @var FranchiseeEntityTypeProperty $oFranchiseeEntityTypeProperty */
        foreach ($aFranchiseeEntityTypeProperties as $oFranchiseeEntityTypeProperty) {
            /** @var Property $oProperty */
            $oProperty = $oFranchiseeEntityTypeProperty->getProperty();
            
            $aPropertyKeys[] = [
                $oProperty->getCode(),
                'text', // @TODO: $oProperty->getPropertyType()->getCode()
                [
                    'label' => $oProperty->getTitle(),
                    'data' => !empty($aPropertyValues[$oProperty->getId()]) ? $aPropertyValues[$oProperty->getId()]->getValue() : '',
                ]
            ];
        }

        $formMapper
            ->with('Дополнительные свойства')
                ->add('properties', 'sonata_type_immutable_array', [
                    'label' => false,
                    'mapped' => false,
                    'keys' => $aPropertyKeys,
                ])
            ->end()
        ;
    }

    // @todo: изменение полей
    public function prePersist($entity) {
        /** @var Employee $oEmployee */
        $oEmployee = $entity;

        $aFranchiseeEntityTypeProperties = $this->getProperties();
        $aFormProperties = $this->getForm()->get('properties')->getData();

        /** @var FranchiseeEntityTypeProperty $oFranchiseeEntityTypeProperty */
        foreach ($aFranchiseeEntityTypeProperties as $oFranchiseeEntityTypeProperty) {
            /** @var Property $oProperty */
            $oProperty = $oFranchiseeEntityTypeProperty->getProperty();
            $sPropertyCode = $oProperty->getCode();

            if (!isset($aFormProperties[$sPropertyCode]) || empty($aFormProperties[$sPropertyCode])) {
                continue;
            }

            $mPropertyValue = $aFormProperties[$sPropertyCode];
            $oEmployeePropertyValue = new EmployeePropertyValue($oEmployee, $oProperty, $mPropertyValue);
            $oEmployee->addProperty($oEmployeePropertyValue);
        }
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        // conditional validation, see the related section for more information
        // abstract cannot be empty when the post is enabled
//        if ($object->getEnabled()) {
            $errorElement
                ->with('firstname')
                    ->assertNotBlank(['message' => 'asdasd'])
                    ->assertNotNull(['message' => 'ddddddd'])
                ->end()
            ;
//        }
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('firstname')
            ->add('lastname')
            ->add('middlename')
        ;

        $aFranchiseeEntityTypeProperties = $this->getProperties();

        /** @var FranchiseeEntityTypeProperty $oFranchiseeEntityTypeProperty */
        foreach ($aFranchiseeEntityTypeProperties as $oFranchiseeEntityTypeProperty) {
            /** @var Property $oProperty */
            $oProperty = $oFranchiseeEntityTypeProperty->getProperty();

            $datagridMapper->add($oProperty->getCode(), CallbackFilter::class, [
                'label' => $oProperty->getTitle(),
                'callback' => [$this, 'getCustomPropertyFilter'],
                'field_type' => 'text',
                'advanced_filter' => false,
            ]);
        }
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('firstname')
            ->addIdentifier('lastname')
            ->addIdentifier('middlename')
            ->add('properties.value')
            ->add('customFields', 'string', [
                'label' => 'Дополнительные свойства',
                'template' => ':Admin/entity_list:custom_column.html.twig',
            ])
        ;

        $listMapper->add('_action', 'actions', [
            'label' => 'Действия',
            'actions' => [
                'edit' => [],
                'delete' => [],
            ]
        ]);
    }

    /**
     * SELECT * FROM employee e
     * LEFT JOIN employee__property_value epv ON epv.property_id = (SELECT id FROM property WHERE property.code = 'rost')
     * WHERE epv.employee_id = e.id AND epv.value LIKE '%180%';
     */
    public function getCustomPropertyFilter($queryBuilder, $alias, $field, $value) {
        if (empty($value['value'])) return;

        /** @var QueryBuilder $queryBuilder */
        $queryBuilder
            ->where("{$alias}.properties.property = :test")
            ->setParameter('test', 3)
        ;
    }

    private function getProperties() {
        $em = $this->modelManager->getEntityManager(FranchiseeEntityTypeProperty::class);
        return $em->getRepository(FranchiseeEntityTypeProperty::class)->findBy([
            'franchisee' => 1,
            'entityType' => 1,
        ]);
    }
}