<?php

namespace ProjectBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use AppBundle\Entity\Classes\Utils;

class ProjectDocsType extends AbstractType
{
    // for date
    public function setDate ($options) 
    {
        $date = $options->getDateReception();
        $options->setDateReception(is_object($date)?$date->format('Y-m-d'):'');
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        // for date
        $this->setDate($options['data']);
        $nomdoc = $options['data']->getNomdoc() ? ['data_class' => null] : [];
        $projects = Utils::Array_extract($options['dataForm']['projects'], ['key'=>'getLabel', 'value' => 'getId']);
        $etapes = Utils::Array_extract($options['dataForm']['etapes'], ['key' => 'getObject', 'value' => 'getId']);
        $operations = Utils::Array_extract($options['dataForm']['operations'], ['key' => 'getObject', 'value' => 'getId']);
        $issues = Utils::Array_extract($options['dataForm']['issues'], ['key' => 'getLibelle', 'value' => 'getId']);

        // pour disable le projet
        $pDisabled = (isset($_GET['flag']) && $options['data']->getIdProjet()) || ($options['data']->getId() && $options['data']->getIdProjet()) ? ['disabled' => true] : [];
        // pour disable etapes
        $eDisabled = $options['data']->getId() && $options['data']->getIdEtape() ? ['disabled' => true] : [];
        // pour disable operations
        $oDisabled = $options['data']->getId() && $options['data']->getIdOperation() ? ['disabled' => true] : [];
        // pour disable issue
        $iDisabled = $options['data']->getId() && $options['data']->getIdIssue() ? ['disabled' => true] : [];

        // build
        $builder
            ->add('idProjet', ChoiceType::class, ['choices' => $projects, 'attr' => array_merge(['required' => true], $pDisabled)])
            ->add('idEtape', ChoiceType::class, ['choices' => $etapes, 'attr' => $eDisabled])
            ->add('idOperation', ChoiceType::class, ['choices' => $operations, 'attr' => $oDisabled])
            ->add('idIssue', ChoiceType::class, ['choices' => $issues, 'attr' => $iDisabled])
            ->add('idTypedoc', HiddenType::class, ['attr' => ['value' => 0]])
            ->add('origine', null, ['required' => false])
            ->add('idUser', HiddenType::class)
            ->add('designation')
            ->add('nomdoc', FileType::class, array_merge(['required' => false], $nomdoc))
            ->add('dateReception', TextType::class, ['required' => false])
            ->add('referenceExterne', null, ['required' => false])
            ->add('reference', null, ['required' => false])
            ->add('nomRedacteurExterne')
            ->add('idBiblio', HiddenType::class, ['attr' => ['value' => 0]])
            ->add('version', HiddenType::class, ['attr' => ['value' => 0]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Common\ProjectDocs',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'crmbundle_common_projectdocs';
    }


}
