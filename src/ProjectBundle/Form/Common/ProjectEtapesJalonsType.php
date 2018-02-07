<?php

namespace ProjectBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Classes\Utils;

class ProjectEtapesJalonsType extends AbstractType
{
    public function setDate(&$options) 
    {
        // dp
        $dp = $options->getDateprevue();
        $options->setDateprevue($dp?$dp->format('Y-m-d'):'');
        // dr
        $dr = $options->getDatereelle();
        $options->setDatereelle($dr?$dr->format('Y-m-d'):'');
    }

    // setting project version
    public function setProject ($options) {
        return Utils::Array_extract($options, ['key' => 'getLabel', 'value'=>'getId']);
    }

    // setting etapes
    public function setEtapes ($options) {
        return Utils::Array_extract($options, ['key'=>'getObject', 'value'=>'getId']);
    }

    // setting resultat
    public function setResult ($options) {
        return Utils::Array_extract($options, ['key'=>'getLabel', 'value'=>'getId']);
    }

     // setting type jalon
    public function setJalon ($options) {
        return Utils::Array_extract($options, ['key'=>'getLabel', 'value'=>'getId']);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->setDate($options['data']);
        $project = $this->setProject($options['dataForm']['projects']);
        $etape = $this->setEtapes($options['dataForm']['etapes']);
        $result = $this->setResult($options['dataForm']['resultats']);
        $jalons = $this->setResult($options['dataForm']['jalons']);

        // pour disable le projet
        $pDisabled = (isset($_GET['flag']) && $options['data']->getIdProjectVersion()) || ($options['data']->getId() && $options['data']->getIdProjectVersion()) ? ['disabled' => true] : [];
        // pour disable etapes
        $eDisabled = $options['data']->getId() && $options['data']->getIdEtape() ? ['disabled' => true] : [];
        // pour disable type jalon
        // $tDisabled = $options['data']->getId() && $options['data']->getidTypeJalon() ? ['disabled' => true] : [];

        $builder
            ->add('idProjectVersion', ChoiceType::class, ['choices' => $project, 'attr' => array_merge(['required' => true], $pDisabled)])
            ->add('idEtape', ChoiceType::class, ['choices' => $etape, 'attr' => $eDisabled])
            ->add('idTypeJalon', ChoiceType::class, ['choices' => $jalons, 'attr' => ['required' => true]])
            ->add('object')
            ->add('description')
            ->add('dateprevue', TextType::class,['required'=>false])
            ->add('datereelle', TextType::class,['required'=>false])
            ->add('journeesHommesprevues', null, ['required'=>false])
            ->add('journeesHommesreelles', null, ['required'=>false])
            ->add('idResultat', ChoiceType::class, ['choices' => $result]);

        $builder->get('idProjectVersion')->resetViewTransformers();
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Common\ProjectEtapesJalons',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectbundle_common_projectetapesjalons';
    }


}
