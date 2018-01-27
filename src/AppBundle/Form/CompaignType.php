<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use AppBundle\Entity\typeCompaign;

class CompaignType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('budget', NumberType::class)
            ->add('status')
            ->add('dateDebut', DateTimeType::class)
            ->add('dateFin', DateTimeType::class);

        /** 
        * mbola ijerena solution dynamique io ref veo
        */
        $builder->add('idType', 
            ChoiceType::class, array(
                'choices' => array(
                    'Facebook' => 1,
                    'Youtube videos' => 2,
                    'Spotify ads' => 3,
                    'Bing campaign' => 4,
                    'Dribbble ads' => 5
                ),
            )
        );

        // ity ihany koa
        $builder->add('idUser', 
            ChoiceType::class, array(
                'choices' => array(
                    'MintLine' => 3,
                    'CDSoft' => 4,
                    'Diligence' => 5,
                    'Deluxe' => 6,
                ),
            )
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Front\Compaign'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_compaign';
    }


}
