<?php

namespace CrmBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Classes\Utils;

class CrmEtapesRealisationsType extends AbstractType
{
    // for date
    public function setDate ($options) 
    {
        $date = $options->getDateaffectation();
        $options->setDateaffectation(is_object($date)?$date->format('Y-m-d'):'');
        $date = $options->getDaterealisation();
        $options->setDaterealisation(is_object($date)?$date->format('Y-m-d'):'');
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // for element
        $crms = Utils::Array_extract($options['dataForm']['crms'], ['key'=>'getLabel', 'value'=>'getId']);
        $etapes = Utils::Array_extract($options['dataForm']['etapes'], ['key'=>'getObjet', 'value'=>'getId']);
        $resultats = Utils::Array_extract($options['dataForm']['resultats'], ['key'=>'getLabel', 'value'=>'getId']);
        $statuts = Utils::Array_extract($options['dataForm']['statuts'], ['key'=>'getLabel', 'value'=>'getId']);
        $users = Utils::Array_extract($options['dataForm']['users'], ['key'=>'getFirstname', 'value'=>'getId']);
        $this->setDate($options['data']);

        $builder
            ->add('idCRM', ChoiceType::class, ['choices' => $crms, 'attr' => ['required' => true]])
            ->add('idEtape', ChoiceType::class, ['choices' => $etapes])
            ->add('observations')
            ->add('dateaffectation', TextType::class, ['required' => false])
            ->add('daterealisation', TextType::class, ['required' => false])
            ->add('dureerealisation', null, ['required' => false])
            ->add('idUser4affectation', ChoiceType::class, ['choices' => $users, 'attr' => ['required' => true]])
            ->add('idUser4realisation', ChoiceType::class, ['choices' => $users, 'attr' => ['required' => true]])
            ->add('idStatut', ChoiceType::class, ['choices' => $statuts, 'attr' => ['required' => true]])
            ->add('idResultat', ChoiceType::class, ['choices' => $resultats])
            ->add('descriptionResultat');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CrmBundle\Entity\Common\CrmEtapesRealisations',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'crmbundle_common_crmetapesrealisations';
    }
}
