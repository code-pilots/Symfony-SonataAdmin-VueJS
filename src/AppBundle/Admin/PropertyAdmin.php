<?php

namespace AppBundle\Admin;

use AppBundle\Entity\EntityType;
use AppBundle\Entity\Franchisee;
use AppBundle\Entity\FranchiseeEntityTypeProperty;
use AppBundle\Entity\Property;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PropertyAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var Property $oProperty */
        $oProperty = $this->getSubject();

//        $oFranchiseeProperty = $oProperty->getProperties()->offsetGet(0);
//        $oFranchisee = $oFranchiseeProperty ? $oFranchiseeProperty->getFranchisee() : null;
//        $oEntityType = $oFranchiseeProperty ? $oFranchiseeProperty->getEntityType() : null;

        $formMapper
            ->with('Основные настройки')
                ->add('isActive', CheckboxType::class, [
                    'label' => 'Свойство активно?',
                    'required' => false,
                ])
                ->add('title', 'text', [
                    'label' => 'Название',
                    'required' => false,
                ])
                ->add('propertyType', 'sonata_type_model', [
                    'label' => 'Тип',
                    'property' => 'title',
                    'required' => true,
                ])
            ->end()

            ->with('Для проверки (тесты)')
                ->add('franchisee', 'sonata_type_model', [
                    'label' => 'Франчайзи',
                    'class' => Franchisee::class,
//                    'data' => [$oFranchisee],
                    'property' => 'name',
                    'expanded' => false,
                    'multiple' => true,
                    'required' => true,
                    'mapped' => false,
                ])
                ->add('entityTypes', 'sonata_type_model', [
                    'label' => 'Тип сущности',
                    'class' => EntityType::class,
//                    'data' => [$oEntityType],
                    'property' => 'title',
                    'expanded' => false,
                    'multiple' => true,
                    'required' => true,
                    'mapped' => false,
                ])
//                ->add('properties', 'collection', [
//                    'entry_type' => FranchiseePropertyType::class,
//                    'by_reference' => false,
//                    'allow_add' => true,
//                    'entry_options' => [
//                        'property' => $oProperty,
//                    ],
//                ])
            ->end()
        ;
    }

//    public function prePersist($entity) {
//        /** @var Property $oProperty */
//        $oProperty = $entity;
//
//        if ($oProperty->getProperties()->count()) {
//            return;
//        }
//
//        $oFranchisee = $this->getForm()->get('franchisee')->getData()->offsetGet(0);
//        $oEntityType = $this->getForm()->get('entityTypes')->getData()->offsetGet(0);
//
//        $oFranchiseeProperty = new FranchiseeEntityTypeProperty($oFranchisee, $oEntityType, $oProperty);
//        $oProperty->addProperty($oFranchiseeProperty);
//    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', 'text', [
                'label' => 'Свойство',
            ])
            ->addIdentifier('isActive', 'boolean', [
                'label' => 'Активность',
            ])
            ->add('_action', 'actions', [
                'label' => 'Действия',
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ]
            ]);
    }
}