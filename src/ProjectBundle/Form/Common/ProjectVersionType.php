<?php

namespace ProjectBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ProjectVersionType extends AbstractType
{
    // setting project
    public function setProject ($options) {
        $project = [];
        foreach($options as $projet)
            $project[ucFirst($projet->getLib0())] = $projet->getId();
        return $project;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // dd
        $dd = $options['data']->getDatedebut();
        $options['data']->setDatedebut($dd?$dd->format('Y-m-d'):'');
        // df
        $df = $options['data']->getDatefin();
        $options['data']->setDatefin($df?$df->format('Y-m-d'):'');

        $builder
            ->add('idProjet', ChoiceType::class, ['choices'=>$this->setProject($options['projects'])])
            ->add('code')
            ->add('label')
            ->add('reference')
            ->add('description', TextareaType::class)
            ->add('idCreateur', HiddenType::class)
            ->add('datedebut', TextType::class)
            ->add('datefin', TextType::class)
            ->add('statut')
            ->add('idLeader')
            ->add('idArchitecte')
            ->add('idSupportFonctionnel')
            ->add('idSupportTechnique')
            ->add('idReferentDirection')
            ->add('idReferentUtilisateurs')
            ->add('idSupportTests')
            ->add('idSupportDeploiement')
            ->add('joursHommesPrevus')
            ->add('joursHommesReels');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Common\ProjectVersion',
            'projects' => null
        ))
        ->setRequired('projects')
        ->setAllowedTypes('projects', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectbundle_common_projectversion';
    }


}
