<?php

namespace ProjectBundle\Controller\Common;

use ProjectBundle\Entity\Common\ProjectEtapesOperationsIssues;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Projectetapesoperationsissue controller.
 *
 * @Route("projet/operationsissues")
 */
class ProjectEtapesOperationsIssuesController extends Controller
{
    /**
     * Lists all by ajax
     *
     * @Route("/ajax", name="operationsissues_ajax_get")
     * @Method("GET")
     */
    public function ajaxAction(Request $request)
    {
        // getting etape by idProjectVersion
       if( ($idProjectVersion = $request->get('idProjectVersion')) && $request->get('request') == 'etapes')
       {
            $etapes = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Common\ProjectEtape')->findBy(['idProjetVersion'=>$idProjectVersion]);
            if( !$etapes ) return new JsonResponse(array('result'=>false));

            // json return
            $json = ['result'=>true, 'data'=>[]];
            foreach($etapes as $etape)
                $json['data'][$etape->getId()] = $etape->getObject();
            return new JsonResponse($json);
       }

       // getting agenda by idEtape
       if( ($idProjetEtape = $request->get('idEtape')) && $request->get('request') == 'agenda')
       {
            $operations = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findBy(['idEtape'=>$idProjetEtape]);
            if( !$operations ) return new JsonResponse(array('result'=>false));
            // json return
            $json = ['result'=>true, 'data'=>[]];
            foreach($operations as $operation)
                $json['data'][$operation->getId()] = $operation->getObject();
            return new JsonResponse($json);
       }
    }

    /**
     * Lists all projectEtapesOperationsIssue entities.
     *
     * @Route("/", name="operationsissues_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projectEtapesOperationsIssues = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsIssues')->findAll();
        if( $projectEtapesOperationsIssues )
            foreach($projectEtapesOperationsIssues as &$issues)
                $issues->setProjet($em->getRepository('ProjectBundle:Common\Project')->findOneBy(['id' => $issues->getIdProjectVersion()]));

        return $this->render('ProjectBundle:common/projectetapesoperationsissues:index.html.twig', array(
            'OperationsIssues' => $projectEtapesOperationsIssues,
        ));
    }

    /**
     * Creates a new projectEtapesOperationsIssue entity.
     *
     * @Route("/new", name="operationsissues_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $projectEtapesOperationsIssue = new ProjectEtapesOperationsIssues();
        $em = $this->getDoctrine()->getManager();
        $dataForm = $this->dataForm();

        /* pour projet */
        if( ($idProject = $request->get('idProject')) || ($idProject = $request->get('idProjet')) ) {
            $users = array_map(function($object) {
                    if( !is_object($object) ) return;
                    return $object->getIdUser();
                }, 
                $em->getRepository('ProjectBundle:Common\ProjectVersionUser')->findBy(['idProjetVersion' => $idProject])
            );

            /* pour setter idProjectVersion */
            $projectEtapesOperationsIssue->setIdProjectVersion($idProject);
            /* pour etape zéro */
            $projectEtapesOperationsIssue->setIdEtape(0);

            /* pour l'étape du projet e question */
            $etapes = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findBy(['idProjetVersion' => $idProject]);
            $dataForm['etapes'] = $etapes;

            /* pour l'opération du projet e question */
            $operations = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findBy(['idProjectVersion' => $idProject]);
            $dataForm['operations'] = $operations;
        }
        /* end of */

