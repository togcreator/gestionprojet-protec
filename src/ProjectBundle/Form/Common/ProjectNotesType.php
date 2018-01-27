<?php

namespace ProjectBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Classes\Utils;

class ProjectNotesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // set project
        $projects = Utils::Array_extract($options['dataForm']['projects'], ['key'=>'getLabel', 'value'=>'getId']);
        // for etape
        $etapes = Utils::Array_extract($options['dataForm']['etapes'], ['key' => 'getObject', 'value'=>'getId']);
        // pour operation
        $operations = Utils::Array_extract($options['dataForm']['operations'], ['key' => 'getObject', 'value'=>'getId']);
        // pour issue
        $issues = Utils::Array_extract($options['dataForm']['issues'], ['key' => 'getLibelle', 'value' => 'getId']);

        // pour disable le projet
        $pDisabled = (isset($_GET['flag']) && $options['data']->getIdProjetVersion()) || ($options['data']->getId() && $options['data']->getIdProjetVersion()) ? ['disabled' => true] : [];
                // pour disable etapes
        $eDisabled = $options['data']->getId() && $options['data']->getIdEtape() ? ['disabled' => true] : [];
        // pour disable operations
        $oDisabled = $options['data']->getId() && $options['data']->getIdOperation() ? ['disabled' => true] : [];
        // pour disable issue
        $iDisabled = $options['data']->getId() && $options['data']->getIdIssue() ? ['disabled' => true] : [];

        // builder
        $builder
            ->add('idProjetVersion', ChoiceType::class, ['choices' => $projects, 'attr' => array_merge(['required' => true], $pDisabled)])
            ->add('idEtape', ChoiceType::class, ['choices' => $etapes, 'attr' => $eDisabled])
            ->add('idOperation', ChoiceType::class, ['choices' => $operations, 'attr' => $oDisabled])
            ->add('idIssue', ChoiceType::class, ['choices' => $issues, 'attr' => $iDisabled])
            ->add('titre')
            ->add('objet')
            ->add('idUser', HiddenType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Common\ProjectNotes',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectbundle_common_projectnotes';
    }


}
