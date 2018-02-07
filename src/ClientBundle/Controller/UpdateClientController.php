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
    /**
     * Override method getUser parent
     *
     * @return UserClient
     */
    protected function getUser() {

        $auth_checker = $this->get('security.authorization_checker');
        if( $auth_checker->isGranted('ROLE_ADMIN') ) 
            return true;
        
        $user_id = parent::getUser()->getId();
        $bu_id = $this->container->get('session')->get('BU');
        return $this->getDoctrine()->getRepository('UsersBundle:UserClient')->findUserByCompte($bu_id, $user_id);
    }

    /**
     * update action
     */
    public function updateAction(Request $requete, $id)
    {
        $client = new Client();
        $formBuilder = $this->createFormBuilder($client);
        $em = $this->getDoctrine()->getManager();
        $toUpdate = $em->getRepository('ClientBundle:Client')->findOneBy(['id' => $id]);

        /**
         * BU EntiteJ
         */
        // $r_bu_entitej = $em->getRepository('UsersBundle:RelationBusinessEntite')->findOneBy(['iDentite' => $toUpdate->getId()]);
        // if($r_bu_entitej) {
        //     $toUpdate->setIDBusinessUnit($r_bu_entitej->getIDBusinessUnit());
        //     $toUpdate->setRelationsProfessionnelles($r_bu_entitej->getIDRelationsProfessionnelles());
        // }

        $formBuilder        
            ->add('raisonSociale',         TextType::class, array('attr' => array('value' => $toUpdate->getRaisonSociale()) ))
            ->add('idGroupe',              ChoiceType::class, array('data' => (string)$toUpdate->getIdGroupe(), 'choices' => $this->dataForm('idGroupe')))
            ->add('adr1',                  TextType::class, array('attr' => array('value' => $toUpdate->getAdr1()), 'required' => false ))
            ->add('adr2',                  TextType::class, array('attr' => array('value' => $toUpdate->getAdr2()), 'required' => false))
            ->add('cp',                    ChoiceType::class, array('data' => (string)$toUpdate->getCp(), 'choices' => $this->getCodePostal()))
            ->add('ville',                 TextType::class, array('attr' => array('value' => $toUpdate->getVille()) ))
            ->add('pays',                  TextType::class, array('attr' => array('value' => $toUpdate->getPays()) ))
            ->add('tel',                   TextType::class, array('attr' => array('value' => $toUpdate->getTel()) ))
            ->add('gsm',                   TextType::class, array('attr' => array('value' => $toUpdate->getGsm()) , 'required' => false))
            ->add('fax',                   TextType::class, array('attr' => array('value' => $toUpdate->getFax()) , 'required' => false))
            ->add('email',                 EmailType::class, array('attr' => array('value' => $toUpdate->getEmail()) ))
            ->add('idFormeJuridique',      TextType::class, array('attr' => array('value' => $toUpdate->getIdFormeJuridique()), 'required' => false ))
            ->add('latitude',              NumberType::class, array('attr' => array('value' => $toUpdate->getLatitude()) ))
            ->add('longitude',             NumberType::class, array('attr' => array('value' => $toUpdate->getLongitude()) ))
            ->add('siret',                 TextType::class, array('attr' => array('value' => $toUpdate->getSiret()), 'required' => false))
            ->add('tvaIntraCommunautaire', TextType::class, array('attr' => array('value' => $toUpdate->getTvaIntraCommunautaire()), 'required' => false ))
            ->add('ape',                   TextType::class, array('attr' => array('value' => $toUpdate->getApe()) , 'required' => false))
            ->add('trancheEffectif',       TextType::class, array('attr' => array('value' => $toUpdate->getTrancheEffectif()), 'required' => false ))
            ->add('codeCegid',             TextType::class, array('attr' => array('value' => $toUpdate->getCodeCegid()), 'required' => false ))
            ->add('codeSage',              TextType::class, array('attr' => array('value' => $toUpdate->getCodeSage()), 'required' => false ))
            ->add('codeExact',             TextType::class, array('attr' => array('value' => $toUpdate->getCodeExact()), 'required' => false ))
            ->add('origine',               TextType::class, array('attr' => array('value' => $toUpdate->getOrigine()) , 'required' => false))
            ->add('idOrigine',             TextType::class, array('attr' => array('value' => $toUpdate->getIdOrigine()) , 'required' => false))
            ->add('idTypePaiement',        TextType::class, array('attr' => array('value' => $toUpdate->getIdTypePaiement()), 'required' => false ))
            ->add('idTypeFacturation',     TextType::class, array('attr' => array('value' => $toUpdate->getIdTypeFacturation()), 'required' => false  ))
            ->add('echeance',              TextType::class, array('attr' => array('value' => $toUpdate->getEcheance()) , 'required' => false))
            ->add('siteweb',               TextType::class, array('attr' => array('value' => $toUpdate->getSiteweb()) , 'required' => false))
            ->add('iDBusinessUnit',        ChoiceType::class,  array('data' => (string)$toUpdate->getIDBusinessUnit(), 'required' => false, 'choices' => $this->dataForm('iDBusinessUnit')))
            ->add('relationsProfessionnelles', ChoiceType::class,  array('data' => (string)$toUpdate->getRelationsProfessionnelles(), 'required' => false, 'choices' => $this->dataForm('relationsProfessionnelles')))
            ->add('version',               TextType::class, array('attr' => array('value' => $toUpdate->getVersion()) , 'required' => false));

        // dump($toUpdate);

        $form = $formBuilder->getForm();
        if ($requete->isMethod('POST')) {
            $form->handleRequest($requete);
            if ($form->isSubmitted() && $form->isValid()) {
                $param = $requete->request->get('form');

                // dump($param); exit;
                // if(isset($param['dateCreation'])){
                $toUpdate->setIdGroupe($param['idGroupe']);
                $toUpdate->setIdFormeJuridique($param['idFormeJuridique']);
                $toUpdate->setLatitude($param['latitude']);
                $toUpdate->setLongitude($param['longitude']);
                $toUpdate->setIdOrigine($param['idOrigine']);
                    // $create = new \DateTime($param['dateCreation']);
                    // $toUpdate->setdateCreation($create);
                // $toUpdate->setIdUser4Creation($param['idUser4Creation']);
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

                /**
                 * pour relation
                 */
                $bu_id = (int)$param['iDBusinessUnit'];
                $rel_id = (int)$param['relationsProfessionnelles'];
                if( $bu_id && $re_id ) {
                    $r_bu_entitej = $em->getRepository('UsersBundle:RelationBusinessEntite')->findBy(['iDBusinessUnit' => $bu_id, 'iDentite' => $id]);
                    if( !$r_bu_entitej ) {
                        $r_bu_entitej =  new \UsersBundle\Entity\RelationBusinessEntite;
                        $r_bu_entitej->setEntite($toUpdate);
                        $r_bu_entitej->setBusinessunit($em->getRepository('UsersBundle:BusinessUnit')->findOneBy(['id' => $bu_id]));
                        $r_bu_entitej->setRelationsProfessionnelles($em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findOneBy(['id' => $rel_id]));

                        $r_bu_entitej->setIDEntite($id);
                        $r_bu_entitej->setIDBusinessUnit($bu_id);
                        $r_bu_entitej->setIDRelationsProfessionnelles($rel_id);

                        $em->persist($r_bu_entitej);
                        $em->flush();
                    }
                }

                return $this->redirectToRoute('client_update_client',
                    array('id' => $id)
                );
            }
        }


        /**
         * r_bu_entitej
         */
        $r_bu_entitej = $this->getDoctrine()->getRepository('UsersBundle:RelationBusinessEntite')->findBy(['iDentite' => $id]);
        if( $r_bu_entitej )
            foreach( $r_bu_entitej as &$r_bu ) {
                $pro = $em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findOneBy(['id' => $r_bu->getIDRelationsProfessionnelles()]);
                $r_bu->setRelationsProfessionnelles($pro);
            }


        return $this->render('ClientBundle:Default:update_client.html.twig',
            array('id' => $id,
                'r_bu_entitej' => $r_bu_entitej,
                'cycles' => $em->getRepository('CrmBundle:Back\CrmParamCycles')->findAll(),
                'cycle_types' => $em->getRepository('CrmBundle:Back\CrmParamCyclesType')->findAll(),
                'contacts' => $this->getContacts($id),
                'codePostal' => $this->getCodePostal(true),
                'mail' => $this->getMail($id),
                'agenda' => $this->getAgenda($id),
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
                        $operation->setDocEnvoyes($em->getRepository('CrmBundle:Common\CrmDocsEnvoyes')->findBy(['idOperation' => $operation->getId()]));
                        $operation->setDocRecus($em->getRepository('CrmBundle:Common\CrmDocsRecus')->findBy(['idOperation' => $operation->getId()]));
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

    /**
    * dataForm
    */
    public function dataForm ( $id ) {
        $em = $this->getDoctrine()->getManager();

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

        $return = [
            'idGroupe' => Utils::Array_extract($user_param_groupe, ['key' => 'getLabel', 'value' => 'getId']),
            'iDBusinessUnit' => Utils::Array_extract($em->getRepository('UsersBundle:BusinessUnit')->findAll(), ['key' => 'getNomBusinessUnit', 'value' => 'getId']),
            'relationsProfessionnelles' => Utils::Array_extract($em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findBy(['IDNatureUser' => 2]), ['key' => 'getLabel', 'value' => 'getId']),
            'pays' => Utils::Array_extract($em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findBy(['IDNatureUser' => 2]), ['key' => 'getLabel', 'value' => 'getId'])
        ];

        return isset($return[$id]) ? $return[$id] : [];
    }

    /**
     *  Agenda
     */
    private function getAgenda ($entite_id) {
        return $this->getDoctrine()->getRepository('ProjectBundle:Agenda\AgendaWorker')->findCrmEtapesOperationsByUser(0, $entite_id);
    }

    /**
     * Messagerie
     */
    private function getMail ($id) {

        // $user_id = $this->container->get('session')->get('log');
        // $user_id = is_object($this->getUser()) ? $this->getUser()->getId() : null;
        $user_id = $id;

        $manager = $this->getDoctrine()->getManager();
        $user = $manager->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $user_id]);

        $dataTrash  = $this->getDoctrine()->getRepository('MailBundle:MailTrash')->dataTrash($user);
        $mails     = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash);        

        $all_out   = $manager->getRepository('MailBundle:MailPeople')->findOutbox($user, $dataTrash);
        $tbox      = $manager->getRepository('MailBundle:ParamMailTbox')->findAll();
        $priorites = $manager->getRepository('MailBundle:ParamMailPriorites')->findAll();
        $trash_count = $manager->getRepository('MailBundle:MailTrash')->countTrash($user);
        $mail_draft = $manager->getRepository('MailBundle:MailMessage')->countDraft($user);

        $list = $manager->createQuery('SELECT IDENTITY(mpj.mail) from MailBundle:MailPJ mpj JOIN MailBundle:Mail m WITH m.id = mpj.mail where mpj.typePj = 0')->getScalarResult();

        $pjs = array();

        foreach($list as $pj) $pjs[] = $pj[1];

        // $spam = $this->getNotification();
        $jour   = new \DateTime();
        // $allmails = count($all_out) + $trash_count + $spam['spam'] + count($mails);
        return ['mails'  => $mails,
            'jour'   => $jour, 
            // 'all_mails' =>$allmails, 
            'pjs'=>$pjs, 
            'nonlus' => count($mails),
            'all_out'=>count($all_out), 
            // 'spam' => $spam['spam'],
            'tbox' => $tbox, 
            'priorites' => $priorites, 
            'type' => 'inbox',
            'mail_trash'=>$trash_count, 
            'title'=>$this->get('translator')->trans('list_mail.my_inbox'), 
            'mail_draft'=>$mail_draft, "new_today" => count($mails)
        ];
    }
}