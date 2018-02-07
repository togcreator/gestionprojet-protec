<?php

namespace ProjectBundle\Controller\Common;

use ProjectBundle\Entity\Common\ProjectNotes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Projectnote controller.
 *
 * @Route("projet/notes")
 */
class ProjectNotesController extends Controller
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
     * Lists ajax.
     *
     * @Route("/ajax", name="projectnotes_ajax_get")
     * @Method("GET")
     */
    public function ajaxAction(Request $request)
    {
        if(($id = $request->get('idNote'))) {
            $note = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Common\ProjectNotes')->findOneBy(['id' => $id]);
            if( !$note ) 
                return new JsonResponse(['resultat' => false]);
            
            ob_start();
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title"><?php echo $note->getTitre() ?></h5>
            </div>

            <div class="modal-body">
               <p><?php echo $note->getObjet() ?></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $this->container->get('translator')->trans('global.close_button') ?></button>
            <?php
            $html = ob_get_contents();
            ob_end_clean();

            return new Response($html);
       }
    }

    /**
     * Lists all projectNote entities.
     *
     * @Route("/", name="projectnotes_index")
     * @Method("GET")
     */
    public function indexAction(Request $request )
    {
        $criter = $request->get('idProject') ? ['idProjectVersion' => $request->get('idProject')] : [];
        $user_id = is_object($this->getUser()) ? $this->getUser()->getId() : null;
        $bu_id = $this->container->get('session')->get('BU');

        $em = $this->getDoctrine()->getManager();
        $projectNotes = $em->getRepository('ProjectBundle:Common\ProjectNotes')->findAllBy($criter, $user_id, $bu_id);
        if( $projectNotes )
            foreach( $projectNotes as $notes ) {
                $notes->setEtape($em->getRepository('ProjectBundle:Common\ProjectEtape')->findOneBy(['id' => $notes->getIdEtape()]));
                $notes->setOperation($em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findOneBy(['id' => $notes->getIdOperation()]));
            }

        return $this->render('ProjectBundle:common/projectnotes:index.html.twig', array(
            'projectNotes' => $projectNotes,
        ));
    }

    /**
     * Creates a new projectNote entity.
     *
     * @Route("/new", name="projectnotes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $projectNote = new ProjectNotes();
        $em = $this->getDoctrine()->getManager();
        $dataForm = $this->dataForm();
        $idProject = 0;

        /* pour opération */
        if(($idOperation = $request->get('idOperation'))) {
            if(($project = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findOneBy(['id' => $idOperation]))){
                /* pour setter idProjectVersion */
                $projectNote->setIdOperation($idOperation);

                $project = $em->getRepository('ProjectBundle:Common\Project')->findOneBy(['id' => $project->getIdProjectVersion()]);
                $idProject = $project->getId();
            } else
            /* si id non valide */
                return $this->redirectToRoute('projectnotes_new');
        }

        /* pour projet */
        if( $idProject || ($idProject = $request->get('idProject')) || ($idProject = $request->get('idProjet')) ) {
            /* pour setter idProjectVersion */
            $projectNote->setIdProjetVersion($idProject);
            /* pour etape zéro */
            $projectNote->setIdEtape(0);

            /* pour l'étape du projet e question */
            $etapes = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findBy(['idProjetVersion' => $idProject]);
            $dataForm['etapes'] = $etapes;

            /* pour l'opération du projet e question */
            $operations = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findBy(['idProjectVersion' => $idProject]);
            $dataForm['operations'] = $operations;

            /* pour l'opération issue du projet e question */
            $issues = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsIssues')->findBy(['idProjectVersion' => $idProject]);
            $dataForm['issues'] = $issues;
        }

        if( ($idEtape = $request->get('idEtape')) ) {
            /* pour etape zéro */
            $projectNote->setIdEtape($idEtape);

            /* pour l'étape du projet e question */
            $idProject = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findOneBy(['id' => $idEtape]);
            if( $idProject ) 
            {
                $idProject = $idProject->getIdProjetVersion();
                /* pour setter idProjectVersion */
                $projectNote->setIdProjetVersion($idProject);

                /* pour l'étape du projet e question */
                $etapes = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findBy(['idProjetVersion' => $idProject]);
                $dataForm['etapes'] = $etapes;

                /* pour l'opération du projet e question */
                $operations = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findBy(['idEtape' => $idEtape]);
                $dataForm['operations'] = $operations;

                /* pour l'opération issue du projet e question */
                $issues = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsIssues')->findBy(['idProjectVersion' => $idProject]);
                $dataForm['issues'] = $issues;
            }
        }

        $form = $this->createForm('ProjectBundle\Form\Common\ProjectNotesType', $projectNote, ['dataForm' => $dataForm]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projectNote->setDate(new \DateTime('now '.date('e'))); //date creation

            // for project
            $this->setProject($projectNote);
            // pour user
            $this->setUser($projectNote);

            // pour le code
            \AppBundle\Entity\Classes\Utils::setCode($projectNote);

            // =============================================
            $this->setNotif($projectNote);

            // projectNote
            $em->persist($projectNote);
            $em->flush();

            // redirect vers operation
            if( $request->get('idOperation') )
                return $this->redirectToRoute('projectetapesoperations_edit', ['id' => $projectNote->getIdOperation(), '_fragment' => 'note']);

            // redirect vers project
            if( $request->get('idProject') || $request->get('idEtape') )
                return $this->redirectToRoute('project_edit', ['id' => $projectNote->getIdProjetVersion(), '_fragment' => 'note']);

            // redirect to liste
            return $this->redirectToRoute('projectnotes_index');
        }

        return $this->render('ProjectBundle:common/projectnotes:new.html.twig', array(
            'projectNote' => $projectNote,
            'form' => $form->createView(),
        ));
    }



    /**
     * Finds and displays a projectNote entity.
     *
     * @Route("/{id}", name="projectnotes_show")
     * @Method("GET")
     */
    public function showAction(ProjectNotes $projectNote)
    {
        $deleteForm = $this->createDeleteForm($projectNote);

        return $this->render('ProjectBundle:common/projectnotes:show.html.twig', array(
            'projectNote' => $projectNote,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projectNote entity.
     *
     * @Route("/{id}/edit", name="projectnotes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProjectNotes $projectNote)
    {
        /* les variables */
        $deleteForm = $this->createDeleteForm($projectNote);
        $em = $this->getDoctrine()->getManager();
        $dataForm = $this->dataForm();

        /* pour l'étape du projet e question */
        $etapes = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findBy(['idProjetVersion' => $projectNote->getIdProjetVersion()]);
        $dataForm['etapes'] = $etapes;

        /* operation et issue */
        $dataForm['operations'] = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findBy(['idProjectVersion' => $projectNote->getIdProjetVersion()]);
        $dataForm['issues'] = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsIssues')->findBy(['idProjectVersion' => $projectNote->getIdProjetVersion()]);

        $editForm = $this->createForm('ProjectBundle\Form\Common\ProjectNotesType', $projectNote, ['dataForm' => $dataForm]);
        $editForm->handleRequest($request);        

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            // pour project
            $this->setProject($projectNote);
            $em->flush();

            // redirect vers operation
            if( $request->get('idOperation') )
                return $this->redirectToRoute('projectetapesoperations_edit', ['id' => $projectNote->getidOperation(), '_fragment' => 'note']);

            // redirect vers project
            if( $request->get('submit') || $request->get('idProject') )
                return $this->redirectToRoute('project_edit', ['id' => $projectNote->getIdProjetVersion(), '_fragment' => 'note']);

            return $this->redirectToRoute('projectnotes_edit', array('id' => $projectNote->getId()));
        }

        return $this->render('ProjectBundle:common/projectnotes:edit.html.twig', array(
            'projectNote' => $projectNote,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projectNote entity.
     *
     * @Route("/{id}", name="projectnotes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProjectNotes $projectNote)
    {
        $form = $this->createDeleteForm($projectNote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectNote);
            $em->flush();
        }

        $referer = $request->headers->get('referer');
        if( preg_match('/edit/', $referer) )
            $referer = $referer . '#note';

        return $this->redirect($referer);
    }

    /**
     * Creates a form to delete a projectNote entity.
     *
     * @param ProjectNotes $projectNote The projectNote entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectNotes $projectNote)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projectnotes_delete', array('id' => $projectNote->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // for element
    private function setProject ($projectNote)
    {
        // for project
        $project = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Common\Project')->findOneBy(['id' => $projectNote->getIdProjetVersion()]);
        $projectNote->setProject($project);
    }

    // pour la personne qui la créer
    private function setUser($projectNote) {
        // for user
        $user_id = $projectNote->getIdUser();
        $user = $this->getDoctrine()->getManager()->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $user_id]);
        $projectNote->setUser($user);
    }

    // / dataForm
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'projects' => $em->getRepository('ProjectBundle:Common\Project')->findAll(),
            'etapes' => $em->getRepository('ProjectBundle:Common\ProjectEtape')->findAll(),
            'operations' => $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findAll(),
            'issues' => $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsIssues')->findAll(),
        ];
    }

    /**
    * Setting Notif to mail to user project
    *
    * @return null
    */
    private function setNotif ($projectNote) {
        $cm = $this->container->get('codemail');
        $codemail = $cm->getCode();

        $recip = [];
        $users = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Common\ProjectVersionUser')->findBy(['idProjetVersion' => $projectNote->getIdProjetVersion()]);
        foreach($users as $user) {
            $recip[] = $user->getUser()->getId() . '_' . $user->getUser()->getEmail();
        }

        $recipient = $this->get('envoimail_handler');
        $recipient->mailNotif('Création d\'une note', "Une note est crée qui s'intitule \"{$projectNote->getTitre()}\"", $codemail, $recip);
    }
}
