<?php

namespace CrmBundle\Form\Back;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use AppBundle\Entity\Classes\Utils;

class CrmParamCyclesDetailsType extends AbstractType
{
    // ouvert
    private function setOuvert ($options) 
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
        // set project
        $cycles = Utils::Array_extract($options['dataForm']['cycles'], ['key'=>'getLabel', 'value'=>'getId']);
        $typecycles = Utils::Array_extract($options['dataForm']['typecycles'], ['key'=>'getLabel', 'value'=>'getId']);
        $this->setOuvert($options['data']); // ouvert

        $builder
            ->add('ouvert', CheckboxType::class, ['required' => false])
            ->add('idCycle', ChoiceType::class, ['choices' => $cycles, 'attr' => ['required' => true]])
            ->add('idTypecycle', ChoiceType::class, ['choices' => $typecycles, 'attr' => ['required' => true]])
            ->add('ordre', null, ['required' => false])
            ->add('label', null, ['required' => true, 'attr' => ['maxlength' => 80]])
            ->add('version', HiddenType::class, ['attr' => ['value' => 0]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CrmBundle\Entity\Back\CrmParamCyclesDetails',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'crmbundle_back_crmparamcyclesdetails';
    }


}
