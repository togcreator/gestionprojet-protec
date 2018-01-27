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

class CrmParamPrioritesType extends AbstractType
{
    // ouvert
    private function setOuvert ($options) 
    {
        // setting ouvert
        $ouvert = $options->getOuvert();
        $options->setOuvert($ouvert ? true : false);
    }

    // ouvert
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
        /* init variable */
        $this->setOuvert($options['data']);
        $this->setValide($options['data']);
        $imgcouleur = $options['data']->getImgcouleur() ? ['data_class' => null] : [];
        $logo = $options['data']->getLogo() ? ['data_class' => null] : [];

        $builder
            ->add('ouvert', CheckboxType::class, ['required' => false])
            ->add('label', null, ['required' => true, 'attr' => ['maxlength' => 80]])
            ->add('delai', null, ['required' => false])
            ->add('typedelai', null, ['required' => false])
            ->add('couleur', null, ['required' => false])
            ->add('imgcouleur', FileType::class, array_merge(['required' => false], $imgcouleur))
            ->add('nomcouleur', null, ['required' => false])
            ->add('logo', FileType::class, array_merge(['required' => false], $logo))
            ->add('obs', null, ['required' => false])
            ->add('valide', CheckboxType::class, ['required' => false]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CrmBundle\Entity\Back\CrmParamPriorites'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'crmbundle_back_crmparampriorites';
    }


}
