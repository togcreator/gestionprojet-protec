<?php

namespace ProjectBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Classes\Utils;

class ProjectVersionUserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $datedebut = $options['data']->getDatedebut();
        $options['data']->setDatedebut(is_object($datedebut) ? $datedebut->format('Y-m-d'): $datedebut);

        $datefin = $options['data']->getDatefin();
        $options['data']->setDatefin(is_object($datefin) ? $datefin->format('Y-m-d'): $datefin);

        // pour projet
        $projects = Utils::Array_extract($options['dataForm']['projects'], ['key'=>'getLabel', 'value'=>'getId']);
        // pour user/intervenant
        $users = Utils::Array_extract($options['dataForm']['users'], ['key'=>['getFirstname', 'getLastname'], 'value'=>'getId']);
        // pour roles
        $roles = Utils::Array_extract($options['dataForm']['roles'], ['key'=>'getLabel', 'value'=>'getId']);

        // pour disable le projet
        $pdisabled = (isset($_GET['flag']) && $options['data']->getIdProjetVersion()) || ($options['data']->getId() && $options['data']->getIdProjetVersion()) ? ['disabled' => true] : [];
        // pour user
        $udisabled = $options['data']->getId() && $options['data']->getIdUser() ? ['disabled' => true] : [];

        $builder
            ->add('idProjetVersion', ChoiceType::class, ['choices' => $projects, 'attr' => array_merge(['required' => true], $pdisabled)])
            ->add('mission', null, ['required' => false])
            ->add('datedebut', TextType::class, ['required' => false, 'attr' => ['placeholder' => 'Date debut']])
            ->add('datefin', TextType::class, ['required' => false, 'attr' => ['placeholder' => 'Date fin']])
            ->add('idUser', ChoiceType::class, ['choices' => $users, 'attr' => array_merge(['required' => true], $udisabled)])
            ->add('idRole', ChoiceType::class, ['choices' => $roles]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Common\ProjectVersionUser',
            'dataForm' => null
        ))
        ->setRequired('dataForm')
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectbundle_common_projectversionuser';
    }


}
