<?php

namespace ProjectBundle\Controller\Common;

use ProjectBundle\Entity\Common\ProjectEtapesOperationsIssuesOrganisation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Projectetapesoperationsissuesorganisation controller.
 *
 * @Route("projet/issuesorganisation")
 */
class ProjectEtapesOperationsIssuesOrganisationController extends Controller
{
    // dataForm
    public function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'issues' => $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsIssues')->findAll(),
        ];
    }

    /**
     * Lists all projectEtapesOperationsIssuesOrganisation entities.
     *
     * @Route("/", name="issuesorganisation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $IssuesOrganisations = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsIssuesOrganisation')->findAll();

        return $this->render('ProjectBundle:common/projectetapesoperationsissuesorganisation:index.html.twig', array(
            'IssuesOrganisations' => $IssuesOrganisations,
        ));
    }

    /**
     * Creates a new projectEtapesOperationsIssuesOrganisation entity.
     *
     * @Route("/new", name="issuesorganisation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $IssuesOrganisations = new ProjectEtapesOperationsIssuesOrganisation();
        $form = $this->createForm('ProjectBundle\Form\Common\ProjectEtapesOperationsIssuesOrganisationType', $IssuesOrganisations, ['dataForm'=>$this->dataForm()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // type inconnu ou variable inconnu
            $IssuesOrganisations->setIdTyperelation(1);
            $IssuesOrganisations->setIdParent(1);

            $em = $this->getDoctrine()->getManager();
            $em->persist($IssuesOrganisations);
            $em->flush();

            return $this->redirectToRoute('issuesorganisation_index');
        }

        return $this->render('ProjectBundle:common/projectetapesoperationsissuesorganisation:new.html.twig', array(
            'IssuesOrganisations' => $IssuesOrganisations,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projectEtapesOperationsIssuesOrganisation entity.
     *
     * @Route("/{id}", name="issuesorganisation_show")
     * @Method("GET")
     */
    public function showAction(ProjectEtapesOperationsIssuesOrganisation $projectEtapesOperationsIssuesOrganisation)
    {
        $deleteForm = $this->createDeleteForm($projectEtapesOperationsIssuesOrganisation);

        return $this->render('ProjectBundle:common/projectetapesoperationsissuesorganisation:show.html.twig', array(
            'projectEtapesOperationsIssuesOrganisation' => $projectEtapesOperationsIssuesOrganisation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projectEtapesOperationsIssuesOrganisation entity.
     *
     * @Route("/{id}/edit", name="issuesorganisation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProjectEtapesOperationsIssuesOrganisation $projectEtapesOperationsIssuesOrganisation)
    {
        $deleteForm = $this->createDeleteForm($projectEtapesOperationsIssuesOrganisation);
        $editForm = $this->createForm('ProjectBundle\Form\Common\ProjectEtapesOperationsIssuesOrganisationType', $projectEtapesOperationsIssuesOrganisation, ['dataForm'=>$this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('issuesorganisation_edit', array('id' => $projectEtapesOperationsIssuesOrganisation->getId()));
        }

        return $this->render('ProjectBundle:common/projectetapesoperationsissuesorganisation:edit.html.twig', array(
            'projectEtapesOperationsIssuesOrganisation' => $projectEtapesOperationsIssuesOrganisation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projectEtapesOperationsIssuesOrganisation entity.
     *
     * @Route("/{id}", name="issuesorganisation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProjectEtapesOperationsIssuesOrganisation $projectEtapesOperationsIssuesOrganisation)
    {
        $form = $this->createDeleteForm($projectEtapesOperationsIssuesOrganisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectEtapesOperationsIssuesOrganisation);
            $em->flush();
        }

        return $this->redirectToRoute('issuesorganisation_index');
    }

    /**
     * Creates a form to delete a projectEtapesOperationsIssuesOrganisation entity.
     *
     * @param ProjectEtapesOperationsIssuesOrganisation $projectEtapesOperationsIssuesOrganisation The projectEtapesOperationsIssuesOrganisation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectEtapesOperationsIssuesOrganisation $projectEtapesOperationsIssuesOrganisation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('issuesorganisation_delete', array('id' => $projectEtapesOperationsIssuesOrganisation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
