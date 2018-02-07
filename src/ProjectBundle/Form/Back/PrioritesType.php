<?php

namespace ProjectBundle\Form\Back;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PrioritesType extends AbstractType
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
        $imgcouleur = $options['data']->getImgcouleur() ? ['data_class' => null] : [];
        $logo = $options['data']->getLogo() ? ['data_class' => null] : [];
        // ouvert
        $this->setOuvert($options['data']);

        $builder
            ->add('ouvert', CheckboxType::class, ['required' => false])
            ->add('label', null, ['required' => true])
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
            ->add('delai', null, ['required' => false])
            ->add('typedelai', HiddenType::class)
            ->add('couleur', null, ['required' => false])
            ->add('imgcouleur', FileType::class, array_merge(['required' => false], $imgcouleur))
            ->add('nomcouleur', null, ['required' => false])
            ->add('logo', FileType::class, array_merge(['required' => false], $logo))
            ->add('obs', null, ['required' => false]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'projectBundle\Entity\Back\Priorites'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ProjectBundle_back_priorites';
    }
}
