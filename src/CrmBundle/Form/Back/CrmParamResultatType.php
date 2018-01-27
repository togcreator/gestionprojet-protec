<?php

namespace CrmBundle\Form\Back;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use AppBundle\Entity\Classes\Utils;

class CrmParamResultatType extends AbstractType
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
        $imgcouleur = $options['data']->getImgcouleur() ? ['data_class' => null] : [];
        $logo = $options['data']->getLogo() ? ['data_class' => null] : [];
        $typeresultats = Utils::Array_extract($options['dataForm']['typeresultats'], ['key'=>'getLabel', 'value'=>'getId']);
        $this->setOuvert($options['data']); // ouvert

        $builder
            ->add('ouvert', CheckboxType::class, ['required' => false])
            ->add('idTyperesultat', ChoiceType::class, ['choices' => $typeresultats])
            ->add('label', null, ['required' => true, 'attr' => ['maxlength' => 80]])
            ->add('couleur', null, ['required' => false])
            ->add('imgcouleur', FileType::class, array_merge(['required' => false], $imgcouleur))
            ->add('nomcouleur', null, ['required' => false])
            ->add('logo', FileType::class, array_merge(['required' => false], $logo))
            ->add('obs', null, ['required' => false]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CrmBundle\Entity\Back\CrmParamResultat',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'crmbundle_back_crmparamresultat';
    }
}
