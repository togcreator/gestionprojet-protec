<?php

namespace CrmBundle\Form\Back;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CrmParamStatutTypeType extends AbstractType
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
        $this->setOuvert($options['data']); // ouvert
        
        $builder
            ->add('ouvert', CheckboxType::class, ['required' => false])
            ->add('label', null, ['required' => true, 'attr' => ['maxlength' => 80]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CrmBundle\Entity\Back\CrmParamStatutType'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'crmbundle_back_crmparamstatuttype';
    }


}
