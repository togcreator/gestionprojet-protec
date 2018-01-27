<?php

namespace UsersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Classes\Utils;

class RelationBusinessUserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $relations = Utils::Array_extract($options['dataForm']['relationsFonctionnelles'], ['key' => 'getLabel', 'value' => 'getId']);
        $users = Utils::Array_extract($options['dataForm']['users'], ['key' => ['getFirstname', 'getLastname'], 'value' => 'getId']);
        $businessunits = Utils::Array_extract($options['dataForm']['businessunits'], ['key' => 'getNomBusinessUnit', 'value' => 'getId']);

        $builder
            ->add('iDUser', ChoiceType::class, ['choices' => $users])
            ->add('iDBusinessUnit', ChoiceType::class, ['choices' => $businessunits])
            ->add('iDRelation_Fonctionnelle', ChoiceType::class, ['choices' => $relations]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UsersBundle\Entity\RelationBusinessUser',
            'dataForm' => null
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'clientbundle_relationbusinessuser';
    }


}

