<?php
/**
 * Created by PhpStorm.
 * User: Madatic dev3
 * Date: 04/09/2017
 * Time: 20:26
 */

namespace ClientBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use ClientBundle\Entity\Client;

class FicheClientController extends Controller
{
    public function voirFicheAction($id) {
    	$client = new Client();
    	$formBuilder = $this->createFormBuilder($client);
        $depot  = $this->getDoctrine()->getRepository('ClientBundle:Client');
        $toUpdate = $depot->find($id);
        $formBuilder
            ->add('code',                  TextType::class, array('attr' => array('value' => $toUpdate->getCode()) ))
            ->add('raisonSociale',         TextType::class, array('attr' => array('value' => $toUpdate->getRaisonSociale()) ))
            ->add('adr1',                  TextType::class, array('attr' => array('value' => $toUpdate->getAdr1()) ))
            ->add('adr2',                  TextType::class, array('attr' => array('value' => $toUpdate->getAdr2()) ))
            ->add('cp',                    TextType::class, array('attr' => array('value' => $toUpdate->getcp()) ))
            ->add('ville',                 TextType::class, array('attr' => array('value' => $toUpdate->getVille()) ))
            ->add('pays',                  TextType::class, array('attr' => array('value' => $toUpdate->getPays()) ))
            ->add('tel',                   TextType::class, array('attr' => array('value' => $toUpdate->getTel()) ))
            ->add('gsm',                   TextType::class, array('attr' => array('value' => $toUpdate->getGsm()) ))
            ->add('fax',                   TextType::class, array('attr' => array('value' => $toUpdate->getFax()) ))
            ->add('email',                 EmailType::class, array('attr' => array('value' => $toUpdate->getEmail()) ))
            ->add('siret',                 TextType::class, array('attr' => array('value' => $toUpdate->getSiret()) ))
            ->add('tvaIntraCommunautaire', TextType::class, array('attr' => array('value' => $toUpdate->getTvaIntraCommunautaire()) ))
            ->add('ape',                   TextType::class, array('attr' => array('value' => $toUpdate->getApe()) ))
            ->add('trancheEffectif',       TextType::class, array('attr' => array('value' => $toUpdate->getTrancheEffectif()) ))
            ->add('codeCegid',             TextType::class, array('attr' => array('value' => $toUpdate->getCodeCegid()) ))
            ->add('codeSage',              TextType::class, array('attr' => array('value' => $toUpdate->getCodeSage()) ))
            ->add('codeExact',             TextType::class, array('attr' => array('value' => $toUpdate->getCodeExact()) ))
            ->add('origine',               TextType::class, array('attr' => array('value' => $toUpdate->getOrigine()) ))
            ->add('echeance',              IntegerType::class, array('attr' => array('value' => $toUpdate->getEcheance()) ))
            ->add('siteweb',               TextType::class, array('attr' => array('value' => $toUpdate->getSiteweb()) ))
            ->add('version',               IntegerType::class, array('attr' => array('value' => $toUpdate->getVersion()) ));
        $form = $formBuilder->getForm();
        return $this->render('ClientBundle:Default:fiche_client.html.twig', array("id"=> $id, "client" => $toUpdate, 'form' => $form->createView()));
    }
}