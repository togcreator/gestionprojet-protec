<?php

namespace CrmBundle\Form\Back;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CrmParamActivitiesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $imgcouleur = $options['data']->getImgcouleur() ? ['data_class' => null] : [];
        $logo = $options['data']->getLogo() ? ['data_class' => null] : [];
        

        $builder
            ->add('ouvert', ChoiceType::class, 
                array('choices' => 
                    array(
                        'global.all' => 0,
                        'global.appoitment' => 1
                        )
                    )
                )
            ->add('label', null, ['required' => true, 'attr' => ['maxlength' => 80]])
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
            ->add('couleur', null, ['required' => false])
            ->add('imgcouleur', FileType::class, array_merge(['required' => false], $imgcouleur))
            ->add('nomcouleur', null, ['required' => false])
            ->add('logo', FileType::class, array_merge(['required' => false], $logo))
            ->add('obs', null, ['required' => false])
            ->add('version');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CrmBundle\Entity\Back\CrmParamActivities'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'crmbundle_back_crmparamactivities';
    }


}
