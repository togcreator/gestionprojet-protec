<?php

namespace ProjectBundle\Form\Agenda;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AgendaWorkerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // date debut
        $dateDebPrevue = $options['data']->getDateDebPrevue();
        $options['data']->setDateDebPrevue(is_object($dateDebPrevue)?$dateDebPrevue->format('Y-m-d'):'');
        // date fin
        $dateFinPrevue = $options['data']->getDateFinPrevue();
        $options['data']->setDateFinPrevue(is_object($dateFinPrevue)?$dateFinPrevue->format('Y-m-d'):'');
        // date debut
        $dateDebReelle = $options['data']->getDateDebReelle();
        $options['data']->setDateDebReelle(is_object($dateDebReelle)?$dateDebReelle->format('Y-m-d'):'');
        // date debut
        $dateFinReelle = $options['data']->getDateFinReelle();
        $options['data']->setDateFinReelle(is_object($dateFinReelle)?$dateFinReelle->format('Y-m-d'):'');
        // date cloture
        $dateCloture = $options['data']->getDateCloture();
        $options['data']->setDateCloture(is_object($dateCloture)?$dateCloture->format('Y-m-d'):'');

        $builder
            ->add('idTypeAgenda')
            ->add('idBU')
            ->add('reference')
            ->add('idLieu')
            ->add('idChantier')
            ->add('idEntityJ')
            ->add('idStrategie')
            ->add('idZonage')
            ->add('idAgendaMaster')
            ->add('idProjetOperation')
            ->add('idProjetEtape')
            ->add('idProjetJalon')
            ->add('idProjetIssue')
            ->add('idCRMOperation')
            ->add('idCRMEtape')
            ->add('idTypeuser')
            ->add('idUser', HiddenType::class)
            ->add('idWork')
            ->add('idTypeWork')
            ->add('idPriorite')
            ->add('idAlerte')
            ->add('idEvenement')
            ->add('titre')
            ->add('operateurSaisie')
            ->add('dureePrepa')
            ->add('dureeCloture')
            ->add('dateDebPrevue', TextType::class)
            ->add('dateFinPrevue', TextType::class)
            ->add('dateDebReelle', TextType::class)
            ->add('dateFinReelle', TextType::class)
            ->add('heureDebPrevue')
            ->add('heureFinPrevue')
            ->add('heureDebReelle')
            ->add('heureFinReelle')
            ->add('cloture')
            ->add('dateCloture', TextType::class)
            ->add('operateurCloture')
            ->add('quoi')
            ->add('lieu')
            ->add('observations')
            ->add('image1')
            ->add('image2')
            ->add('image3')
            ->add('image4')
            ->add('longitude')
            ->add('latitude')
            ->add('idWriter')
            ->add('valide')
            ->add('version');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Agenda\AgendaWorker',
            'users' => null
        ))
        ->setAllowedTypes('users', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectbundle_agenda_agendaworker';
    }


}
