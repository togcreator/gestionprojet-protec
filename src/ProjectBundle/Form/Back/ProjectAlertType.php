<?php

namespace ProjectBundle\Form\Back;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class ProjectAlertType extends AbstractType
{
    // ouvert
    public function setBoolean ($options) 
    {
        // setting ouvert
        $ouvert = $options->getOuvert();
        $options->setOuvert($ouvert ? true : false);

        // setting valide
        $valide = $options->getValide();
        $options->setValide($valide ? true : false);

        // setting obligatoire
        $obligatoire = $options->getObligatoire();
        $options->setObligatoire($obligatoire ? true : false);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // ouvert
        $this->setBoolean($options['data']);
        $logo = $options['data']->getLogo() ? ['data_class' => null] : [];

        $builder
            ->add('ouvert', CheckboxType::class, ['required' => false])
            ->add('label', null, ['attr'=>['maxlength' => 50], 'required' => true])
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
            ->add('typeAlerte', null, ['required' => false])
            ->add('declenchementdelai', null, ['required' => false])
            ->add('typedelai', null, ['required' => false])
            ->add('couleur', null, ['required' => false])
            ->add('nomcouleur', null, ['required' => false])
            ->add('obligatoire', CheckboxType::class, ['required' => false])
            ->add('logo', FileType::class, array_merge(['required' => false], $logo))
            ->add('valide', CheckboxType::class, ['required' => false])
            ->add('version', HiddenType::class, ['attr' => ['value' => 0]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Back\ProjectAlert'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectBundle_back_projectalert';
    }


}
