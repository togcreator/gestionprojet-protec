<?php

namespace ProjectBundle\Controller\Common;

use ProjectBundle\Entity\Common\ProjectEtape;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Projectetape controller.
 *
 * @Route("projet/etape")
 */
class ProjectEtapeController extends Controller
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
     * Lists all projectEtape entities.
     *
     * @Route("/", name="projectetape_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projectEtapes = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findAll();
        if( count($projectEtapes) )
            foreach( $projectEtapes as $key => &$etape ) {
                $currentUser = $this->getUser()->getId();
                if( $etape->getProjet()->getIdCreateur() != $currentUser && $currentUser != 1 ) 
                    unset($projectEtapes[$key]);
            }

        return $this->render('ProjectBundle:common\projectetape:index.html.twig', array(
            'projectEtapes' => $projectEtapes,
        ));
    }
    
    /**
     * Creates a new projectEtape entity.
     *
     * @Route("/new", name="projectetape_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        /* entity manager */
        $em = $this->getDoctrine()->getManager();
        /** project etape **/
        $projectEtape = new Projectetape();

        //======================= utilisateur ======================
        $project_users = [];
        if( ($idProject = $request->get('idProjet')) ) {
            $project_users = array_map(function($object) {
                    if( !is_object($object) ) return;
                    return $object->getIdUser();
                }, 
                $em->getRepository('ProjectBundle:Common\ProjectVersionUser')->findEmploye(['idProjetVersion' => $idProject])
            );
        }
        //==========================================================

        $form = $this->createForm('ProjectBundle\Form\Common\ProjectEtapeType', $projectEtape, ['dataForm' => $this->dataForm($project_users)]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /* date de création */
            $projectEtape->setDateCreation(new \DateTime('now '.date('e')));

            // pour project
            $this->setProject($projectEtape);

            // for statut
            $this->setStatut($projectEtape);

            // pour code
            \AppBundle\Entity\Classes\Utils::setCode($projectEtape);

            // flush it
            $em->persist($projectEtape);
            $em->flush();

            // pour user affectation
            $this->setUseAffectation($projectEtape);

            // pour agenda 
            $this->setAgenda($projectEtape);

            return $this->redirectToRoute('projectetape_edit', ['id' => $projectEtape->getId()]);
        }

        return $this->render('ProjectBundle:common\projectetape:new.html.twig', array(
            'projectEtape' => $projectEtape,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projectEtape entity.
     *
     * @Route("/{id}", name="projectetape_show")
     * @Method("GET")
     */
    public function showAction(ProjectEtape $projectEtape)
    {
        $deleteForm = $this->createDeleteForm($projectEtape);

        return $this->render('ProjectBundle:common\projectetape:show.html.twig', array(
            'projectEtape' => $projectEtape,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projectEtape entity.
     *
     * @Route("/{id}/edit", name="projectetape_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProjectEtape $projectEtape)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($projectEtape);

        //======================== utilisateur ===========================
        $users = $em->getRepository('ProjectBundle:Common\ProjectEtapesUsers')->findBy(['idEtape' => $projectEtape->getId()]);
        $user_ids = [];
        if( count($users) )
            foreach($users as $user)
                $user_ids[] = $user->getIdUser();
        $projectEtape->setUser4affectation($user_ids);

        /* pour user et l'etape lui même */
        $project_users = [];
        $project_users = array_map(function($object) {
                if( !is_object($object) ) return;
                return $object->getIdUser();
            }, 
            $em->getRepository('ProjectBundle:Common\ProjectVersionUser')->findEmploye(['idProjetVersion' => $projectEtape->getIdProjetVersion()])
        );
        //=================================================================

        $editForm = $this->createForm('ProjectBundle\Form\Common\ProjectEtapeType', $projectEtape, ['dataForm' => $this->dataForm($project_users)]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            /* pour agenda */
            $this->setAgenda($projectEtape);
            /* pour user */
            $this->setUseAffectation($projectEtape);

            /* pour projectEtape */
            $em->persist($projectEtape);
            $em->flush();

            return $this->redirectToRoute('projectetape_edit', array('id' => $projectEtape->getId()));
        }

        return $this->render('ProjectBundle:common\projectetape:edit.html.twig', array(
            'projectEtape' => $projectEtape,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projectEtape entity.
     *
     * @Route("/{id}", name="projectetape_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProjectEtape $projectEtape)
    {
        $form = $this->createDeleteForm($projectEtape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectEtape);
            $em->flush();
        }

        /* got to referer */
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }

    /**
     * Creates a form to delete a projectEtape entity.
     *
     * @param ProjectEtape $projectEtape The projectEtape entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectEtape $projectEtape)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projectetape_delete', array('id' => $projectEtape->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // setting dataForm
    private function dataForm ($project_users = []) 
    {
        $em = $this->getDoctrine()->getManager();
        // getting user project owner
        return [
            'projects'  => $em->getRepository('ProjectBundle:Common\Project')->findAll(),
            'resultats' => $em->getRepository('ProjectBundle:Back\Resultat')->findAll(),
            'users'     => $em->getRepository('UsersBundle:UserClient')->findEmploye(),
            'statuts'   => $em->getRepository('ProjectBundle:Back\Statut')->findAll(),
            'project_users' => $project_users
        ];
    }

    // pour project
    private function setProject ($projectEtape)
    {
        $projet_id = $projectEtape->getIdProjetVersion();
        $projet = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Common\Project')->findOneBy(['id' => $projet_id]);
        $projectEtape->setProjet($projet);
    }

    // pour user
    private function setUseAffectation($projectEtapes) 
    {
        $em = $this->getDoctrine()->getManager();
        $users = $projectEtapes->getUser4affectation();
        if( !count($users) ) return;

        /* à supprimer d'abord **/
        $etape_users = $em->getRepository('ProjectBundle:Common\ProjectEtapesUsers')->findBy(['idEtape' => $projectEtapes->getId()]);
        if( count($etape_users) )
            foreach( $etape_users as $user )
                if( !in_array($user->getIdUser(), $users) ) {
                    $em->remove($user);  // on supprime
                    $em->flush();
                }

        /* maj ou ajout des nouveaux */
        foreach( $users as $id ) {
            // étape users
            $etape_users = $em->getRepository('ProjectBundle:Common\ProjectEtapesUsers')->findOneBy(['idUser' => $id]);
            $etape_users = $etape_users ? $etape_users : new \ProjectBundle\Entity\Common\ProjectEtapesUsers();

            // paramètre
            $etape_users->setIdProjetversion($projectEtapes->getIdProjetVersion());
            $etape_users->setIdEtape($projectEtapes->getIdEtape());

            $user = $em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $id ]);
            $etape_users->setUser($user);

            /* transaction dans la base de donnée */
            $em->persist($etape_users);
            $em->flush();
        }
    }

    // for statut
    private function setStatut ($projectEtapes) 
    {
        $statut = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Back\Statut')->findOneBy(['id'=>$projectEtapes->getIdStatut()]);
        $projectEtapes->setStatuts($statut);
    }

    // pour agenda
    private function setAgenda ($projectEtapes) 
    {
        $agenda = null;
        if( ($id = $projectEtapes->getId()) != null )
            $agenda  = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Agenda\AgendaWorker')->findOneBy(['idProjetEtape' => $id]);

        $value = [
            'idProjetEtape' => $projectEtapes->getId(),
            'dateDebPrevue' => $projectEtapes->getDatedebutprevue(),
            'dateFinPrevue' => $projectEtapes->getDatefinprevue(),
            'dateDebReelle' => $projectEtapes->getDatedebutreelle(),
            'dateFinReelle' => $projectEtapes->getDatefinreelle()
        ];

        $agenda = \ProjectBundle\Entity\Agenda\AgendaWorker::MinAgenda($value, $agenda);

        /** enregistrer dans la bdd **/
        $em = $this->getDoctrine()->getManager();
        $em->persist($agenda);
        $em->flush();
    }
}
