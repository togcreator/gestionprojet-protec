<?php

namespace ProjectBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use AppBundle\Entity\Classes\Utils;

class ProjectEtapesOperationsUsersType extends AbstractType
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
        $projects = Utils::Array_extract($options['dataForm']['projects'], ['key' => 'getLabel', 'value' => 'getId']);
        $etapes = Utils::Array_extract($options['dataForm']['etapes'], ['key' => 'getObject', 'value' => 'getId']);
        $operations = Utils::Array_extract($options['dataForm']['operations'], ['key' => 'getObject', 'value' => 'getId']);
        $roles = Utils::Array_extract($options['dataForm']['roles'], ['key' => 'getLabel', 'value' => 'getId']);
        $users = Utils::Array_extract($options['dataForm']['users'], ['key' => 'getUsername', 'value' => 'getId']);
        // for date
        $this->setDate($options['data']);
        // pour disable le projet
        $pDisabled = $options['data']->getId() && $options['data']->getIdProjetVersion() ? ['disabled' => true] : [];
        // pour disable le projet
        $oDisabled = $options['data']->getId() && $options['data']->getIdOperation() ? ['disabled' => true] : [];
        // pour user
        $uDisabled = $options['data']->getId() && $options['data']->getIdUser() ? ['disabled' => true] : [];

        $builder
            ->add('idProjetversion', ChoiceType::class, ['choices' => $projects, 'attr' => array_merge(['required' => true], $pDisabled)])
            ->add('idEtape', ChoiceType::class, ['choices' => $etapes])
            ->add('idOperation', ChoiceType::class, ['choices' => $operations, 'attr' => array_merge(['required' => true], $oDisabled)])
            ->add('mission', null, ['required' => false])
            ->add('datedebut', TextType::class, ['required' => false])
            ->add('datefin', TextType::class, ['required' => false])
            ->add('idUser', ChoiceType::class, ['choices' => $users, 'attr' => array_merge(['required' => true], $uDisabled)])
            ->add('idRole', ChoiceType::class, ['choices' => $roles])
            ->add('flagActeur', null, ['required' => false])
            ->add('flagInvite', null, ['required' => false]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Common\ProjectEtapesOperationsUsers',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectbundle_common_projectetapesoperationsusers';
    }


}