         if( ($idEtape = $request->get('idEtape')) ) {
            /* pour etape zéro */
            $projectEtapesOperationsIssue->setIdEtape($idEtape);

            /* pour l'étape du projet e question */
            $idProject = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findOneBy(['id' => $idEtape]);
            if( $idProject ) 
            {
                $idProject = $idProject->getIdProjetVersion();
                /* pour setter idProjectVersion */
                $projectEtapesOperationsIssue->setIdProjectVersion($idProject);

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

        $form = $this->createForm('ProjectBundle\Form\Common\ProjectEtapesOperationsIssuesType', $projectEtapesOperationsIssue, ['dataForm' => $dataForm]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            /* pour agenda de l'issue */
            $projectEtapesOperationsIssue->setIdAgenda(0);

            // for agenda 
            $em->persist($projectEtapesOperationsIssue);
            $em->flush();

            /* après qu'on a projectEtapesOperationsIssue->getId() */
            $this->setAgenda($projectEtapesOperationsIssue);
            return $this->redirectToRoute('operationsissues_index');
        }

        return $this->render('ProjectBundle:common/projectetapesoperationsissues:new.html.twig', array(
            'projectEtapesOperationsIssue' => $projectEtapesOperationsIssue,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projectEtapesOperationsIssue entity.
     *
     * @Route("/{id}", name="operationsissues_show")
     * @Method("GET")
     */
    public function showAction(ProjectEtapesOperationsIssues $projectEtapesOperationsIssue)
    {
        $deleteForm = $this->createDeleteForm($projectEtapesOperationsIssue);

        return $this->render('ProjectBundle:common/projectetapesoperationsissues:show.html.twig', array(
            'projectEtapesOperationsIssue' => $projectEtapesOperationsIssue,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projectEtapesOperationsIssue entity.
     *
     * @Route("/{id}/edit", name="operationsissues_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProjectEtapesOperationsIssues $projectEtapesOperationsIssue)
    {
        $deleteForm = $this->createDeleteForm($projectEtapesOperationsIssue);
        $editForm = $this->createForm('ProjectBundle\Form\Common\ProjectEtapesOperationsIssuesType', $projectEtapesOperationsIssue, ['dataForm'=>$this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // em
            $em = $this->getDoctrine()->getManager();

            // for agenda 
            $agenda = $this->setAgenda($projectEtapesOperationsIssue);

            // for issue
            $em->persist($projectEtapesOperationsIssue);
            $em->flush();

            return $this->redirectToRoute('operationsissues_edit', array('id' => $projectEtapesOperationsIssue->getId()));
        }

        return $this->render('ProjectBundle:common/projectetapesoperationsissues:edit.html.twig', array(
            'projectEtapesOperationsIssue' => $projectEtapesOperationsIssue,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projectEtapesOperationsIssue entity.
     *
     * @Route("/{id}", name="operationsissues_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProjectEtapesOperationsIssues $projectEtapesOperationsIssue)
    {
        $form = $this->createDeleteForm($projectEtapesOperationsIssue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectEtapesOperationsIssue);
            $em->flush();
        }

        return $this->redirectToRoute('operationsissues_index');
    }

    /**
     * Creates a form to delete a projectEtapesOperationsIssue entity.
     *
     * @param ProjectEtapesOperationsIssues $projectEtapesOperationsIssue The projectEtapesOperationsIssue entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectEtapesOperationsIssues $projectEtapesOperationsIssue)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('operationsissues_delete', array('id' => $projectEtapesOperationsIssue->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // data for form
    private function dataForm() {
        $em = $this->getDoctrine()->getManager();
        return [
            'operations'        => $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findAll(), 
            'etapes'            => $em->getRepository('ProjectBundle:Common\ProjectEtape')->findAll(), 
            'projects'          => $em->getRepository('ProjectBundle:Common\Project')->findAll(), 
            'agendas'           => $em->getRepository('ProjectBundle:Agenda\AgendaWorker')->findAll(),
            // other
            'priorites'         => $em->getRepository('ProjectBundle:Back\Priorites')->findAll(),
            'statuts'           => $em->getRepository('ProjectBundle:Back\Statut')->findAll(),
            'users'             => $em->getRepository('UsersBundle:Users')->findAll(),
        ];
    }

    // for agenda
    private function setAgenda ($projectEtapesOperationsIssue) 
    {
        $agenda = null;
        $em = $this->getDoctrine()->getManager();
        if( ($id = $projectEtapesOperationsIssue->getId()) != null )
            $agenda  = $em->getRepository('ProjectBundle:Agenda\AgendaWorker')->findOneBy(['idProjetIssue' => $id]);

        $value = [
            'idProjetIssue' => $projectEtapesOperationsIssue->getId(),
            'dateDebReelle' => $projectEtapesOperationsIssue->getDatedebut(),
            'dateFinReelle' => $projectEtapesOperationsIssue->getDatefin()
        ];


        $agenda = \ProjectBundle\Entity\Agenda\AgendaWorker::MinAgenda($value, $agenda);
        $em->persist($agenda);
        $em->flush();
    }
}