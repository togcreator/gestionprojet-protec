<?php

namespace CrmBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use AppBundle\Entity\Classes\Utils;

class CrmDocsEnvoyesType extends AbstractType
{
    // for date
    public function setDate ($options) 
    {
        $dateEnvoi = $options->getDateEnvoi();
        $options->setDateEnvoi(is_object($dateEnvoi)?$dateEnvoi->format('Y-m-d'):'');
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        // for data
        $doc = $options['data']->getNomDoc() ? ['data_class' => null] : [];
        $crms = Utils::Array_extract($options['dataForm']['crms'], ['key'=>'getLabel', 'value'=>'getId']);
        $operations = Utils::Array_extract($options['dataForm']['operations'], ['key'=>'getObjet', 'value'=>'getId']);

        // for date
        $this->setDate($options['data']);

        // build
        $builder
            ->add('idCrm', ChoiceType::class, ['choices' => $crms])
            ->add('idOperation', ChoiceType::class, ['choices' => $operations])
            ->add('idTypedoc')
            ->add('origine', null, ['required' => false])
            ->add('idUser', HiddenType::class)
            ->add('designation')
            ->add('nomdoc', FileType::class, array_merge(['required' => false], $doc))
            ->add('dateEnvoi', TextType::class, ['required' => true])
            ->add('referenceInterne')
            ->add('reference')
            ->add('idBiblio', null, ['required' => false])
            ->add('idMail', null, ['required' => false]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CrmBundle\Entity\Common\CrmDocsEnvoyes',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'crmbundle_common_crmdocsenvoyes';
    }


}
