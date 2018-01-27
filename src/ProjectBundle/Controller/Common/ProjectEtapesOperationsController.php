<?php

namespace ProjectBundle\Controller\Common;

use ProjectBundle\Entity\Common\ProjectEtapesOperations;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Projectetapesoperation controller.
 *
 * @Route("projet/etapesoperations")
 */
class ProjectEtapesOperationsController extends Controller
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
        $manager = $this->getDoctrine()->getManager();
        return $manager->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $session_id]);
    }

    /**
     * Lists all projectEtapesOperation entities.
     *
     * @Route("/", name="projectetapesoperations_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projectEtapesOperations = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findAll();
        if( count($projectEtapesOperations) )
            foreach($projectEtapesOperations as &$operations) {
                $currentUser = $this->getUser();
                $operations->setProjet($em->getRepository('ProjectBundle:Common\Project')->findOneBy(['id' => $operations->getIdProjectVersion()]));
                if($operations->getProjet()->getIdCreateur() != $currentUser && $currentUser != 1) {
                    unset($operations);
                    continue;
                }
                $operations->setEtape($em->getRepository('ProjectBundle:Common\ProjectEtape')->findOneBy(['id' => $operations->getIdEtape()]));
            }

        return $this->render('ProjectBundle:common/projectetapesoperations:index.html.twig', array(
            'projectEtapesOperations' => $projectEtapesOperations,
        ));
    }

    /**
     * ajax data for user operations
     *
     * @Route("/ajaxuserdate", name="projectetapesoperations_ajax_user_date")
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
        $operationUsers = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsUsers')->findOneBys($user, $dateDebut, $dateFin);

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
     * Lists ajax data
     *
     * @Route("/ajax", name="projectetapesoperations_ajax_get")
     * @Method({"GET", "POST"})
     */
    public function ajaxAction(Request $request)
    {
        // getting etape by idProjectVersion
       if( ($idProjectVersion = $request->get('idProjectVersion')) && $request->get('request') == 'etapes')
       {
            $etapes = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Common\ProjectEtape')->findBy(['idProjetVersion'=>$idProjectVersion]);
            if( !$etapes ) return new JsonResponse(array('result'=>false));

            // json return
            $json = ['result'=>true, 'data' => []];
            foreach($etapes as $etape)
                $json['data'][$etape->getId()] = $etape->getObject();
            return new JsonResponse($json);
       }

       // getting agenda by idEtape
       if( ($idProjetEtape = $request->get('idEtape')) && $request->get('request') == 'agenda')
       {
            $agendas = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Agenda\AgendaWorker')->findBy(['idProjetEtape'=>$idProjetEtape]);
            if( !$agendas ) return new JsonResponse(array('result'=>false));
            // json return
            $json = ['result'=>true, 'data'=>[]];
            foreach($agendas as $agenda)
                $json['data'][$agenda->getId()] = $agenda->getTitre();
            return new JsonResponse($json);
       }

       if(($id = $request->get('id'))) 
        {
            $em = $this->getDoctrine()->getManager();

            /* pour etapes jalons */
            $etapesjalons = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findOneBy(['id' => $id]);
            if( !$etapesjalons ) 
                return new JsonResponse(['resultat' => false]);

            /* pour agenda*/
            $agenda = $em->getRepository('ProjectBundle:Agenda\AgendaWorker')->findOneBy(['idProjetOperation' => $id]);            
            ob_start();
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title"><?php echo $etapesjalons->getObject() ?></h5>
            </div>

            <div class="modal-body">
                <div class="fullcalendar-event-colors"></div>
                <script type="text/javascript">
                    // var eventColors = 
                    //     {
                    //         title: '{{ 'projectetape.title'|trans({}, 'projectetape') }} - {{ etape.object|raw }}',
                    //         start: '{{ etape.datedebutprevue|date('Y-m-d') }}',
                    //         end: '{{ etape.datefinprevue|date('Y-m-d') }}',
                    //         color: '#EF5350',
                    //         url: '{{ path('projectetape_edit', {'id': etape.id }) }}'
                    //     },
                    //     {
                    //         title: '{{ 'projectetape.title'|trans({}, 'projectetape') }} - {{ etape.object|raw }}',
                    //         start: '{{ etape.datedebutreelle|date('Y-m-d') }}',
                    //         end: '{{ etape.datefinreelle|date('Y-m-d') }}',
                    //         color: '#26A69A',
                    //         url: '{{ path('projectetape_edit', {'id': etape.id }) }}'
                    //     },
                </script>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $this->container->get('translator')->trans('global.close_button') ?></button>
            <?php
            $html = ob_get_contents();
            ob_end_clean();

            return new Response($html);
       }

       return new JsonResponse(array('result'=>false));
    }
    
    /**
     * Creates a new projectEtapesOperation entity.
     *
     * @Route("/new", name="projectetapesoperations_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        /* entity manager */
        $em = $this->getDoctrine()->getManager();
        $dataForm = $this->dataForm();

        /* entity operations */
        $projectEtapesOperation = new ProjectEtapesOperations();

        /* pour projet */
        if( ($idProject = $request->get('idProject')) || ($idProject = $request->get('idProjet')) ) {
            $users = array_map(function($object) {
                    if( !is_object($object) ) return;
                    return $object->getIdUser();
                }, 
                $em->getRepository('ProjectBundle:Common\ProjectVersionUser')->findEmploye(['idProjetVersion' => $idProject])
            );
            // pour les users
            $dataForm['project_users'] = $users;

            /* pour setter idProjectVersion */
            $projectEtapesOperation->setIdProjectVersion($idProject);
            /* pour etape zéro */
            $projectEtapesOperation->setIdEtape(0);

            /* pour l'étape du projet e question */
            $etapes = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findBy(['idProjetVersion' => $idProject]);
            $dataForm['etapes'] = $etapes;
        }
        /* end of */

        /* pour etape */
        if(($idEtape = $request->get('idEtape')))
        {   
            $etape = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findOneBy(['id' => $idEtape]);
            // pour projet
            $projectEtapesOperation->setIdProjectVersion($etape->getProjet()->getId());
            // pour etape
            $projectEtapesOperation->setIdEtape($etape->getId());
        }

        $form = $this->createForm('ProjectBundle\Form\Common\ProjectEtapesOperationsType', $projectEtapesOperation, ['dataForm' => $dataForm]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // etape
            // $this->setEtape($projectEtapesOperation);

            // pour agenda
            $id_agenda = $this->setAgenda($projectEtapesOperation);
           
            // getting id agenda
            $projectEtapesOperation->setIdAgenda($id_agenda);

            /* pour prirorite */
            $this->setPriorite($projectEtapesOperation);

            /* pour statut */
            $this->setStatut($projectEtapesOperation);

            // pour operation
            $em->persist($projectEtapesOperation);
            $em->flush();

            // pour user
            $this->setUseAffectation($projectEtapesOperation);

            // =============================================
            $this->setNotif($projectEtapesOperation);
            
            // pour agenda 
            $this->setAgenda($projectEtapesOperation);

            // redirect ot project
            if( $request->get('idProject') || $request->get('idProjet') || $request->get('idEtape') )
                return $this->redirectToRoute('project_edit', ['id' => $projectEtapesOperation->getIdProjectVersion(), '_fragment' => 'operation']);

            return $this->redirectToRoute('projectetapesoperations_index');
        }

        return $this->render('ProjectBundle:common/projectetapesoperations:new.html.twig', array(
            'projectEtapesOperation' => $projectEtapesOperation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projectEtapesOperation entity.
     *
     * @Route("/{id}", name="projectetapesoperations_show")
     * @Method("GET")
     */
    public function showAction(ProjectEtapesOperations $projectEtapesOperation)
    {
        $deleteForm = $this->createDeleteForm($projectEtapesOperation);

        return $this->render('ProjectBundle:common/projectetapesoperations:show.html.twig', array(
            'projectEtapesOperation' => $projectEtapesOperation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projectEtapesOperation entity.
     *
     * @Route("/{id}/edit", name="projectetapesoperations_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProjectEtapesOperations $projectEtapesOperation)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($projectEtapesOperation);
        $dataForm = $this->dataForm(); // dataForm

        /* pour user affectation */
        $users = array_map(function($object) {
                if( !is_object($object) ) return;
                return $object->getIdUser();
            }, 
            $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsUsers')->findBy(['idOperation' => $projectEtapesOperation->getId()])
        );
        $projectEtapesOperation->setUser4affectation($users);

        // pour le projet
        $users = array_map(function($object) {
                if( !is_object($object) ) return;
                return $object->getIdUser();
            }, 
            $em->getRepository('ProjectBundle:Common\ProjectVersionUser')->findEmploye(['idProjetVersion' => $projectEtapesOperation->getIdProjectVersion()])
        );
        // pour les users
        $dataForm['project_users'] = $users;

        /* for etape */
        $dataForm['etapes'] = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findBy(['idProjetVersion' => $projectEtapesOperation->getIdProjectVersion()]);

        $editForm = $this->createForm('ProjectBundle\Form\Common\ProjectEtapesOperationsType', $projectEtapesOperation, ['dataForm' => $dataForm]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            // pour agenda 
            $this->setAgenda($projectEtapesOperation);

            // pour user
            $this->setUseAffectation($projectEtapesOperation);

            // pour projectEtapesOperation
            $em->persist($projectEtapesOperation);
            $em->flush();

            // redirect ot project
            if( $request->get('idProjet') )
                return $this->redirectToRoute('project_edit', ['id' => $projectEtapesOperation->getIdProjectVersion(), '_fragment' => 'operation']);


            return $this->redirectToRoute('projectetapesoperations_edit', array('id' => $projectEtapesOperation->getId()));
        }

        // on affiche les note et documents du projet en cours
        $projectNotes = $em->getRepository('ProjectBundle:Common\ProjectNotes')->findBy(['idOperation' => $projectEtapesOperation->getId()]);
        $projectDocs = $em->getRepository('ProjectBundle:Common\ProjectDocs')->findBy(['idOperation' => $projectEtapesOperation->getId()]);
       
        // les intervenants
        $projectEtapesOperationsUsers = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsUsers')->findBy(['idOperation' => $projectEtapesOperation->getId()]);
        if($projectEtapesOperationsUsers) {
            foreach ($projectEtapesOperationsUsers as &$pOu) 
                if( ($id_role = $pOu->getIdRole()) )
                    $pOu->setRole($em->getRepository('ProjectBundle:Back\Roles')->findOneBy(['id' => $id_role]));
        }

        return $this->render('ProjectBundle:common/projectetapesoperations:edit.html.twig', array(
            'projectEtapesOperation' => $projectEtapesOperation,
            'projectNotes' => $projectNotes,
            'projectDocs' => $projectDocs,
            'projectEtapesOperationsUsers' => $projectEtapesOperationsUsers,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projectEtapesOperation entity.
     *
     * @Route("/{id}", name="projectetapesoperations_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProjectEtapesOperations $projectEtapesOperation)
    {
        $form = $this->createDeleteForm($projectEtapesOperation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectEtapesOperation);
            $em->flush();
        }

        $referer = $request->headers->get('referer');
        if( preg_match('/edit/', $referer) )
            $referer = $referer . '#operation';
        return $this->redirect($referer);
    }

    /**
     * Creates a form to delete a projectEtapesOperation entity.
     *
     * @param ProjectEtapesOperations $projectEtapesOperation The projectEtapesOperation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectEtapesOperations $projectEtapesOperation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projectetapesoperations_delete', array('id' => $projectEtapesOperation->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    // étape
    private function setEtape ($projectEtapesOperation) 
    {
        $em = $this->getDoctrine()->getManager();
        $idEtape = $projectEtapesOperation->getIdEtape();
        $etapes = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findOneBy(['id' => $idEtape]);
        /* test si exist ou null */
        $etapes = $etapes ? $etapes : 0;
        // dump($etapes); exit;
        $projectEtapesOperation->setEtape($etapes);
    }

    // pour user
    private function setUseAffectation($projectEtapesOperation, $idUser = null) 
    {
        $em = $this->getDoctrine()->getManager();
        $users = $projectEtapesOperation->getUser4affectation();

        /* à supprimer d'abord **/
        $operation_users = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsUsers')->findOneBy(['idOperation' => $projectEtapesOperation->getId()]);
        if( count($operation_users) )
            foreach( $operation_users as $user )
                if( !in_array($user->getIdUser(), $users) ) 
                {
                    $em->remove($user);  // on supprime
                    $em->flush();
                }

        /* maj ou ajout des nouveaux */
        foreach( $users as $id ) {
            
            $operation_users = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsUsers')->findOneBy(['idUser' => $id]);
            $operation_users = $operation_users ? $operation_users : new \ProjectBundle\Entity\Common\ProjectEtapesOperationsUsers();

            // date
            $date = explode(' - ', $projectEtapesOperation->getUserDate());
            $dateDebut = $date[0];
            $dateFin = $date[1];

            $dateDebut = str_replace('-', '/', $dateDebut);
            $dateFin = str_replace('-', '/', $dateFin);

            $operation_users->setIdProjetversion($projectEtapesOperation->getIdProjectVersion());
            $operation_users->setIdEtape($projectEtapesOperation->getIdEtape());
            $operation_users->setOperation($projectEtapesOperation);
            $operation_users->setDateDebut(date('Y/m/d H:i:s', strtotime($dateDebut)));
            $operation_users->setDateFin(date('Y/m/d H:i:s', strtotime($dateFin)));

            $user = $em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $id]);
            $operation_users->setUser($user);

            // sauvegarde
            $em->persist($operation_users);
            $em->flush();
        }

        // exit;
    }

    /* priorites */
    public function setPriorite ($projectEtapesOperation) {
        $em = $this->getDoctrine()->getManager();
        $priorite = $em->getRepository('ProjectBundle:Back\Priorites')->findOneBy(['id' => $projectEtapesOperation->getIdPriorite()]);
        $projectEtapesOperation->setPriorites($priorite);
    }

    /* priorites */
    public function setStatut ($projectEtapesOperation) {
        $em = $this->getDoctrine()->getManager();
        $statut = $em->getRepository('ProjectBundle:Back\Statut')->findOneBy(['id' => $projectEtapesOperation->getIdStatut()]);
        $projectEtapesOperation->setStatuts($statut);
    }

    // data for form
    private function dataForm() {
        $em = $this->getDoctrine()->getManager();
        return [
            'etapes'        => $em->getRepository('ProjectBundle:Common\ProjectEtape')->findAll(), 
            'projects'      => $em->getRepository('ProjectBundle:Common\Project')->findAll(), 
            'jalons'    => $em->getRepository('ProjectBundle:Common\ProjectEtapesJalons')->findAll(),
            'users'         => $em->getRepository('UsersBundle:UserClient')->findAll(),
            // other
            'priorites'     => $em->getRepository('ProjectBundle:Back\Priorites')->findAll(),
            'statuts'       => $em->getRepository('ProjectBundle:Back\Statut')->findAll(),
            'alerts'        => $em->getRepository('ProjectBundle:Back\ProjectAlert')->findAll(),
            'resultats'     => $em->getRepository('ProjectBundle:Back\Resultat')->findAll(),
        ];
    }

    // pour agenda
    private function setAgenda ($projectEtapesOperation) 
    {
        // les variables
        $agenda = null;
        $em = $this->getDoctrine()->getManager();

        if( ($id = $projectEtapesOperation->getId()) != null )
            $agenda  = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Agenda\AgendaWorker')->findOneBy(['idProjetOperation' => $id]);

        $value = [
            'idProjetOperation' => $projectEtapesOperation->getId(),
            'dateDebPrevue' => $projectEtapesOperation->getDatedebutprevue(),
            'dateFinPrevue' => $projectEtapesOperation->getDatefinprevue(),
            'dateDebReelle' => $projectEtapesOperation->getDatedebutreelle(),
            'dateFinReelle' => $projectEtapesOperation->getDatefinreelle()
        ];

        $agenda = \ProjectBundle\Entity\Agenda\AgendaWorker::MinAgenda($value, $agenda);

        // sauvegarde
        $em->persist($agenda);
        $em->flush();

        return $agenda->getId();
    }

    /**
    * Setting Notif to mail to user project
    *
    * @return null
    */
    private function setNotif ($operation) {
        $cm = $this->container->get('codemail');
        $codemail = $cm->getCode();

        $recip = [];
        $users = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Common\ProjectEtapesOperationsUsers')->findBy(['idOperation' => $operation->getId()]);
        foreach($users as $user) {
            $recip[] = $user->getUser()->getId() . '_' . $user->getUser()->getEmail();
        }

        $recipient = $this->get('envoimail_handler');
        $recipient->mailNotif('Création d\'une opération', "Une opération est crée et s'intitule \"{$operation->getObject()}\"", $codemail, $recip);
    }
}