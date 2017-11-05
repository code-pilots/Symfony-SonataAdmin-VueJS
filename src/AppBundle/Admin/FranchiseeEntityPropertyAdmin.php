<?php

namespace AppBundle\Admin;

use AppBundle\Form\Type\PropertyType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;

class FranchiseeEntityPropertyAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('franchisee', 'sonata_type_model', [
                'property' => 'name',
            ])
            ->add('entityType', 'sonata_type_model', [
                'property' => 'title',
            ])
            ->add('property', 'collection', [
                'entry_type' => PropertyType::class,
                'allow_add' => true,
            ])
        ;
    }

//    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
//    {
//        $datagridMapper
//            ->add('franchisee')
//        ;
//    }
//
//    protected function configureListFields(ListMapper $listMapper)
//    {
//        $listMapper
//            ->addIdentifier('franchisee')
//        ;
//    }
}