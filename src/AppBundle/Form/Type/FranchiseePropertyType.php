<?php
namespace AppBundle\Form\Type;


use AppBundle\Entity\Franchisee;
use AppBundle\Entity\EntityType;
use AppBundle\Entity\FranchiseeEntityTypeProperty;
use AppBundle\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FranchiseePropertyType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('franchisee', 'entity', [
                'class' => Franchisee::class,
                'choice_label' => 'name',
                'required' => true,
            ])
            ->add('entityType', 'entity', [
                'class' => EntityType::class,
                'choice_label' => 'title',
                'required' => true,
            ])
            ->add('property', 'entity', [
                'class' => Property::class,
                'choice_label' => 'title',
                'choice_value' => $options['property']->getId(),
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(['data_class' => FranchiseeEntityTypeProperty::class, 'property' => new Property()])
        ;
    }
}