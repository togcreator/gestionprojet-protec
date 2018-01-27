<?php

namespace ProjectBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use AppBundle\Entity\Classes\Utils;

class ProjectEtapesOperationsIssuesRealisationsType extends AbstractType
{
    // date
    public function setDate($options) 
    {
        $da = $options->getDateafectation();
        $options->setDateafectation($da?$da->format('Y-m-d'):'');

        $dr = $options->getDaterealisation();
        $options->setDaterealisation($dr?$dr->format('Y-m-d'):'');
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // set project
        $projects = Utils::Array_extract($options['dataForm']['projects'], ['key'=>'getLabel', 'value'=>'getId']);
        $resultats = Utils::Array_extract($options['dataForm']['resultats'], ['key'=>'getLabel', 'value'=>'getId']);
        $users = Utils::Array_extract($options['dataForm']['users'], ['key'=>'getUsername', 'value'=>'getId']);
        $statuts = Utils::Array_extract($options['dataForm']['statuts'], ['key'=>'getLabel', 'value'=>'getId']);
        $etapes = Utils::Array_extract($options['dataForm']['etapes'], ['key'=>'getObject', 'value'=>'getId']);
        $issues = array_key_exists('issues', $options['dataForm']) ? Utils::Array_extract($options['dataForm']['issues'], ['key'=>'getLibelle', 'value'=>'getId']) : ['global.none' => 0];

        // for date
        $this->setDate($options['data']);

        /* disabled project */
        $pdisabled = $options['data']->getId() && $options['data']->getIdProjetVersion() ? ['disabled' => true] : [];
        $edisabled = $options['data']->getId() && $options['data']->getIdEtape() ? ['disabled' => true] : [];
        $idisabled = $options['data']->getId() && $options['data']->getIdIssue() ? ['disabled' =>  true] : [];

        dump($options['data']);

        $builder
            ->add('idProjetVersion', ChoiceType::class, ['choices' => $projects, 'attr' => $pdisabled])
            ->add('idEtape', ChoiceType::class, ['choices' => $etapes, 'attr' => $edisabled])
            ->add('idIssue', ChoiceType::class, ['choices' => $issues, 'attr' => $idisabled])
            ->add('observations')
            ->add('dateafectation', TextType::class, ['required' => false])
            ->add('daterealisation', TextType::class, ['required' => false])
            ->add('dureerealisation')
            ->add('idUser4affectation', ChoiceType::class, ['choices' => $users, 'attr' => ['required' => true]])
            ->add('idUser4realisation', ChoiceType::class, ['choices' => $users, 'attr' => ['required' => true]])
            ->add('idStatut', ChoiceType::class, ['choices' => $statuts, 'attr' => ['required' => true]])
            ->add('idResultat', ChoiceType::class, ['choices' => $resultats, 'attr' => ['required' => true]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Common\ProjectEtapesOperationsIssuesRealisations',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectbundle_common_projectetapesoperationsissuesrealisations';
    }


}
