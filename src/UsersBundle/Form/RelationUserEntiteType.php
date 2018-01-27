<?php

namespace UsersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Classes\Utils;

class RelationUserEntiteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $entites = Utils::Array_extract($options['dataForm']['entites'], ['key' => 'getRaisonSociale', 'value' => 'getId']);
        $relation_fonction = Utils::Array_extract($options['dataForm']['relation_fonction'], ['key' => 'getLabel', 'value' => 'getId']);
        $users = Utils::Array_extract($options['dataForm']['users'], ['key' => ['getFirstname', 'getLastname'], 'value' => 'getId']);

        $builder
            ->add('idEntiteJ', ChoiceType::class, ['choices' => $entites])
            ->add('iDUser', ChoiceType::class, ['choices' => $users])
            ->add('iDRelation_Fonctionnelle', ChoiceType::class, ['choices' => $relation_fonction]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UsersBundle\Entity\RelationUserEntite',
            'dataForm' => null
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'clientbundle_relationuserentite';
    }


}
