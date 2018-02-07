<?php
/**
 * Created by PhpStorm.
 * User: Madatic dev3
 * Date: 04/09/2017
 * Time: 20:54
 */

namespace ClientBundle\Controller;


use ClientBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;

class AddClientController extends Controller
{
    public function addAction(Request $requete) {
        $em = $this->getDoctrine()->getManager();
        $client = new Client();
        $formBuilder = $this->createFormBuilder($client);
        
        $user_param_groupe = [];
        $admins = $em->getRepository('UsersBundle:UserClient')->findBy(['id' => $this->container->get('session')->get('log')]);
        if( $admins )
            foreach( $admins as $admin ) {

                $criter = [];
                switch($admin->getIDGroupe()) {
                    case 2:
                        $criter = ['id' => [3, 4]];
                        break;
                    case 3:
                        $criter = ['id' => 4];
                }

                $user_param_groupe = $em->getRepository('UsersBundle:Back\UsersParamGroupe')->findBy($criter);
            }

        $formBuilder
            ->add('idGroupe',              TextType::class)
            ->add('raisonSociale',         TextType::class)
            ->add('adr1',                  TextType::class)
            ->add('adr2',                  TextType::class, array('required' => false))
            ->add('cp',                    ChoiceType::class, array('choices' => $this->getCodePostal()))
            ->add('ville',                 TextType::class, array('required' => false))
            ->add('pays',                  TextType::class, array('required' => false))
            ->add('tel',                   TextType::class)
            ->add('gsm',                   TextType::class, array('required' => false))
            ->add('fax',                   TextType::class, array('required' => false))
            ->add('email',                 EmailType::class)
            ->add('idFormeJuridique',      TextType::class, array('required' => false))
            ->add('latitude',              NumberType::class)
            ->add('longitude',             NumberType::class)
            ->add('siret',                 TextType::class, array('required' => false))
            ->add('tvaIntraCommunautaire', TextType::class, array('required' => false))
            ->add('ape',                   TextType::class, array('required' => false))
            ->add('trancheEffectif',       TextType::class, array('required' => false))
            ->add('codeCegid',             TextType::class, array('required' => false))
            ->add('codeSage',              TextType::class, array('required' => false))
            ->add('codeExact',             TextType::class, array('required' => false))
            ->add('origine',               TextType::class, array('required' => false))
            ->add('idOrigine',             TextType::class, array('required' => false))
            ->add('idUser4Creation',       HiddenType::class)
            ->add('idTypePaiement',        TextType::class, array('required' => false))
            ->add('idTypeFacturation',     TextType::class, array('required' => false))
            ->add('echeance',              TextType::class, array('required' => false))
            ->add('siteweb',               TextType::class, array('required' => false))
            ->add('iDBusinessUnit',        ChoiceType::class,  array('required' => false, 'choices' => $this->dataForm('iDBusinessUnit')))
            ->add('relationsProfessionnelles', ChoiceType::class,  array('required' => false, 'choices' => $this->dataForm('relationsProfessionnelles')))
            ->add('version',               TextType::class, array('required' => false));
        $form = $formBuilder->getForm();
        if($requete->getMethod() == 'POST') {
            $form->handleRequest($requete);
            if($form->isSubmitted() && $form->isValid()) {
        
                $client->setDateCreation(new \Datetime('now'));
                $client->setLogo('');
                \AppBundle\Entity\Classes\Utils::setCode($client);

                // user connected
                $user = $this->container->get('session')->get('log');
                $client->setIdUser4Creation($user);

                $em = $this->getDoctrine()->getManager();
                $em->persist($client);
                $em->flush();
                return $this->redirectToRoute('client_liste_clients',
                    array('add' => 'ok')
                );
            }
        }
        return $this->render('ClientBundle:Default:add_client.html.twig',
            array('form' => $form->createView(), 'codePostal' => $this->getCodePostal(true))
        );
    }

    /**
    * getting code
    */
    public function getCodePostal ( $flag = false ) {
        $codepostal = $this->getDoctrine()->getRepository('ClientBundle:CodePostal')->findDistinct();

        $return = [];
        if(!$flag) {
            if( count($codepostal)) 
                foreach($codepostal as $code) {
                    $return[ $code->getCode() ] = $code->getCode();
                }
        }else
            $return = $codepostal;

        return $return;
    }

    /**
    * getting contact
    */
    public function getContacts ($id_entite_juridique) {

        $em = $this->getDoctrine()->getManager();
        $contacts = $em->getRepository('UsersBundle:UserClient')->findContactsClient($id_entite_juridique);
        return $contacts;
    }

    /**
    * dataForm
    */
    public function dataForm ( $id ) {
        $em = $this->getDoctrine()->getManager();
        $return = [
            'idGroupe' => \AppBundle\Entity\Classes\Utils::Array_extract($em->getRepository('UsersBundle:Back\UsersParamGroupe')->findBy(['ouvert' => 1]), ['key' => 'getLabel', 'value' => 'getId']),
            'iDBusinessUnit' => \AppBundle\Entity\Classes\Utils::Array_extract($em->getRepository('UsersBundle:BusinessUnit')->findAll(), ['key' => 'getNomBusinessUnit', 'value' => 'getId']),
            'relationsProfessionnelles' => \AppBundle\Entity\Classes\Utils::Array_extract($em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findBy(['IDNatureUser' => 2]), ['key' => 'getLabel', 'value' => 'getId']),
        ];

        return isset($return[$id]) ? $return[$id] : [];
    }
}