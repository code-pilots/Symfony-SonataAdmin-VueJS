<?php
namespace AppBundle\Form\Type;


use AppBundle\Entity\Property;
use Sonata\CoreBundle\Form\Type\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('propertyType', EntityType::class, [
                'class' => \AppBundle\Entity\PropertyType::class,
                'choice_label' => 'title',
                'required' => true,
            ])
            ->add('title', TextType::class, [
                'required' => false,
            ])
            ->add('isActive', BooleanType::class, [
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