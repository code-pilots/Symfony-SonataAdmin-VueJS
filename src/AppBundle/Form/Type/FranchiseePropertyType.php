<?php
namespace AppBundle\Form\Type;


use AppBundle\Entity\Property;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FranchiseePropertyType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('franchisee', EntityType::class, [
                'class' => \AppBundle\Entity\Franchisee::class,
                'choice_label' => 'name',
                'required' => true,
            ])
            ->add('entityType', EntityType::class, [
                'class' => \AppBundle\Entity\EntityType::class,
                'choice_label' => 'title',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(['data_class' => Property::class])
        ;
    }
}