<?php

namespace CrmBundle\Controller\Common;

use CrmBundle\Entity\Common\CrmEtapesOperations;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Crmdocsenvoye controller.
 *
 * @Route("crm/operations")
 */
class CrmEtapesOperationsController extends Controller
{
        /**
    * Override method getUser parent
    *
    * @return UserClient
    */
    protected function getUser() {
        //==============================================
        // $user = parent::getUser();
        $session_id = $this->container->get('session')->get('log');
        $bu_id = $this->container->get('session')->get('BU');
        $manager = $this->getDoctrine()->getManager();
        dump($session_id);
        // $login = $manager->getRepository('UsersBundle:UserClient')->findOneBy(['iDCompte' => $session_id]);
        $return = $manager->getRepository('UsersBundle:UserClient')->findBBU($session_id, $bu_id, true);

       return $return;
    }

    /**
     * Lists all crmEtapesOperations entities.
     *
     * @Route("/", name="crmetapesoperations_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $orderby = $request->get('orderby') ? $request->get('orderby') : 'idCRM';

        $operations = [];
        $crmEtapesOperations = $em->getRepository('CrmBundle:Common\CrmEtapesOperations')->findAll();
        if( $crmEtapesOperations )
            foreach($crmEtapesOperations as $key => $operation) 
            {
                $clefs = null;

                // crm
                $crm = $em->getRepository('CrmBundle:Common\CrmDossier')->findOneBy(['id' => $operation->getIdCRM()]);
                if(!$crm) continue;

                if( strpos(strtolower($orderby), 'date') !== false )
                    $clefs = $operation->getDatefinPrevue();

                if( strpos(strtolower($orderby), 'statut') !== false ) {
                    $clefs = $em->getRepository('CrmBundle:Back\CrmParamStatut')->findOneBy(['id' => $operation->getIdStatut()]);
                    if(!is_object($clefs)) continue;
                    $clefs = $clefs->getLabel();
                }

                if( strpos(strtolower($orderby), 'idcrm') !== false ) {
                    $clefs = $crm->getLabel();
                }

                /* clef null on continue */
                if( $clefs == null ) continue;

                if( $clefs instanceof \DateTime ) {
                    $date_format = ['fr' => 'd-m-Y', 'en' => 'm-d-Y'];
                    $locale = $request->getLocale();
                    $format = array_key_exists($locale, $date_format) ? $date_format[$locale] : $date_format['en'];
                    $clefs = $clefs->format($format );
                    $clefs = str_replace('--', '-', $clefs);
                    if( $clefs == '30-11-0001' || $clefs == '-0001-11-30' ) {
                        continue;
                    }
                }

                $clefs = str_replace(' ', '-', $clefs);
                if( !isset($operations[$clefs]) ) $operations[$clefs] = [];

                //=============== crm
                $crm->setCycle($em->getRepository('CrmBundle:Back\CrmParamCycles')->findOneBy(['id' => $operation->getIdCycle()]));
                $operation->setCrm($crm);
                //=============== cycle detail
                $operation->setCycleDetail($em->getRepository('CrmBundle:Back\CrmParamCyclesDetails')->findOneBy(['id' => $operation->getIdCycledetail()]));

