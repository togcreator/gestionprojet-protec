<?php

namespace ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use AppBundle\Entity\Classes\Utils;

class ClientFilterType extends AbstractType
{   
    /**
    * set flag prive
    */
	private function setFlagprive ($options) {
		$flagprive = $options->getFlagprive();
		$options->setFlagprive($flagprive ? true : false);
	}

    /**
    * set coms
    */
    private function setCom ($coms) {
        $return = ['global.none' => 0];
        if(count($coms)) {
            foreach($coms as $com)
                $return[$com['firstname'] . ' ' . $com['lastname']] = $com['id'];
        }
        return $return;
    }

	/**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	// $entites = Utils::Array_extract($options['dataForm']['entitej'], ['key' => 'getRaisonSociale', 'value' => 'getId']);
        $codepostal = Utils::Array_extract($options['dataForm']['codepostal'], ['key' => ['getVille','getCode'], 'value' => 'getCode']);
        $statuts = Utils::Array_extract($options['dataForm']['statuts'], ['key' => 'getLabel', 'value' => 'getId']);
        $coms = $this->setCom($options['dataForm']['coms']);
        $rescoms = $this->setCom($options['dataForm']['rescoms']);

    	$this->setFlagprive($options['data']);

    	$builder
            ->add('cP', ChoiceType::class, ['choices' => $codepostal])
            ->add('idStatut', ChoiceType::class, ['choices' => $statuts])
            ->add('idOwner', ChoiceType::class, ['choices' => $coms])
            ->add('idWatcher', ChoiceType::class, ['choices' => $rescoms])
            ->add('idUser', HiddenType::class)
            ->add('tri')
            ->add('flagprive', CheckboxType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ClientBundle\Entity\ClientFilter',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ClientBundle_common_clientfilter';
    }
}