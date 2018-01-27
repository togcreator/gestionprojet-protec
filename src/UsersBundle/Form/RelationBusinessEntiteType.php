<?php

namespace UsersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Classes\Utils;

class RelationBusinessEntiteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $relations = Utils::Array_extract($options['dataForm']['relationsProfessionnelles'], ['key' => 'getLabel', 'value' => 'getId']);
        $entites = Utils::Array_extract($options['dataForm']['entites'], ['key' => 'getRaisonSociale', 'value' => 'getId']);
        $businessunits = Utils::Array_extract($options['dataForm']['businessunits'], ['key' => 'getNomBusinessUnit', 'value' => 'getId']);

        $builder
            ->add('iDentite', ChoiceType::class, ['choices' => $entites, 'attr' => ['required' => true]])
            ->add('iDBusinessUnit', ChoiceType::class, ['choices' => $businessunits, 'attr' => ['required' => true]])
            ->add('iDRelationsProfessionnelles', ChoiceType::class, ['choices' => $relations, 'attr' => ['required' => true]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UsersBundle\Entity\RelationBusinessEntite',
            'dataForm' => null
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'clientbundle_relationbusinessentite';
    }


}
