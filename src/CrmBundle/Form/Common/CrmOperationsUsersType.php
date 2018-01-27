<?php

namespace CrmBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use AppBundle\Entity\Classes\Utils;

class CrmOperationsUsersType extends AbstractType
{
    // for date
    public function setDate ($options) 
    {
        $date = $options->getDatedebut();
        $options->setDatedebut(is_object($date)?$date->format('Y-m-d'):'');
        $date = $options->getDatefin();
        $options->setDatefin(is_object($date)?$date->format('Y-m-d'):'');
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // for element
        $crms = Utils::Array_extract($options['dataForm']['crms'], ['key'=>'getLabel', 'value'=>'getId']);
        $etapes = Utils::Array_extract($options['dataForm']['etapes'], ['key'=>'getObjet', 'value'=>'getId']);
        $operations = Utils::Array_extract($options['dataForm']['operations'], ['key'=>'getLabel', 'value'=>'getId']);
        $roles_users = Utils::Array_extract($options['dataForm']['roles_users'], ['key'=>'getLabel', 'value'=>'getId']);

        // for date
        $this->setDate($options['data']);

        $builder
            ->add('idCRM', ChoiceType::class, ['choices' => $crms])
            ->add('idEtape', ChoiceType::class, ['choices' => $etapes])
            ->add('idOperation', ChoiceType::class, ['choices' => $operations])
            ->add('mission')
            ->add('datedebut', TextType::class, ['required' => false])
            ->add('datefin', TextType::class, ['required' => false])
            ->add('idUser', HiddenType::class)
            ->add('idRole', ChoiceType::class, ['choices' => $roles_users])
            ->add('flagActeur')
            ->add('flagInvite');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CrmBundle\Entity\Common\CrmOperationsUsers',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'crmbundle_common_crmoperationsusers';
    }


}
