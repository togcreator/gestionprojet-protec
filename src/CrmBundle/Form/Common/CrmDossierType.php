<?php

namespace CrmBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use AppBundle\Entity\Classes\Utils;


class CrmDossierType extends AbstractType
{   
    // setting date
    private function setDate($options) 
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

    private function setClient ($clients) { 
        $return = ['global.none' => 0];
        foreach($clients['items'] as $items)
            if(count($items))
                $return[$items['text']] = $items['id'];
        return $return;
    }

    private function setCom ($coms) {
        $return = ['global.none' => 0];
        if(count($coms)) {
            foreach($coms as $com)
                $return[$com['firstname'] . ' ' . $com['lastname']] = $com['id'];
        }
        return $return;
    }

    private function setEntite ($entites) {
        $return = ['global.none' => 0];
        if(count($entites)) {
            foreach($entites as $entite)
                $return[$entite[0]->getRaisonSociale()] = $entite[0]->getId();
        }
        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // for data
        $icone = $options['data']->getIcone() ? ['data_class' => null] : [];
        $owner = $this->setCom($options['dataForm']['owner']);
        $watcher = $this->setCom($options['dataForm']['watcher']);
        $user = $this->setClient($options['dataForm']['clients']);
        $modeacces = Utils::Array_extract($options['dataForm']['modeacces'], ['key' => 'getLabel', 'value' => 'getId']);
        $entityJ = $this->setEntite($options['dataForm']['entityJ']);
        $statuts = Utils::Array_extract($options['dataForm']['statuts'], ['key' => 'getLabel', 'value' => 'getId']);
        $resultats = Utils::Array_extract($options['dataForm']['resultats'], ['key' => 'getLabel', 'value' => 'getId']);
        $cycles = Utils::Array_extract($options['dataForm']['cycles'], ['key' => 'getLabel', 'value' => 'getId']);

        // date
        $this->setDate($options['data']);

        // build now
        $builder
            ->add('idEntiteJ', ChoiceType::class, ['choices' => $entityJ, 'attr' => ['required' => true]])
            ->add('idCycle', ChoiceType::class, ['choices' => $cycles, 'attr' => ['required' => true]])
            ->add('label', null, ['attr' => ['maxlength' => 80, 'required' => true]])
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
            ->add('icone', FileType::class, array_merge(['required' => false], $icone))
            ->add('reference')
            ->add('idMarketSegment', null, ['required' => false])
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
            ->add('idCreateur', HiddenType::class)
            ->add('datedebutPrevue', TextType::class, ['required' => false])
            ->add('datefinPrevue', TextType::class, ['required' => false])
            ->add('datedebutReelle', TextType::class, ['required' => false])
            ->add('datefinReelle', TextType::class, ['required' => false])
            ->add('statut', ChoiceType::class, ['choices' => $statuts, 'attr' => ['required' => true]])
            ->add('idOwner', ChoiceType::class, ['choices' => $owner])
            ->add('idWatcher', ChoiceType::class, ['choices' => $watcher])
            ->add('modeAcces', ChoiceType::class, ['choices' => $modeacces])
            ->add('Rakingprevu', null, ['required' => false])
            ->add('Rakingactuel', null, ['required' => false])
            ->add('descriptionResultat', null, ['required' => false])
            ->add('idResultat', ChoiceType::class, ['choices' => $resultats]);

        // bidouille
        // $builder->get('contact')->resetViewTransformers();
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CrmBundle\Entity\Common\CrmDossier',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectBundle_common_crmdossier';
    }


}
