<?php

namespace ProjectBundle\Form\Common;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use AppBundle\Entity\Classes\Utils;


class ProjectDocsFiltersType extends AbstractType
{   
    // prevision
    public function setPrevision ($options) 
    {
        // setter ouvert
        $realisation = $options->getPrevision();
        $options->setPrevision($realisation ? true : false);
    }

    // realisation
    public function setRealisation ($options) 
    {
        // setter ouvert
        $realisation = $options->getRealisation();
        $options->setRealisation($realisation ? true : false);
    }

    // setting date
    public function setDate($options) 
    {
        $date = $options->getDatedebutPrevueE();
        $options->setDatedebutPrevueE(is_object($date) ? $date->format('Y-m-d'): $date);

        $date = $options->getDatefinPrevueE();
        $options->setDatefinPrevueE(is_object($date) ? $date->format('Y-m-d'): $date);

        $date = $options->getDatedebutReelE();
        $options->setDatedebutReelE(is_object($date) ? $date->format('Y-m-d'): $date);

        $date = $options->getDatefinReelE();
        $options->setDatefinReelE(is_object($date) ? $date->format('Y-m-d'): $date);

        $date = $options->getDatedebutPrevueO();
        $options->setDatedebutPrevueO(is_object($date) ? $date->format('Y-m-d'): $date);

        $date = $options->getDatefinPrevueO();
        $options->setDatefinPrevueO(is_object($date) ? $date->format('Y-m-d'): $date);

        $date = $options->getDatedebutReelO();
        $options->setDatedebutReelO(is_object($date) ? $date->format('Y-m-d'): $date);

        $date = $options->getDatefinReelO();
        $options->setDatefinReelO(is_object($date) ? $date->format('Y-m-d'): $date);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // prevision
        $this->setPrevision($options['data']);
        // realisation
        $this->setRealisation($options['data']);
        // date
        $this->setDate($options['data']);
        // workshop
        $workshops = Utils::Array_extract($options['dataForm']['workshops'], ['key'=>'getLabel','value'=>'getId']);
        // statuts
        $statuts = Utils::Array_extract($options['dataForm']['statuts'], ['key'=>'getLabel','value'=>'getId']);

        // roles
        $users = Utils::Array_extract($options['dataForm']['users'], ['key'=>'getUsername','value'=>'getId']);
        // roles
        $priorites = Utils::Array_extract($options['dataForm']['priorites'], ['key'=>'getLabel','value'=>'getId']);
        // Jalon
        $jalons = Utils::Array_extract($options['dataForm']['jalons'], ['key'=>'getObject','value'=>'getId']);
        // $roles
        $roles = Utils::Array_extract($options['dataForm']['roles'], ['key'=>'getLabel','value'=>'getId']);
        // build now
        $builder
            ->add('label', TextType::class, ['attr' => ['maxlength' => 80]])
            ->add('prevision', CheckboxType::class)
            ->add('realisation', CheckboxType::class)
            ->add('idWorkshop', ChoiceType::class, ['choices' => $workshops, 'required' => false])
            ->add('responsible', ChoiceType::class, ['choices' => $users, 'required' => false])
            
            // pour etape
            ->add('datedebutPrevueE', TextType::class, ['required' => false])
            ->add('datefinPrevueE', TextType::class, ['required' => false])
            ->add('datedebutReelE', TextType::class, ['required' => false])
            ->add('datefinReelE', TextType::class, ['required' => false])
            ->add('dateDebutE', IntegerType::class, ['attr' => ['type' => 'number']])
            ->add('dateTermineE', IntegerType::class)
            ->add('dateAvanceE', IntegerType::class)
            ->add('dateRetardE', IntegerType::class)
            ->add('idStatut', ChoiceType::class, ['choices' => $statuts])
            ->add('idRole', ChoiceType::class, ['choices' => $roles, 'required' => false])

            // pour opération
            ->add('datedebutPrevueO', TextType::class, ['required' => false])
            ->add('datefinPrevueO', TextType::class, ['required' => false])
            ->add('datedebutReelO', TextType::class, ['required' => false])
            ->add('datefinReelO', TextType::class, ['required' => false])
            ->add('dateDebutO', IntegerType::class)
            ->add('dateTermineO', IntegerType::class)
            ->add('dateAvanceO', IntegerType::class)
            ->add('dateRetardO', IntegerType::class)
            ->add('idRoleO', ChoiceType::class, ['choices' => $roles, 'required' => false])
            ->add('idStatutO', ChoiceType::class, ['choices' => $statuts])
            ->add('idPriorite', ChoiceType::class, ['choices' => $priorites])
            ->add('idJalon', ChoiceType::class, ['choices' => $jalons])

            // tri
            ->add('idUser', HiddenType::class)
            ->add('tri', ChoiceType::class, ['choices' => [
                'global.sort_by' => 0, 
                'global.idWorkshop' => 'idWorkshop', 
                'global.idStatut' => 'idStatut', 
                'global.idLeader' => 'idLeader',
                'global.datefinprevue' => 'datefinprevue',
                ]])
            // save
            ->add('flagprive', ChoiceType::class, ['choices' => ['global.yes' => 1, 'global.no' => 0]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Common\ProjectsDocsFilters',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', array('array'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectBundle_common_projectsfilters';
    }
}
