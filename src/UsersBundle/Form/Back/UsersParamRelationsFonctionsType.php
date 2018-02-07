<?php

namespace UsersBundle\Form\Back;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Classes\Utils;

class UsersParamRelationsFonctionsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $paramService = Utils::Array_extract($options['dataForm']['paramServices'], ['key' => 'getLabel', 'value' => 'getId']);

        $builder
            ->add('label', null, ['attr' => ['required' => true, 'maxlength' => 80]])
            ->add('iDService', ChoiceType::class, ['choices' => $paramService, 'attr' => ['required' => true]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UsersBundle\Entity\Back\UsersParamRelationsFonctions',
            'dataForm' => null
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'usersbundle_back_usersparamrelationsfonctions';
    }
}