<?php

namespace ProjectBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use AppBundle\Entity\Classes\Utils;

class ProjectEtapesOperationsIssuesType extends AbstractType
{
    // setting date
    public function setDate ($options) 
    {
        $dd = $options->getDatedebut();
        $options->setDatedebut($dd?$dd->format('Y-m-d'):'');

        $df = $options->getDatefin();
        $options->setDatefin($df?$df->format('Y-m-d'):'');

        $ddc = $options->getDatedebutcorrection();
        $options->setDatedebutcorrection($ddc?$ddc->format('Y-m-d'):'');

        $dfc = $options->getDatefincorrection();
        $options->setDatefincorrection($dfc?$dfc->format('Y-m-d'):'');

        $ddv = $options->getDatedebutvalidation();
        $options->setDatedebutvalidation($ddv?$ddv->format('Y-m-d'):'');

        $dfv = $options->getDatefinvalidation();
        $options->setDatefinvalidation($dfv?$dfv->format('Y-m-d'):'');
    }

    // projet
    public function setProject($options) 
    {
        return Utils::Array_extract($options, ['key'=>'getLabel', 'value'=>'getId']);
    }

    // setting etapes
    public function setEtape ($options) 
    {
        return Utils::Array_extract($options, ['key'=>'getObject', 'value'=>'getId']);
    }

    // setting opération
    public function setOperation ($options) 
    {
        return Utils::Array_extract($options, ['key'=>'getObject', 'value'=>'getId']);
    }

    // setting pirorites
    public function setPriorites ($options) 
    {
        return Utils::Array_extract($options, ['key'=>'getLabel', 'value'=>'getId']);
    }

    // setting statut
    public function setStatut ($options) {
        return Utils::Array_extract($options, ['key'=>'getLabel', 'value'=>'getId']);
    }

    // setting statut
    public function setUser ($options) {
        return Utils::Array_extract($options, ['key'=>'getUsername', 'value'=>'getId']);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // setting data
        $this->setDate($options['data']);

        // pour disable le projet
        $pDisabled = $options['data']->getId() && $options['data']->getIdProjectVersion() ? ['disabled' => true] : [];
        // pour disable etapes
        $eDisabled = $options['data']->getId() && $options['data']->getIdEtape() ? ['disabled' => true] : [];
        // pour disable operations
        $oDisabled = $options['data']->getId() && $options['data']->getIdOperation() ? ['disabled' => true] : [];

        $builder
            ->add('idProjectVersion', ChoiceType::class, ['choices' => $this->setProject($options['dataForm']['projects']), 'attr' => array_merge(['required' => true], $pDisabled)])
            ->add('idEtape', ChoiceType::class, ['choices' => $this->setEtape($options['dataForm']['etapes']), 'attr' => $eDisabled])
            ->add('idOperation', ChoiceType::class, ['choices' => $this->setOperation($options['dataForm']['operations']), 'attr' => $oDisabled])
            ->add('idTypeIssue', HiddenType::class, ['attr' => ['value' => 1]])
            ->add('libelle')
            ->add('descriptionProbleme')
            ->add('descriptionCorrection')
            ->add('datedebut', TextType::class, ['required' => false])
            ->add('datefin', TextType::class, ['required' => false])
            ->add('datedebutcorrection', TextType::class, ['required' => false])
            ->add('datefincorrection', TextType::class, ['required' => false])
            ->add('datedebutvalidation', TextType::class, ['required' => false])
            ->add('datefinvalidation', TextType::class, ['required' => false])
            ->add('idUser4creation', HiddenType::class)
            ->add('idUser4correction', ChoiceType::class, ['choices' => $this->setUser($options['dataForm']['users']), 'attr' => ['required' => true]])
            ->add('idUser4validation', ChoiceType::class, ['choices' => $this->setUser($options['dataForm']['users']), 'attr' => ['required' => true]])
            ->add('idPriorite', ChoiceType::class, ['choices' => $this->setPriorites($options['dataForm']['priorites']), 'attr' => ['required' => true]])
            ->add('idStatut', ChoiceType::class, ['choices' => $this->setStatut($options['dataForm']['statuts']), 'attr' => ['required' => true]])
            ->add('idResolution', HiddenType::class, ['attr'=>['value'=>1]])
            ->add('version', HiddenType::class, ['attr'=>['value'=>1]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Common\ProjectEtapesOperationsIssues',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectbundle_ProjectEtapesOperationsissues';
    }


}
