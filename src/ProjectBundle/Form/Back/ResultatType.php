<?php

namespace ProjectBundle\Form\Back;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ResultatType extends AbstractType
{
    // ouvert
    public function setOuvert ($options) 
    {
        // setting ouvert
        $ouvert = $options->getOuvert();
        $options->setOuvert($ouvert ? true : false);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // ouvert
        $this->setOuvert($options['data']);
        
        $imgcouleur = $options['data']->getImgcouleur() ? ['data_class' => null] : [];
        $logo = $options['data']->getLogo() ? ['data_class' => null] : [];

        $builder
            ->add('ouvert', CheckboxType::class, ['required' => false])
            ->add('label', null, ['attr'=>['maxlength' => 80]])
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
            ->add('couleur')
            ->add('nomcouleur')
            ->add('logo', FileType::class, array_merge(['required' => false], $logo))
            ->add('imgcouleur', FileType::class, array_merge(['required' => false], $imgcouleur))
            ->add('obs')
            ->add('version', HiddenType::class, ['attr' => ['value' => 0]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Back\Resultat'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectbundle_back_resultat';
    }
}
