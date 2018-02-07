<?php

namespace UsersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Classes\Utils;

class UserDocsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $doc = $options['data']->getNomdoc() ? ['data_class' => null] : [];
        $users = Utils::Array_extract($options['dataForm']['user'], ['key' => ['getFirstname', 'getLastname'], 'value' => 'getId']);

        $builder
            ->add('iDUser', HiddenType::class)
            ->add('iDType', HiddenType::class, ['attr' => ['value' => 1]])
            ->add('origine', null, ['required' => false])
            ->add('idUser4origine', ChoiceType::class, ['choices' => $users, 'attr' => ['required' => true]])
            ->add('designation')
            ->add('nomdoc', FileType::class, array_merge(['required' => false], $doc))
            ->add('idBiblio', HiddenType::class, ['attr' => ['value' => 1]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UsersBundle\Entity\UserDocs', 
            'dataForm' => null
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'usersbundle_userdocs';
    }


}
