<?php

namespace UsersBundle\Form\Back;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Classes\Utils;

class UsersParamRelationsProfessionnellesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /* nature liste */
        $natures = Utils::Array_extract($options['dataForm']['natures'], ['key' => 'getlabel', 'value' => 'getId']);

        $builder
            ->add('IDNatureUser', CHoiceType::class, ['choices' => $natures, 'attr' => ['required' => true]])
            ->add('label', null, ['attr' => ['required' => true, 'maxlength' => 80]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UsersBundle\Entity\Back\UsersParamRelationsProfessionnelles',
            'dataForm' => null,
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