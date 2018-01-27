<?php

namespace ProjectBundle\Form\Back;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use AppBundle\Entity\Classes\Utils;

class RolesType extends AbstractType
{   
    // user
    public function setUser($users)
    {
        $ar = [];
        if(count($users))
            foreach( $users as $user )
                $ar[] = $user->getId();
        return $ar;
    }

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
        $users = Utils::Array_extract($options['dataForm']['users'], ['key'=>'getUsername', 'value'=>'getId'], false); // user
        $this->setOuvert($options['data']);

        // ici et là
        $options['data']->setUser($this->setUser($options['data']->getUser()));
        $builder
            ->add('ouvert', CheckboxType::class, ['required' => false])
            ->add('label', null, ['attr' => ['maxlength' => 80 ]] )
            ->add('lib0', HiddenType::class)
            ->add('lib1', HiddenType::class)
            ->add('lib2', HiddenType::class)
            ->add('lib3', HiddenType::class)
            ->add('lib4', HiddenType::class)
            ->add('lib5', HiddenType::class)
            ->add('lib6', HiddenType::class)
            ->add('lib7', HiddenType::class)
            ->add('lib8', HiddenType::class)
            ->add('lib9', HiddenType::class)
            ->add('idType', HiddenType::class)
            ->add('couleur', null, ['required' => false])
            ->add('imgcouleur', FileType::class, array_merge(['required' => false], $imgcouleur))
            ->add('nomcouleur', null, ['required' => false])
            ->add('logo', FileType::class, array_merge(['required' => false], $logo))
            ->add('obs', null, ['required' => false]);
            // ->add('user', ChoiceType::class, ['choices' => $users, 'multiple' => true, 'required' => false]);
            // ->add('version', HiddenType::class, ['attr' => ['value' => 0]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Back\Roles',
            'dataForm' => null,
        ))
        ->setAllowedTypes('dataForm', ['array']);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectBundle_back_roles';
    }
}
