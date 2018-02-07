<?php

namespace ProjectBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Classes\Utils;


class ProjectType extends AbstractType
{   
    // setting date
    public function setDate($options) 
    {
        $datedebutprevue = $options->getDatedebutPrevue();
        $options->setDatedebutPrevue(is_object($datedebutprevue) ? $datedebutprevue->format('Y-m-d'): $datedebutprevue);

        $datefinPrevue = $options->getDatefinPrevue();
        $options->setDatefinPrevue(is_object($datefinPrevue) ? $datefinPrevue->format('Y-m-d'): $datefinPrevue);

        $datedebutReelle = $options->getDatedebutReelle();
        $options->setDatedebutReelle(is_object($datedebutReelle) ? $datedebutReelle->format('Y-m-d'): $datedebutReelle);

        $datefinReelle = $options->getDatefinReelle();
        $options->setDatefinReelle(is_object($datefinReelle) ? $datefinReelle->format('Y-m-d'): $datefinReelle);
    }

    // private function setClient ($clients) { 
    //     $return = [];
    //     foreach($clients['items'] as $items)
    //         if(count($items))
    //             $return[$items['text']] = $items['id'];
    //     return $return;
    // }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // for entityJ
        $entityJs = Utils::Array_extract($options['dataForm']['entityJs'], ['key'=>'getRaisonSociale', 'value'=>'getId']);
        // need lang
        $workshops = Utils::Array_extract($options['dataForm']['workshops'], ['key' => 'getLabel', 'value'=>'getId']);
        // statuts
        $statuts = Utils::Array_extract($options['dataForm']['statuts'], ['key' => 'getLabel', 'value'=>'getId']);
        // user
        $leaders = Utils::Array_extract($options['dataForm']['users'], ['key' => ['getFirstname', 'getLastname'], 'value' => 'getId']);
        //===================== user client ===================
        // $users = $this->setClient($options['dataForm']['clients']);
        // $users = Utils::Array_extract($options['dataForm']['clients'], ['key' => 'getRaisonSociale', 'value' => 'getId']);
        $users = Utils::Array_extract($options['dataForm']['users'], ['key' => ['getFirstname', 'getLastname'], 'value' => 'getId'], false);
        //===================== contact =======================
        $contact = $options['dataForm']['contact'];
        //===================== mode access ===================
        $modeacces = Utils::Array_extract($options['dataForm']['modeacces'], ['key'=>'getLabel', 'value'=>'getId']);
        // date
        $this->setDate($options['data']);

        // build now
        $builder
            ->add('idWorkshop', ChoiceType::class, ['choices' => $workshops, 'attr' => ['required' => true]])
            ->add('idEntiteJ', ChoiceType::class, ['choices' => $entityJs])
            ->add('idVersionCours', HiddenType::class)
            ->add('label', null, ['attr' => ['required' => true, 'maxlength' => 80]])
            ->add('lib0', HiddenType::class)
            ->add('lib1', HiddenType::class)
            ->add('lib2', HiddenType::class)
            ->add('lib3', HiddenType::class)
            ->add('lib4', HiddenType::class)
            ->add('lib5', HiddenType::class)
            ->add('lib6', HiddenType::class)
            ->add('lib7', HiddenType::class)
            ->add('lib8', HiddenType::class)
            ->add('lib9', HiddenType::class)
            ->add('reference')
            ->add('descriptionPerimetres', TextareaType::class)
            ->add('descriptionPerimetre0', HiddenType::class)
            ->add('descriptionPerimetre1', HiddenType::class)
            ->add('descriptionPerimetre2', HiddenType::class)
            ->add('descriptionPerimetre3', HiddenType::class)
            ->add('descriptionPerimetre4', HiddenType::class)
            ->add('descriptionPerimetre5', HiddenType::class)
            ->add('descriptionPerimetre6', HiddenType::class)
            ->add('descriptionPerimetre7', HiddenType::class)
            ->add('descriptionPerimetre8', HiddenType::class)
            ->add('descriptionPerimetre9', HiddenType::class)
            ->add('idTypeProjet', HiddenType::class)
            ->add('idCreateur', HiddenType::class)
            ->add('datedebutPrevue', TextType::class, ['required' => false])
            ->add('datefinPrevue', TextType::class, ['required' => false])
            ->add('datedebutReelle', TextType::class, ['required' => false])
            ->add('datefinReelle', TextType::class, ['required' => false])
            ->add('statut', ChoiceType::class, ['choices' => $statuts, 'attr' => ['required' => true]])
            ->add('idLeader', ChoiceType::class, ['choices' => $leaders, 'attr' => ['required' => true]])
            ->add('joursHommesPrevus')
            ->add('joursHommesReels')
            ->add('contact', ChoiceType::class, ['choices' => $contact, 'attr' => ['required' => true]])
            ->add('user', ChoiceType::class, ['choices' => $users, 'multiple' => true, 'attr' => ['required' => true]])
            ->add('modeAcces', ChoiceType::class, ['choices' => $modeacces, 'attr' => ['required' => true]]);

        // bidouille
        $builder->get('contact')->resetViewTransformers();
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Common\Project',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectBundle_common_project';
    }


}
