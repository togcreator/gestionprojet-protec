<?php

namespace ProjectBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use AppBundle\Entity\Classes\Utils;

class ProjectEtapesOperationsIssuesOrganisationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // issues
        $issues = Utils::Array_extract($options['dataForm']['issues'], ['key' => 'getLibelle', 'value' => 'getId']);
        $builder
            ->add('idIssue', ChoiceType::class, ['choices' => $issues, 'attr' => ['required' => true]])
            ->add('commentaires')
            ->add('version', HiddenType::class, ['attr' => ['value' => 0]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Common\ProjectEtapesOperationsIssuesOrganisation',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectbundle_common_projectetapesoperationsissuesorganisation';
    }


}
