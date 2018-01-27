<?php

namespace CrmBundle\Form\Back;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use AppBundle\Entity\Classes\Utils;

class CrmParamCyclesDetailsActivityType extends AbstractType
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
        $cycles = Utils::Array_extract($options['dataForm']['cycles'], ['key'=>'getLabel', 'value'=>'getId']);
        $cyclesdetails = Utils::Array_extract($options['dataForm']['cyclesdetails'], ['key'=>'getLabel', 'value'=>'getId']);
        $activities = Utils::Array_extract($options['dataForm']['activities'], ['key'=>'getLabel', 'value'=>'getId']);
        $this->setOuvert($options['data']); // ouvert

        $builder
            ->add('ouvert', CheckboxType::class, ['required' => false])
            ->add('idCycle', ChoiceType::class, ['choices' => $cycles])
            ->add('idCycledetail', ChoiceType::class, ['choices' => $cyclesdetails])
            ->add('idActivite', ChoiceType::class, ['choices' => $activities])
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
            ->add('idPriorite')
            ->add('delaiRealisation')
            ->add('reminderNBJJ')
            ->add('reminderHH')
            ->add('reminderMM')
            ->add('version', HiddenType::class, ['attr' => ['value' => 0]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CrmBundle\Entity\Back\CrmParamCyclesDetailsActivity',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'crmbundle_back_crmparamcyclesdetailsactivity';
    }
}
