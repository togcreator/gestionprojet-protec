<?php

namespace CrmBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Classes\Utils;


class CrmFiltersType extends AbstractType
{   
    // setting date
    public function setDate($options) 
    {
        $date = $options->getDatedebutPrevueE();
        $options->setDatedebutPrevueE(is_object($date) ? $date->format('Y-m-d'): $date);

        $date = $options->getDatefinPrevueE();
        $options->setDatefinPrevueE(is_object($date) ? $date->format('Y-m-d'): $date);

        $date = $options->getDatedebutPrevueO();
        $options->setDatedebutPrevueO(is_object($date) ? $date->format('Y-m-d'): $date);

        $date = $options->getDatefinPrevueO();
        $options->setDatefinPrevueO(is_object($date) ? $date->format('Y-m-d'): $date);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // for entityJ
        $entityJs = Utils::Array_extract($options['dataForm']['entityJs'], ['key'=>'getName','value'=>'getId']);
        // statuts
        $statuts = Utils::Array_extract($options['dataForm']['statuts'], ['key'=>'getLabel','value'=>'getId']);
        // for mode acces
        $modeacces = Utils::Array_extract($options['dataForm']['modeacces'], ['key'=>'getLabel','value'=>'getId']);
        // roles
        $resultats = Utils::Array_extract($options['dataForm']['resultats'], ['key'=>'getLabel','value'=>'getId']);
        // priorites
        $priorites = Utils::Array_extract($options['dataForm']['priorites'], ['key'=>'getLabel','value'=>'getId']);
        // priorites
        $alerts = Utils::Array_extract($options['dataForm']['alerts'], ['key'=>'getLabel','value'=>'getId']);
        /* pour le titre en combox */
        $title = Utils::Array_extract($options['dataForm']['crmFilters'], ['key' => 'getLabel','value' => 'getId']);
        //====================================
        $contacts = Utils::Array_extract($options['dataForm']['contacts'], ['key'=>'getFirstname','value'=>'getId']);
        $businessUnits = Utils::Array_extract($options['dataForm']['businessUnits'], ['key'=>'getNomBusinessUnit','value' => 'getId']);
        $relationProfessionnelles = Utils::Array_extract($options['dataForm']['relationProfessionnelles'], ['key'=>'getLabel','value' => 'getId']);
        // date
        $this->setDate($options['data']);

        /* pour title */
        $dataClassTitle = $options['data']->getTitle() ? [] : null;
        /* variable builder */
        $builder
            /* combobox */
            ->add('title', ChoiceType::class, is_array($dataClassTitle) ? ['choices' => $title] : ['choices' => $title, 'data_class' => $dataClassTitle])
            /* projet */
            ->add('idEntiteJ', ChoiceType::class, ['choices' => $entityJs, 'required' => false])
            ->add('datedebutPrevueE', TextType::class, ['required' => false])
            ->add('datefinPrevueE', TextType::class, ['required' => false])
            ->add('datedebutPrevueO', TextType::class, ['required' => false])
            ->add('datefinPrevueO', TextType::class, ['required' => false])
            ->add('statut', ChoiceType::class, ['choices' => $statuts])
            ->add('modeAcces', HiddenType::class)
            ->add('idUser', HiddenType::class)
            ->add('idContact', ChoiceType::class, ['choices' => $contacts])
            /* etape */
            ->add('idResultat', HiddenType::class)
            ->add('idStatut', ChoiceType::class, ['choices' => $statuts])
            /* operation */
            ->add('idStatutO', ChoiceType::class, ['choices' => $statuts])
            ->add('idResultatO', HiddenType::class)
            ->add('idPriorite', ChoiceType::class, ['choices' => $priorites])
            ->add('idBusinessUnit', ChoiceType::class, ['choices' => $businessUnits])
            ->add('idRelationProfessionnelles', ChoiceType::class, ['choices' => $relationProfessionnelles])
            ->add('idAlerte', HiddenType::class)
            /* tri */
            ->add('tri', ChoiceType::class, ['choices' => [
                'global.sort_by' => 0, 
                'global.idStatut' => 'idStatut', 
                'global.datefinprevue' => 'datefinprevue',
                ]])
            /* sauvegarde */
            ->add('mode', HiddenType::class) /* 1 vaut edition 0 pour ajout */
            ->add('label', null, ['attr' => ['maxlength' => 80]])
            ->add('flagprive', ChoiceType::class, ['choices' => ['global.yes' => 1, 'global.no' => 0]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CrmBundle\Entity\Common\CrmFilters',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'CrmBundle_common_crmsfilters';
    }
}