                //============== append =============
                $operations[$clefs][] = $operation;
            }

        return $this->render('CrmBundle:common/crmetapesoperations:index.html.twig', array(
            'crmEtapesOperations' => $operations,
        ));
    }

    /**
     * ajax data for user operations
     *
     * @Route("/ajaxuserdate", name="crmetapesoperations_ajax_user_date")
     * @Method("GET")
     */
    public function ajaxUserAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $userDate = $request->get('userDate');
        $user = $request->get('user');
        $idOperation = $request->get('idOperation') ? $request->get('idOperation') : 0;

        // date
        $date = explode(' - ', $userDate);
        if(!count($date))
            return new JsonResponse(['return' => false, 'error' => true]);

        // date
        $dateDebut = $date[0];
        $dateFin = $date[1];

        // getting to doctrine
        $operationUsers = $em->getRepository('CrmBundle:Common\CrmOperationsUsers')->findOneBys($user, $dateDebut, $dateFin);

        // si 1 resultat est conforme à l'idOperation courant => passe
        $return = false;

        // si idOperation  == 0 for new Operation
        if( count($operationUsers) && $idOperation == 0 ) 
            $return = true;

        // si plusieurs resultat(s) sans l'idOperation courant => ne passe pas
        // si plusieurs resultat(s) avec l'idOperation courant => ne passe pas
        if( count($operationUsers) && $idOperation != 0 ) {
            foreach( $operationUsers as $operations )
                if( $operations->getIdOperation() != $idOperation ) $return = true;
        }

        // return
        return new JsonResponse(['return' => $return]);
    }

    /**
     * Creates a new crmEtapesOperations entity.
     *
     * @Route("/new", name="crmetapesoperations_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $crmEtapesOperations = new CrmEtapesOperations();
        
        // operation, crm
        $dataForm = $this->selectCRM($request, $crmEtapesOperations);

        $form = $this->createForm('CrmBundle\Form\Common\CrmEtapesOperationsType', $crmEtapesOperations, ['dataForm' => $dataForm]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // for crm
            $em->persist($crmEtapesOperations);
            $em->flush();

            // for user and notification
            $user_notif = $this->setUseAffectation($crmEtapesOperations);
            if( count($user_notif) )
                $this->setNotif($user_notif, $crmEtapesOperations);

            return $this->redirectToRoute('crmetapesoperations_index');
        }

        return $this->render('CrmBundle:common/crmetapesoperations:new.html.twig', array(
            'crmEtapesOperations' => $crmEtapesOperations,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmEtapesOperations entity.
     *
     * @Route("/{id}", name="crmetapesoperations_show")
     * @Method("GET")
     */
    public function showAction(CrmEtapesOperations $crmEtapesOperations)
    {
        $deleteForm = $this->createDeleteForm($crmEtapesOperations);

        return $this->render('CrmBundle:common/crmetapesoperations:show.html.twig', array(
            'crmEtapesOperations' => $crmEtapesOperations,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmEtapesOperations entity.
     *
     * @Route("/{id}/edit", name="crmetapesoperations_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmEtapesOperations $crmEtapesOperations)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($crmEtapesOperations);

        // user
        $users = $em->getRepository('CrmBundle:Common\CrmOperationsUsers')->findBy(['idOperation' => $crmEtapesOperations->getId()]);
        $user_ids = [];
        if( count($users) )
            foreach($users as $user)
                $user_ids[] = (string)$user->getIdRelation(); // $user->getIdUser();
        $crmEtapesOperations->setUser4affectation($user_ids);

        // operation, crm
        $dataForm = $this->selectCRM($request, $crmEtapesOperations);
        
        $editForm = $this->createForm('CrmBundle\Form\Common\CrmEtapesOperationsType', $crmEtapesOperations, ['dataForm' => $dataForm]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            // for user
            $this->setUseAffectation($crmEtapesOperations);

            // for crmEtapesOperations
            $em->persist($crmEtapesOperations);
            $em->flush();

            return $this->redirectToRoute('crmetapesoperations_edit', array('id' => $crmEtapesOperations->getId()));
        }

        return $this->render('CrmBundle:common/crmetapesoperations:edit.html.twig', array(
            'crmEtapesOperations' => $crmEtapesOperations,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmEtapesOperations entity.
     *
     * @Route("/{id}", name="crmetapesoperations_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmEtapesOperations $crmEtapesOperations)
    {
        $form = $this->createDeleteForm($crmEtapesOperations);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmEtapesOperations);
            $em->flush();
        }

        return $this->redirectToRoute('crmetapesoperations_index');
    }

    /**
     * Creates a form to delete a crmEtapesOperations entity.
     *
     * @param CrmEtapesOperations $crmEtapesOperations The crmEtapesOperations entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmEtapesOperations $crmEtapesOperations)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmetapesoperations_delete', array('id' => $crmEtapesOperations->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    private function selectCRM ($request, $crmEtapesOperations) {
        // var 
        $id_entite_juridique = 0;
        $id_cycle = 0;

        // manager
        $em = $this->getDoctrine()->getManager();

        if( ($idCRM = $request->get('idCRM')) || ($idCRM = $crmEtapesOperations->getIdCRM()) ) {
            // get crm
            $crm = $em->getRepository('CrmBundle:Common\CrmDossier')->findOneBy(['id' => $idCRM]);
            if($crm) {
                $id_entite_juridique = $crm->getIdEntiteJ();
                $id_cycle = $crm->getIdCycle();

                $crmEtapesOperations->setIdCycle($id_cycle);
            }
            $crmEtapesOperations->setIdCRM($idCRM);
        }

        // cycle detail
        $idCycleDetail = $request->get('idCycleDetail') ? $request->get('idCycleDetail') : $crmEtapesOperations->getIdCycledetail();
        if( $idCycleDetail )
            $crmEtapesOperations->setIdCycledetail($idCycleDetail);
        
        return $this->dataForm($id_entite_juridique, (int)$id_cycle, (int)$idCycleDetail);
    }

    // dataForm
    private function dataForm ($id_entite_juridique, $id_cycle, $idCycleDetail)
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'crms' => $em->getRepository('CrmBundle:Common\CrmDossier')->findAll(),
            'etapes' => $em->getRepository('CrmBundle:Common\CrmEtapes')->findAll(),
            'cyclesdetails' => $em->getRepository('CrmBundle:Back\CrmParamCyclesDetails')->findBy(['idCycle' => $id_cycle]),
            'detailActivity' => $em->getRepository('CrmBundle:Back\CrmParamCyclesDetailsActivity')->findBy(['idCycle' => $id_cycle, 'idCycledetail' => $idCycleDetail]),
            'resultats' => $em->getRepository('CrmBundle:Back\CrmParamResultat')->findAll(),
            'users'     => $em->getRepository('UsersBundle:UserClient')->findEmploye(),
            'statuts' => $em->getRepository('CrmBundle:Back\CrmParamStatut')->findAll(),
            'alertes' => $em->getRepository('CrmBundle:Back\CrmParamAlert')->findBy(['typeAlerte' => 1]),
            'rappels' => $em->getRepository('CrmBundle:Back\CrmParamAlert')->findBy(['typeAlerte' => 2]),
            'priorites' => $em->getRepository('CrmBundle:Back\CrmParamPriorites')->findAll(),
            'contact' => $em->getRepository('UsersBundle:UserClient')->findContactsClient($id_entite_juridique)
        ];
    }

    // for agenda
    private function setAgenda ($crmEtapesOperations, $id_user) 
    {
        $agenda = null;
        $em = $this->getDoctrine()->getManager();

        if( ($id = $crmEtapesOperations->getId()) != null )
            $agenda  = $em
                ->getRepository('ProjectBundle:Agenda\AgendaWorker')
                ->findOneBy(['idCRMOperation' => $id, 'idUser' => $id_user]);

        // to get crm
        $crm = $em->getRepository('CrmBundle:Common\CrmDossier')->findOneBy(['id' => $crmEtapesOperations->getIdCRM()]);

        // get bu
        $session = $this->container->get('session');
        $idBU = $session->get('BU');

        $value = [
            'idCRMOperation' => $crmEtapesOperations->getId(),
            'idEntityJ' => $crm->getIdEntiteJ(),
            'idUser' => $id_user,
            'dateDebPrevue' => $crmEtapesOperations->getDatedebutprevue(),
            'dateFinPrevue' => $crmEtapesOperations->getDatefinprevue(),
            'dateDebReelle' => $crmEtapesOperations->getDatedebutreelle(),
            'dateFinReelle' => $crmEtapesOperations->getDatefinreelle()
        ];

        if( $this->getUser() )
            $value['idBU'] = $idBU;

        return \ProjectBundle\Entity\Agenda\AgendaWorker::MinAgenda($value, $agenda);
    }

    // for user
    private function setUseAffectation($crmEtapesOperations, $idUser = null) 
    {
        $em = $this->getDoctrine()->getManager();
        $users = $crmEtapesOperations->getUser4affectation();
        $user_s = $users; // store

        foreach ($users as $key => $user) {
            $u = explode('-', $user);
            $users[$key] = (int)$u[0];
        }

        /* à supprimer d'abord **/
        $operation_users = $em->getRepository('CrmBundle:Common\CrmOperationsUsers')->findBy(['idOperation' => $crmEtapesOperations->getId()]);
        if( count($operation_users) )
            foreach( $operation_users as $user )
                if( !in_array($user->getIdUser(), $users) ) {

                    // pour supprimer l'agenda
                    $bu = $this->container->get('session');
                    $crm = $em->getRepository('CrmBundle:Common\CrmDossier')->findOneBy(['id' => $crmEtapesOperations->getIdCRM()]);
                    $find = [
                        'idEntityJ' => $crm->getIdEntiteJ(), 
                        'idCRMOperation' => $crmEtapesOperations->getId(), 
                        'idUser' => $user->getIdUser()];
                    if( $this->getUser() ) $find['idBU'] = $bu->get('BU');

                    $agendas = $em->getRepository('ProjectBundle:Agenda\AgendaWorker')->findBy($find);

                    if( count($agendas) )
                        foreach($agendas as $agenda) {
                            $em->remove($agenda);
                            $em->flush ();
                        }

                    $em->remove($user);  // on supprime
                    $em->flush();
                }

        // debut
        if( $crmEtapesOperations->getDatedebutreelle() != '0000-00-00' ) {
            $datedebut = $crmEtapesOperations->getDatedebutreelle();
        }
        else {
            $datedebut = $crmEtapesOperations->getDatedebutprevue();
        }

        // fin
        if( $crmEtapesOperations->getDatefinreelle()  != '0000-00-00' ) {
            $datefin = $crmEtapesOperations->getDatefinreelle();
        }
        else {
            $datefin = $crmEtapesOperations->getDatefinprevue();
        }
        
        /* maj ou ajout des nouveaux */
        $user_notif = [];
        foreach( $users as $key => $id ) {
            $operation_users = $em->getRepository('CrmBundle:Common\CrmOperationsUsers')->findOneBy(['idUser' => $id]);
            $operation_users = $operation_users ? $operation_users : new \CrmBundle\Entity\Common\CrmOperationsUsers();

            // set idElement
            $operation_users->setIdCRM($crmEtapesOperations->getIdCRM());
            $operation_users->setIdOperation($crmEtapesOperations->getId());

            // set idRelation
            $operation_users->setIdRelation($user_s[$key]);
            $operation_users->setDatedebut($datedebut);
            $operation_users->setDatefin($datefin);

            //set idUser
            $user = $em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $id]);
            $operation_users->setUser($user);

            $em->persist($operation_users);
            $em->flush();

            // notification / mail
            $user_notif[] = $user;

            // for agenda 
            $agenda = $this->setAgenda($crmEtapesOperations, $id);
            $em->persist($agenda);
            $em->flush();
        }

        return $user_notif;
    }

    /**
     * Setting Notif to mail to user project
     */
    private function setNotif ($users, $operation) {
        $cm = $this->container->get('codemail');
        $codemail = $cm->getCode();

        $recip = [];
        foreach($users as $user) {
            $recip[] = $user->getId() . '_' . $user->getEmail();
        }

        $recipient = $this->get('envoimail_handler');
        $recipient->mailNotif('Création d\'une opération', "Une opération est crée et s'intitule \"{$operation->getObjet()}\"", $codemail, $recip);
    }
}
