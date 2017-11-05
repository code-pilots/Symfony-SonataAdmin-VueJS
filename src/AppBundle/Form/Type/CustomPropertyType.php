<?php
namespace AppBundle\Form\Type;


use AppBundle\Entity\EmployeePropertyValue;
use AppBundle\Entity\FranchiseeEntityProperty;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomPropertyType extends AbstractType
{
    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    /**
     * Получить список кастомных свойств по franch_id + entity_type_id + entity_id
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $aProperties = $this->em->getRepository(FranchiseeEntityProperty::class)->findBy([
            'entityType' => 1,
        ]);

        $aPropertyValues = $this->em->getRepository(EmployeePropertyValue::class)->findBy([
            'entity' => $options['entity'],
//            'entityType' => 1,
        ]);

        $aPropertyValuesByPropertyId = [];
        /** @var EmployeePropertyValue $oPropertyValue */
        foreach ($aPropertyValues as $oPropertyValue) {
            $iPropertyId = $oPropertyValue->getProperty()->getId();
            $aPropertyValuesByPropertyId[$iPropertyId] = $oPropertyValue;
        }

        /** @var FranchiseeEntityProperty $oProperty */
        foreach ($aProperties as $oProperty) {
            $iPropertyId = $oProperty->getId();
            $mPropertyValue = isset($aPropertyValuesByPropertyId[$iPropertyId]) ? $aPropertyValuesByPropertyId[$iPropertyId]->getValue() : null;

            $builder
                ->add($oProperty->getCode(), TextType::class, [
                    'label' => $oProperty->getTitle(),
                    'data' => $mPropertyValue,
                    'mapped' => false,
                    'required' => true,
                ])
            ;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(['data_class' => null])
            ->setRequired(['entity'])
        ;
    }
}