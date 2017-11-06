<?php

namespace AppBundle\Admin;


use AppBundle\Entity\FranchiseeEntityTypeProperty;
use AppBundle\Form\Type\CustomPropertyType;
use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\DoctrineORMAdminBundle\Filter\CallbackFilter;

class EmployeeAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('firstname', 'text')
                ->add('lastname', 'text')
                ->add('middlename', 'text')
            ->end()
        ;

        $aProperties = $this->getProperties();

        /** @var FranchiseeEntityTypeProperty $oProperty */
        $aPropertyKeys = [];
        foreach ($aProperties as $oProperty) {
            $aPropertyKeys[] = [
                $oProperty->getCode(),
                $oProperty->getPropertyType()->getCode(),
                [
                    'label' => $oProperty->getTitle(),
                ]
            ];
        }

        $formMapper
            ->with('Дополнительные свойства')
                ->add('propertyValues', 'sonata_type_immutable_array', [
                    'label' => false,
                    'keys' => $aPropertyKeys,
                ])
            ->end()
        ;
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

        $aProperties = $this->getProperties();

        /** @var FranchiseeEntityTypeProperty $oProperty */
        foreach ($aProperties as $oProperty) {
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
        ;

        $aProperties = $this->getProperties();

        /** @var FranchiseeEntityTypeProperty $oProperty */
        foreach ($aProperties as $oProperty) {
            $listMapper->add($oProperty->getCode(), 'string', [
                'label' => $oProperty->getTitle(),
                'template' => ':Admin/entity_list:custom_column.html.twig',
            ]);
        }

        $listMapper->add('_action', 'actions', [
            'label' => 'Действия',
            'actions' => [
                'edit' => [],
                'delete' => [],
            ]
        ]);
    }

    public function getCustomPropertyFilter($queryBuilder, $alias, $field, $value) {
        if (!$value['value']['start']) return;

        /** @var QueryBuilder $queryBuilder */
        $queryBuilder->where($alias.'.createdAt BETWEEN :start_day AND :finish_day')
            ->setParameters([
                'start_day' => $value['value']['start'],
                'finish_day' => $value['value']['end'],
            ]);
        return true;
    }

    private function getProperties() {
        $em = $this->modelManager->getEntityManager(FranchiseeEntityTypeProperty::class);
        return $em->getRepository(FranchiseeEntityTypeProperty::class)->findAll();
    }
}