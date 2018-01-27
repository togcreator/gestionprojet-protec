<?php

namespace CrmBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Classes\Utils;

class CrmEtapesOperationsType extends AbstractType
{
    // for date
    public function setDate ($options) 
    {
        $date = $options->getDatedebutprevue();
        $options->setDatedebutprevue(is_object($date)?$date->format('Y-m-d'):'');
        $date = $options->getDatefinprevue();
        $options->setDatefinprevue(is_object($date)?$date->format('Y-m-d'):'');
        $date = $options->getDatedebutreelle();
        $options->setDatedebutreelle(is_object($date)?$date->format('Y-m-d'):'');
        $date = $options->getDatefinreelle();
        $options->setDatefinreelle(is_object($date)?$date->format('Y-m-d'):'');
    }

    public function setUser ($users) {
        $return = [];
        if( count($users) ) {
            foreach($users as $user) 
            {
                $id = $user['id'];
                $text = $user['firstname'] . ' ' . $user['lastname'];

                if( $user[0] != null ) {
                    $id = "{$user['id']}-{$user[0]->getId()}";
                    $text .= sprintf(' - %s', $user[0]->getLabel());
                }
                $return[$text] = $id;
            }
        }

        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        // for date
        $this->setDate($options['data']);

        // for crm
        $crms = Utils::Array_extract($options['dataForm']['crms'], ['key'=>'getLabel', 'value'=>'getId']);
        $cyclesdetails = Utils::Array_extract($options['dataForm']['cyclesdetails'], ['key'=>'getLabel', 'value'=>'getId']);
        $detailActivity = Utils::Array_extract($options['dataForm']['detailActivity'], ['key'=>'getLabel', 'value'=>'getId']);
        $etapes = Utils::Array_extract($options['dataForm']['etapes'], ['key'=>'getObjet', 'value'=>'getId']);
        $resultats = Utils::Array_extract($options['dataForm']['resultats'], ['key'=>'getLabel', 'value'=>'getId']);
        $statuts = Utils::Array_extract($options['dataForm']['statuts'], ['key'=>'getLabel', 'value'=>'getId']);
        $alertes = Utils::Array_extract($options['dataForm']['alertes'], ['key' => 'getLabel', 'value'=>'getId']);
        $rappels = Utils::Array_extract($options['dataForm']['rappels'], ['key' => 'getLabel', 'value' => 'getId']);
        $priorites = Utils::Array_extract($options['dataForm']['priorites'], ['key' => 'getLabel', 'value'=>'getId']);
        $users = $this->setUser($options['dataForm']['contact']);

        // build
        $builder
            ->add('idCRM', ChoiceType::class, ['choices' => $crms, 'attr' => ['required' => true]])
            ->add('idCycledetail', ChoiceType::class, ['choices' => $cyclesdetails, 'attr' => ['required' => true]])
            ->add('idDetailActivity', ChoiceType::class, ['choices' => $detailActivity, 'required' => false])
            ->add('objet', null, ['attr' => ['required' => true]])
            ->add('description')
            ->add('user4affectation', ChoiceType::class, ['choices' => $users, 'multiple' => true, 'attr' => ['required' => true]])
            // ->add('userDate', TextType::class)
            ->add('datedebutprevue', TextType::class, ['required' => false])
            ->add('datefinprevue', TextType::class, ['required' => false])
            ->add('datedebutreelle', TextType::class, ['required' => false])
            ->add('datefinreelle', TextType::class, ['required' => false])
            ->add('journeesHommesprevues', null, ['required' => false])
            ->add('journeesHommesreelle', null, ['required' => false])
            ->add('idStatut', ChoiceType::class, ['choices' => $statuts, 'attr' => ['required' => true]])
            ->add('idAlerte', ChoiceType::class, ['choices' => $alertes, 'attr' => ['required' => true]])
            ->add('idPriorite', ChoiceType::class, ['choices' => $priorites, 'attr' => ['required' => true]])
            ->add('idResultat', ChoiceType::class, ['choices' => $resultats])
            ->add('idRappel', ChoiceType::class, ['choices' => $rappels])
            ->add('idCommande', null, ['required' => false]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CrmBundle\Entity\Common\CrmEtapesOperations',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'crmbundle_common_crmetapes';
    }


}
