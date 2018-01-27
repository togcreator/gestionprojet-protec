<?php

namespace ProjectBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Classes\Utils;

class ProjectEtapesOperationsType extends AbstractType
{
    private function setDate($options) 
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

    // projt version
    public function setProject($options) {
        return Utils::Array_extract($options, ['key'=>'getLabel', 'value'=>'getId']);
    }

    // setting etapes
    private function setEtape ($options) {
        return Utils::Array_extract($options, ['key'=>'getObject', 'value'=>'getId']);
    }

    // setting jalons
    private function setProjectJalons ($options) {
        return Utils::Array_extract($options, ['key'=>'getObject', 'value'=>'getId']);
    }

    // setting pirorites
    private function setPriorites ($options) {
        return Utils::Array_extract($options, ['key'=>'getLabel', 'value'=>'getId']);
    }

    // setting statut
    private function setStatut ($options) {
        return Utils::Array_extract($options, ['key'=>'getLabel', 'value'=>'getId']);
    }

    // setting resultat
    private function setResultat ($options) {
        return Utils::Array_extract($options, ['key'=>'getLabel', 'value'=>'getId']);
    }

    // setting alert
    private function setAlert ($options) {
        return Utils::Array_extract($options, ['key'=>'getLabel', 'value'=>'getId']);
    }

    /** pour user de l'operation **/
    private function setUser ($options) 
    {
        if( array_key_exists('project_users', $options['dataForm']) ) {
            $etape_users = $options['dataForm']['project_users'];
            $users = [];
            foreach( $options['dataForm']['users'] as $user )
                if( in_array($user->getId(), $etape_users) )
                    $users[] = $user;
        }else
            $users = new \stdClass;
        return Utils::Array_extract($users, ['key' => 'getFirstname', 'value' => 'getId'], false);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // setting date
        $this->setDate($options['data']);

        // pour disable le projet
        $pdisabled = (isset($_GET['flag']) && $options['data']->getIdProjectVersion()) || ($options['data']->getId() && $options['data']->getIdProjectVersion()) ? ['disabled' => true] : [];
        $edisabled = $options['data']->getId() && $options['data']->getIdEtape() ? ['disabled' => true] : [];

        // builder
        $builder
            ->add('idProjectVersion', ChoiceType::class, ['choices' => $this->setProject($options['dataForm']['projects']), 'attr' => array_merge(['required' => true], $pdisabled)])
            ->add('idEtape', ChoiceType::class, ['choices' => $this->setEtape($options['dataForm']['etapes']), 'attr' => array_merge([], $edisabled)])
            ->add('idJalonPrevu', ChoiceType::class, ['choices' => $this->setProjectJalons($options['dataForm']['jalons'])])
            ->add('idJalonActuel', ChoiceType::class, ['choices' => $this->setProjectJalons($options['dataForm']['jalons'])])
            ->add('object')
            ->add('description')
            ->add('user4affectation', ChoiceType::class, ['choices' => $this->setUser($options), 'multiple' => true])
            ->add('userDate', TextType::class)
            ->add('datefinprevue', TextType::class, ['required' => false])
            ->add('datedebutprevue', TextType::class, ['required' => false])
            ->add('datefinprevue', TextType::class, ['required' => false])
            ->add('datedebutreelle', TextType::class, ['required' => false])
            ->add('datefinreelle', TextType::class, ['required' => false])
            ->add('journeesHommesprevues', null, ['required' => false])
            ->add('journeesHommesreelles', null, ['required' => false])
            ->add('idStatut', ChoiceType::class, ['choices' => $this->setStatut($options['dataForm']['statuts']), 'attr' => ['required' => true]])
            ->add('idPriorite', ChoiceType::class, ['choices' => $this->setPriorites($options['dataForm']['priorites']), 'attr' => ['required' => true]])
            ->add('idResultat', ChoiceType::class, ['choices' => $this->setResultat($options['dataForm']['resultats'])])
            ->add('idAlerte', ChoiceType::class, ['choices' => $this->setAlert($options['dataForm']['alerts']), 'attr' => ['required' => true]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Common\ProjectEtapesOperations',
            'dataForm' => null,
        ))
        ->setRequired('dataForm')
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectbundle_common_projectetapesoperations';
    }
}
