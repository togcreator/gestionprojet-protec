<?php

namespace UsersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use AppBundle\Entity\Classes\Utils;

class UserClientType extends AbstractType
{
    /**
     * user compte filter
     */ 
    private function setUserCompte ($option) {
        if( !$option ) return [];
        // foreach($option as $key => &$user)
        //     if( $user->getId() == 1 || in_array('ROLE_ADMIN', $user->getRoles()) )
        //         unset($option[$key]);
        return Utils::Array_extract($option, ['key' => 'getUsername', 'value' => 'getId']);
    }

    /**
     * Status user
     */ 
    private function setStatus ($options) 
    {
        // setting ouvert
        $status = $options->getStatus();
        $options->setStatus($status ? true : false);
    }

    /**
     * Photo user
     */ 
    private function setPhoto ($options) {
        $photos = $options->getPhoto();
        if( !is_string($photos) ) $options->setPhoto('');
    }

    /**
     * r_bu_entitej
     */ 
    private function setR_bu_entitej ($options) {
        $return = [];

        /**
         * le key doit être comme ceci: bu - profession
         * exemple:
         *      Protect SA - Client  
         */
        if( $options ) {
            foreach( $options as $relation )  {
                $return[ sprintf("%s - %s", $relation->getBusinessunit()->getNomBusinessUnit(), $relation->getRelationsProfessionnelles()->getLabel()) ] = $relation->getId();
            }
        }

        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /* elements */
        $natures = Utils::Array_extract($options['dataForm']['natures'], ['key' => 'getLabel', 'value' => 'getId']);
        $langages = Utils::Array_extract($options['dataForm']['langages'], ['key' => 'getLabels', 'value' => 'getId'], false);
        $user_compte = $this->setUserCompte($options['dataForm']['user_compte']);
        $pays = Utils::Array_extract($options['dataForm']['pays'], ['key' => 'getLabel', 'value' => 'getCodePays']);
        $user_param_groupe = Utils::Array_extract($options['dataForm']['user_param_groupe'], ['key' => 'getLabel', 'value' => 'getId']);
        $relationsFonctionnelles = Utils::Array_extract($options['dataForm']['relationsFonctionnelles'], ['key' => 'getLabel', 'value' => 'getId']);
        $r_bu_entitej = $this->setR_bu_entitej($options['dataForm']['r_bu_entitej']);
        $businessunits = Utils::Array_extract($options['dataForm']['businessunits'], ['key' => 'getNomBusinessUnit', 'value' => 'getId']);
        $entiteJ = Utils::Array_extract($options['dataForm']['entiteJ'], ['key' => 'getRaisonSociale', 'value' => 'getId']);
        $codepostal = Utils::Array_extract($options['dataForm']['codepostal'], ['key' => 'getCode', 'value' => 'getId']);

        $photo = ['data_class' => null];
        $this->setStatus($options['data']);
        $this->setPhoto($options['data']);

        $builder
            ->add('iDNatureUser', ChoiceType::class, ['choices' => $natures, 'attr' => ['required' => true]])
            ->add('iDGroupe', ChoiceType::class, ['choices' => $user_param_groupe, 'attr' => ['required' => true]])
            ->add('iDCompte', ChoiceType::class, ['choices' => $user_compte, 'attr' => ['required' => true]])
            ->add('iDGenre', ChoiceType::class, ['choices' => ['global.male' => 1, 'global.female' => 2, 'global.gother' => 3], 'attr' => ['required' => true]])
            ->add('lastname', null, ['attr' => ['required' => true]])
            ->add('firstname', null, ['required' => false])
            ->add('adr1', TextareaType::class, ['required' => false])
            ->add('adr2', TextareaType::class, ['required' => false])
            ->add('cp', ChoiceType::class, ['choices' => $codepostal, 'required' => false])
            ->add('ville', null, ['required' => false])
            ->add('pays', ChoiceType::class, ['choices' => $pays, 'attr' => ['required' => true]])
            ->add('telephone')
            ->add('fax', null, ['required' => false])
            ->add('gsm', null, ['required' => false])
            ->add('status', CheckboxType::class, ['required' => false])
            ->add('email')
            ->add('iDBusinessUnit', ChoiceType::class, ['choices' => $businessunits, 'required' => false])
            ->add('iDRelation_Fonctionnelle', ChoiceType::class, ['choices' => $relationsFonctionnelles, 'required' => false])
            ->add('r_bu_entitej', ChoiceType::class, ['choices' => $r_bu_entitej, 'required' => false])
            ->add('iDEntite', ChoiceType::class, ['choices' => $entiteJ, 'required' => false])
            ->add('origine', null, ['required' => false])
            ->add('photo', FileType::class, array_merge(['required' => false], $photo))
            ->add('langage', ChoiceType::class, ['choices' => $langages, 'attr' => ['required' => true]]);

        $builder->get('r_bu_entitej')->resetViewTransformers();
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UsersBundle\Entity\UserClient',
            'dataForm' => null
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'usersbundle_userclient';
    }


}
