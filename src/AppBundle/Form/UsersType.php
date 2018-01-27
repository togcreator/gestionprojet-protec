<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityManager;

class UsersType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('username')
        ->add('password', PasswordType::class)
        ->add('adress', TextareaType::class)
        ->add('type')
        ->add('status', ChoiceType::class, array('choices' => array('active' => 1, 'unactive' => 0)))
        ->add('firstname')
        ->add('lastname')
        ->add('idLangage', ChoiceType::class, 
            array(
                'choices' => array(
                    ucfirst('fr') => 1, 
                    ucfirst('en') => 2,
                    ucfirst('nl') => 3,
                    ucfirst('de') => 4,
                    ucfirst('es') => 5,
                    ucfirst('it') => 6,
                    )
                )
            );
        // ->add('dateCreated', DateTimeType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Common\Users'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return '';
    }
}
