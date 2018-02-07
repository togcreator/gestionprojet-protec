<?php

namespace UsersBundle\Form\Back;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ParamServicesType extends AbstractType
{
    /**
     * Status user
     */ 
    private function setCheckbox ($options) 
    {
        /**
         * ouvert
         */
        $ouvert = $options->getOuvert();
        $options->setOuvert($ouvert ? true : false);

        /**
         * valide
         */
        $valide = $options->getValide();
        $options->setValide($valide ? true : false);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /**
         * Initialise
         */
        $this->setCheckbox($options['data']);
        $image = $options['data']->getImg() ? ['data_class' => null] : [];

        $builder
            ->add('ouvert', CheckboxType::class, ['required' => false])
            ->add('label')
            ->add('img', FileType::class, array_merge(['required' => false], $image))
            ->add('obs', null, ['required' => false])
            ->add('valide', CheckboxType::class, ['required' => false]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(array(
            'data_class' => 'UsersBundle\Entity\Back\ParamServices'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'usersbundle_back_paramservices';
    }


}
