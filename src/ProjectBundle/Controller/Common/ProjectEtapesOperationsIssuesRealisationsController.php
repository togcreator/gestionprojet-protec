<?php

namespace ProjectBundle\Controller\Common;

use ProjectBundle\Entity\Common\ProjectEtapesOperationsIssuesRealisations;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Projectetapesoperationsissuesrealisation controller.
 *
 * @Route("projet/issuesrealisations")
 */
class ProjectEtapesOperationsIssuesRealisationsController extends Controller
{
    // dataForm
    public function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'projects' => $em->getRepository('ProjectBundle:Common\Project')->findAll(),
            'etapes' => $em->getRepository('ProjectBundle:Common\ProjectEtape')->findAll(),
            'resultats' => $em->getRepository('ProjectBundle:Back\Resultat')->findAll(),
            'users' => $em->getRepository('UsersBundle:Users')->findAll(),
            'statuts' => $em->getRepository('ProjectBundle:Back\Statut')->findAll()
        ];
    }

    /**
     * Lists ajax.
     *
     * @Route("/ajax", name="Issuesrealisations_ajax_get")
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

       // getting operation by idEtape
       if( ($idProjetEtape = $request->get('idEtape')) && $request->get('request') == 'issue')
       {
            $issues = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Common\ProjectEtapesOperationsIssues')->findBy(['idEtape'=>$idProjetEtape]);
            if( !$issues ) return new JsonResponse(array('result'=>false));
            // json return
            $json = ['result'=>true, 'data'=>[]];
            foreach($issues as $issue)
                $json['data'][$issue->getId()] = $issue->getLibelle();
            return new JsonResponse($json);
       }
    }

    /**
     * Lists all projectEtapesOperationsIssuesRealisation entities.
     *
     * @Route("/", name="Issuesrealisations_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $IssuesRealisations = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsIssuesRealisations')->findAll();
        if( $IssuesRealisations )
            foreach($IssuesRealisations as &$realisation)
                $realisation->setProjet($em->getRepository('ProjectBundle:Common\Project')->findOneBy(['id' => $realisation->getIdProjetVersion()]));

        return $this->render('ProjectBundle:common\projectetapesoperationsissuesrealisations:index.html.twig', array(
            'IssuesRealisations' => $IssuesRealisations,
        ));
    }

    /**
     * Creates a new projectEtapesOperationsIssuesRealisation entity.
     *
     * @Route("/new", name="Issuesrealisations_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $IssuesRealisation = new ProjectEtapesOperationsIssuesRealisations();
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
            $IssuesRealisation->setIdProjetVersion($idProject);
            /* pour etape zéro */
            $IssuesRealisation->setIdEtape(0);

            /* pour l'étape du projet e question */
            $etapes = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findBy(['idProjetVersion' => $idProject]);
            $dataForm['etapes'] = $etapes;

            /* pour l'opération du projet e question */
            $issues = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsIssues')->findBy(['idProjectVersion' => $idProject]);
            $dataForm['issues'] = $issues;
        }
        /* end of */


        $form = $this->createForm('ProjectBundle\Form\Common\ProjectEtapesOperationsIssuesRealisationsType', $IssuesRealisation, ['dataForm' => $dataForm]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $em->persist($IssuesRealisation);
            $em->flush();

            return $this->redirectToRoute('Issuesrealisations_index');
        }

        return $this->render('ProjectBundle:common\projectetapesoperationsissuesrealisations:new.html.twig', array(
            'projectEtapesOperationsIssuesRealisation' => $IssuesRealisation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projectEtapesOperationsIssuesRealisation entity.
     *
     * @Route("/{id}", name="Issuesrealisations_show")
     * @Method("GET")
     */
    public function showAction(ProjectEtapesOperationsIssuesRealisations $IssuesRealisation)
    {
        $deleteForm = $this->createDeleteForm($IssuesRealisation);

        return $this->render('ProjectBundle:common\projectetapesoperationsissuesrealisations:show.html.twig', array(
            'projectEtapesOperationsIssuesRealisation' => $IssuesRealisation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projectEtapesOperationsIssuesRealisation entity.
     *
     * @Route("/{id}/edit", name="Issuesrealisations_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProjectEtapesOperationsIssuesRealisations $IssuesRealisation)
    {
        $deleteForm = $this->createDeleteForm($IssuesRealisation);
        $dataForm = $this->dataForm();
        $em = $this->getDoctrine()->getManager();
        $dataForm['issues'] = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsIssues')->findBy(['id' => $IssuesRealisation->getIdIssue()]);
        $editForm = $this->createForm('ProjectBundle\Form\Common\ProjectEtapesOperationsIssuesRealisationsType', $IssuesRealisation, ['dataForm' => $dataForm]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $em->persist($IssuesRealisation);
            $em->flush();

            return $this->redirectToRoute('Issuesrealisations_edit', array('id' => $IssuesRealisation->getId()));
        }

        return $this->render('ProjectBundle:common\projectetapesoperationsissuesrealisations:edit.html.twig', array(
            'projectEtapesOperationsIssuesRealisation' => $IssuesRealisation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projectEtapesOperationsIssuesRealisation entity.
     *
     * @Route("/{id}", name="Issuesrealisations_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProjectEtapesOperationsIssuesRealisations $IssuesRealisation)
    {
        $form = $this->createDeleteForm($IssuesRealisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($IssuesRealisation);
            $em->flush();
        }

        return $this->redirectToRoute('Issuesrealisations_index');
    }

    /**
     * Creates a form to delete a projectEtapesOperationsIssuesRealisation entity.
     *
     * @param ProjectEtapesOperationsIssuesRealisations $IssuesRealisation The projectEtapesOperationsIssuesRealisation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectEtapesOperationsIssuesRealisations $IssuesRealisation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Issuesrealisations_delete', array('id' => $IssuesRealisation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
