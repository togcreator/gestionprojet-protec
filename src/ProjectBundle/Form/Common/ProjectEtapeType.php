<?php

namespace ProjectBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use AppBundle\Entity\Classes\Utils;

class ProjectEtapeType extends AbstractType
{
    public function setDate($options) 
    {
        // ddp
        $ddp = $options->getDatedebutprevue();
        $options->setDatedebutprevue($ddp?$ddp->format('Y-m-d'):'');
        // ddp
        $dfp = $options->getDatefinprevue();
        $options->setDatefinprevue($dfp?$dfp->format('Y-m-d'):'');

        // ddr
        $ddr = $options->getDatedebutreelle();
        $options->setDatedebutreelle($ddr?$ddr->format('Y-m-d'):'');
        // dfr
        $dfr = $options->getDatefinreelle();
        $options->setDatefinreelle($dfr?$dfr->format('Y-m-d'):'');
    }

    // setting project
    public function setProject ($options) {
        return Utils::Array_extract($options, ['key' => 'getLabel', 'value'=>'getId']);
    }

    // setting agendas
    public function setResultat ($options) {
        return Utils::Array_extract($options, ['key' => 'getLabel', 'value'=>'getId']);
    }

    // setting statut
    public function setStatut ($options) {
        return Utils::Array_extract($options, ['key' => 'getLabel', 'value'=>'getId']);
    }

    /** for user project and etape **/
    public function setUser ($options) 
    {
        $project_users = $options['dataForm']['project_users'];
        $users = [];
        foreach( $options['dataForm']['users'] as $user ) {
            if( in_array($user->getId(), $project_users) )
                $users[] = $user;
        }
        return Utils::Array_extract($users, ['key' => 'getFirstname', 'value' => 'getId'], false);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /* date */
        $this->setDate($options['data']);

        // pour disable le projet
        $disabled = $options['data']->getIdProjetversion() ? ['disabled' => true] : [];

        /* builder */
        $builder
            ->add('idProjetversion', ChoiceType::class, ['choices' => $this->setProject($options['dataForm']['projects']), 'attr' => array_merge(['required' => true], $disabled)])
            ->add('object')
            ->add('reference')
            ->add('description')
            ->add('user4affectation', ChoiceType::class, ['choices' => $this->setUser($options), 'multiple' => true, 'attr' => ['required' => true]])
            ->add('datedebutprevue', TextType::class, ['required' => false])
            ->add('datefinprevue', TextType::class, ['required' => false])
            ->add('datedebutreelle', TextType::class, ['required' => false])
            ->add('datefinreelle', TextType::class, ['required' => false])
            ->add('idStatut', ChoiceType::class, ['choices' => $this->setStatut($options['dataForm']['statuts']), 'attr' => ['required' => true]])
            ->add('idResultat', ChoiceType::class, ['required' => false, 'choices' => $this->setResultat($options['dataForm']['resultats'])])
            ->add('flagAction', null, ['required' => false])
            ->add('flagIdee', null, ['required' => false])
            ->add('flagInformation', null, ['required' => false])
            ->add('idEtape', HiddenType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Common\ProjectEtape',
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
        return 'projectbundle_common_projectetape';
    }
}
