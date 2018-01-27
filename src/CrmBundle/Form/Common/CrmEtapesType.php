<?php

namespace CrmBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Classes\Utils;

class CrmEtapesType extends AbstractType
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

    //============ utilisateur affecté ====================
    public function setUser ($options) 
    {
        $project_users = $options['dataForm']['crm_users'];
        $users = [];
        foreach( $options['dataForm']['users'] as $user ) {
            if( in_array($user->getId(), $project_users) )
                $users[] = $user;
        }
        return Utils::Array_extract($users, ['key' => 'getFirstname', 'value' => 'getId'], false);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        // for date
        $this->setDate($options['data']);

        // for cycles
        $crms = Utils::Array_extract($options['dataForm']['crms'], ['key' => 'getLabel', 'value'=>'getId']);
        $cycles = Utils::Array_extract($options['dataForm']['cycles'], ['key' => 'getLabel', 'value'=>'getId']);
        $resultats = Utils::Array_extract($options['dataForm']['resultats'], ['key' => 'getLabel', 'value'=>'getId']);
        $statuts = Utils::Array_extract($options['dataForm']['statuts'], ['key' => 'getLabel', 'value'=>'getId']);


        // pour disable le crm
        $disabled = [];

        // build
        $builder
            ->add('idCRM', ChoiceType::class, ['choices' => $crms, 'attr' => array_merge(['required' => true], $disabled)])
            ->add('idCycle', ChoiceType::class, ['choices' => $cycles, 'attr' => ['required' => true]])
            ->add('objet', null, ['attr' => ['required' => true]])
            ->add('description')
            ->add('user4affectation', ChoiceType::class, ['choices' => $this->setUser($options), 'multiple' => true, 'attr' => ['required' => true]])
            ->add('datedebutprevue', TextType::class, ['required' => false])
            ->add('datefinprevue', TextType::class, ['required' => false])
            ->add('datedebutreelle', TextType::class, ['required' => false])
            ->add('datefinreelle', TextType::class, ['required' => false])
            ->add('reference')
            ->add('idStatut', ChoiceType::class, ['choices' => $statuts, 'attr' => ['required' => true]])
            ->add('idResultat', ChoiceType::class, ['choices' => $resultats])
            ->add('descriptionResultat')
            ->add('flagAction', null, ['required' => false])
            ->add('flagIdee', null, ['required' => false])
            ->add('flagInformation', null, ['required' => false]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CrmBundle\Entity\Common\CrmEtapes',
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
