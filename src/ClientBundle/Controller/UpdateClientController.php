<?php
/**
 * Created by PhpStorm.
 * User: Madatic dev3
 * Date: 04/09/2017
 * Time: 20:38
 */

namespace ClientBundle\Controller;


use ClientBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Classes\Utils;

class UpdateClientController extends Controller
{
    public function updateAction(Request $requete, $id)
    {
        $client = new Client();
        $formBuilder = $this->createFormBuilder($client);
        $em = $this->getDoctrine()->getManager();
        $toUpdate = $em->getRepository('ClientBundle:Client')->find($id);

        $formBuilder
            ->add('raisonSociale',         TextType::class, array('attr' => array('value' => $toUpdate->getRaisonSociale()) ))
            ->add('adr1',                  TextType::class, array('attr' => array('value' => $toUpdate->getAdr1()) ))
            ->add('adr2',                  TextType::class, array('attr' => array('value' => $toUpdate->getAdr2()), 'required' => false))
            ->add('cp',                    ChoiceType::class, array('attr' => array('value' => $toUpdate->getCp()), 'choices' => $this->getCodePostal()))
            ->add('ville',                 TextType::class, array('attr' => array('value' => $toUpdate->getVille()) ))
            ->add('pays',                  TextType::class, array('attr' => array('value' => $toUpdate->getPays()) ))
            ->add('tel',                   TextType::class, array('attr' => array('value' => $toUpdate->getTel()) ))
            ->add('gsm',                   TextType::class, array('attr' => array('value' => $toUpdate->getGsm()) , 'required' => false))
            ->add('fax',                   TextType::class, array('attr' => array('value' => $toUpdate->getFax()) , 'required' => false))
            ->add('email',                 EmailType::class, array('attr' => array('value' => $toUpdate->getEmail()) ))
            ->add('idFormeJuridique',      TextType::class, array('attr' => array('value' => $toUpdate->getIdFormeJuridique()) ))
            ->add('latitude',              NumberType::class, array('attr' => array('value' => $toUpdate->getLatitude()) ))
            ->add('longitude',             NumberType::class, array('attr' => array('value' => $toUpdate->getLongitude()) ))
            ->add('siret',                 TextType::class, array('attr' => array('value' => $toUpdate->getSiret()) ))
            ->add('tvaIntraCommunautaire', TextType::class, array('attr' => array('value' => $toUpdate->getTvaIntraCommunautaire()) ))
            ->add('ape',                   TextType::class, array('attr' => array('value' => $toUpdate->getApe()) , 'required' => false))
            ->add('trancheEffectif',       TextType::class, array('attr' => array('value' => $toUpdate->getTrancheEffectif()) ))
            ->add('codeCegid',             TextType::class, array('attr' => array('value' => $toUpdate->getCodeCegid()) ))
            ->add('codeSage',              TextType::class, array('attr' => array('value' => $toUpdate->getCodeSage()) ))
            ->add('codeExact',             TextType::class, array('attr' => array('value' => $toUpdate->getCodeExact()) ))
            ->add('origine',               TextType::class, array('attr' => array('value' => $toUpdate->getOrigine()) , 'required' => false))
            ->add('idOrigine',             TextType::class, array('attr' => array('value' => $toUpdate->getIdOrigine()) , 'required' => false))
            ->add('idUser4Creation',       HiddenType::class, array('attr' => array('value' => $toUpdate->getIdUser4Creation()) ))
            ->add('idTypePaiement',        TextType::class, array('attr' => array('value' => $toUpdate->getIdTypePaiement()) ))
            ->add('idTypeFacturation',     TextType::class, array('attr' => array('value' => $toUpdate->getIdTypeFacturation()) ))
            ->add('echeance',              TextType::class, array('attr' => array('value' => $toUpdate->getEcheance()) , 'required' => false))
            ->add('siteweb',               TextType::class, array('attr' => array('value' => $toUpdate->getSiteweb()) , 'required' => false))
            ->add('version',               TextType::class, array('attr' => array('value' => $toUpdate->getVersion()) , 'required' => false));
        $form = $formBuilder->getForm();
        if ($requete->isMethod('POST')) {
            $form->handleRequest($requete);
            if ($form->isSubmitted() && $form->isValid()) {
                $param = $requete->request->get('form');

                // dump($param); exit;
                // if(isset($param['dateCreation'])){
                $toUpdate->setIdGroupe(0); //$param['idGroupe']
                $toUpdate->setIdFormeJuridique($param['idFormeJuridique']);
                $toUpdate->setLatitude($param['latitude']);
                $toUpdate->setLongitude($param['longitude']);
                $toUpdate->setIdOrigine($param['idOrigine']);
                    // $create = new \DateTime($param['dateCreation']);
                    // $toUpdate->setdateCreation($create);
                $toUpdate->setIdUser4Creation($param['idUser4Creation']);
                $toUpdate->setIdTypePaiement($param['idTypePaiement']);
                $toUpdate->setIdTypeFacturation($param['idTypeFacturation']);
                // }
                // pour code
                $toUpdate->setRaisonSociale($param['raisonSociale']);
                $toUpdate->setAdr1($param['adr1']);
                $toUpdate->setAdr2($param['adr2']);
                $toUpdate->setCp($param['cp']);
                $toUpdate->setVille($param['ville']);
                $toUpdate->setPays($param['pays']);
                $toUpdate->setTel($param['tel']);
                $toUpdate->setGsm($param['gsm']);
                $toUpdate->setFax($param['fax']);
                $toUpdate->setEmail($param['email']);
                $toUpdate->setSiret($param['siret']);
                $toUpdate->setTvaIntraCommunautaire($param['tvaIntraCommunautaire']);
                $toUpdate->setApe($param['ape']);
                $toUpdate->setTrancheEffectif($param['trancheEffectif']);
                $toUpdate->setCodeCegid($param['codeCegid']);
                $toUpdate->setCodeSage($param['codeSage']);
                $toUpdate->setCodeExact($param['codeExact']);
                $toUpdate->setOrigine($param['origine']);
                $toUpdate->setEcheance($param['echeance']);
                $toUpdate->setSiteweb($param['siteweb']);
                $toUpdate->setVersion($param['version']);
                $em->persist($toUpdate);
                $em->flush();
                return $this->redirectToRoute('client_update_client',
                    array(  'id' => $id,
                            'update' => 'ok')
                );
            }
        }
        return $this->render('ClientBundle:Default:update_client.html.twig',
            array('id' => $id,
                'cycles' => $em->getRepository('CrmBundle:Back\CrmParamCycles')->findAll(),
                'cycle_types' => $em->getRepository('CrmBundle:Back\CrmParamCyclesType')->findAll(),
                'contacts' => $this->getContacts($id),
                'codePostal' => $this->getCodePostal(true),
                'form' => $form->createView())
        );
    }

