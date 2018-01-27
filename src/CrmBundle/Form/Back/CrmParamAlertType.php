<?php

namespace CrmBundle\Form\Back;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Classes\Utils;

class CrmParamAlertType extends AbstractType
{
    // ouvert
    private function setOuvert ($options) 
    {
        // setting ouvert
        $ouvert = $options->getOuvert();
        $options->setOuvert($ouvert ? true : false);
    }

    // obligatoire
    private function setObligatoire ($options) 
    {
        // setting ouvert
        $obligatoire = $options->getObligatoire();
        $options->setObligatoire($obligatoire ? true : false);
    }

    // obligatoire
    private function setValide ($options) 
    {
        // setting ouvert
        $valide = $options->getValide();
        $options->setValide($valide ? true : false);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /* initalisation des donnée variable */
        $this->setOuvert($options['data']); 
        $this->setObligatoire($options['data']); 
        $this->setValide($options['data']); 
        $logo = $options['data']->getLogo() ? ['data_class' => null] : [];

        $builder
            ->add('ouvert', CheckboxType::class, ['required' => false])
            ->add('label', null, ['required' => true, 'attr' => ['maxlength' => 80]])
            ->add('typeAlerte', ChoiceType::class, ['choices' => ['global.alerte' => 1, 'global.rappel' => 2], 'attr' => ['required' => true]])
            ->add('declenchementdelai', null, ['required' => false])
            ->add('typedelai', null, ['required' => false])
            ->add('couleur', null, ['required' => false])
            ->add('nomcouleur', null, ['required' => false])
            ->add('obligatoire', CheckboxType::class, ['required' => false])
            ->add('logo', FileType::class, array_merge(['required' => false], $logo))
            ->add('valide', CheckboxType::class, ['required' => false]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CrmBundle\Entity\Back\CrmParamAlert'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'crmbundle_back_crmparamalert';
    }


}