    public function ajaxClientAction (Request $request) {
        $id_entite_juridique = $request->get('id');
        $id_cycle = $request->get('id_cycle');
        $id_cycle_type = $request->get('id_cycle_type');

        return $this->render('ClientBundle:Default:column.html.twig', ['Cycles' => $this->getCycleDetail($id_entite_juridique, [
            'id_cycle' => $id_cycle ? $id_cycle : 0,
            'id_cycle_type' => $id_cycle_type ? $id_cycle_type : 0
        ])]);   
    }

    public function getCycleDetail ($id_entite_juridique, $cycle_s) {
        $ret = [
            'cycle_details' => [],
            'byDetails' => []
        ];

        $em = $this->getDoctrine()->getManager();
        $selective = isset($cycle_s['id_cycle']) && $cycle_s['id_cycle'] ? ['idEntiteJ' => $id_entite_juridique, 'idCycle' => $cycle_s['id_cycle']] : ['idEntiteJ' => $id_entite_juridique];

        $crms = $em->getRepository('CrmBundle:Common\CrmDossier')->findBy($selective);
        // $cycles = $em->getRepository('CrmBundle:Back\CrmParamCycles')->findAll();


        foreach( $crms as $crm ) {

            $select = isset($cycle_s['id_cycle']) && $cycle_s['id_cycle'] ? ['idCycle' => $crm->getIdCycle()] : ['idTypecycle' => $cycle_s['id_cycle_type']]; 
            $details = $em->getRepository('CrmBundle:Back\CrmParamCyclesDetails')->findBy($select, ['id' => 'ASC']);
            $ret['cycle_details'] = $details;

            foreach($details as $detail) {
            
                //==========================
                // init array
                //==========================
                if(!count($ret['byDetails'])) $ret['byDetails'] = [];
                if(!isset($ret['byDetails'][$crm->getId()])) 
                    $ret['byDetails'][$detail->getId()] = [];

                if(!isset($ret['byDetails'][$crm->getId()][$detail->getId()])) 
                    $ret['byDetails'][$crm->getId()][$detail->getId()] = [];

                //=== for operation ===//
                $operations = $em->getRepository('CrmBundle:Common\CrmEtapesOperations')->findBy(['idCRM' => $crm->getId(), 'idCycledetail' => $detail->getId()]);
                if(count($operations)) {
                    foreach($operations as $operation) {
                        $crm->setEntite($em->getRepository('ClientBundle:Client')->findOneBy(['id' => $crm->getIdEntiteJ()]));
                        $operation->setCrm($crm);
                        $doc_envoye = $em->getRepository('CrmBundle:Common\CrmDocsEnvoyes')->findBy(['idOperation' => $operation->getId()]);
                        $doc_recus = $em->getRepository('CrmBundle:Common\CrmDocsRecus')->findBy(['idOperation' => $operation->getId()]);
                        $operation->setDocs(count($doc_envoye) + count($doc_recus));
                        $ret['byDetails'][$crm->getId()][$detail->getId()][] = $operation;
                    }
                }
            }
        }

        // les propects attente
        return $ret;
    }

    /**
    * getting contact
    */
    public function getContacts ($id_entite_juridique) {
        $em = $this->getDoctrine()->getManager();
        // obtenir les contacts de l'entité juridique
        $contacts = $em->getRepository('UsersBundle:UserClient')->findContactsClient($id_entite_juridique);
        // dump($contacts);
        return $contacts;
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
}