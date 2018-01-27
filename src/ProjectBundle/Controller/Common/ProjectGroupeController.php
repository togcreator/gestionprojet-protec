<?php

namespace ProjectBundle\Controller\Common;

use ProjectBundle\Entity\Common\ProjectGroupe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Projectgroupe controller.
 *
 * @Route("project/groupe")
 */
class ProjectGroupeController extends Controller
{
    /**
     * Lists all projectGroupe entities.
     *
     * @Route("/", name="projectgroupe_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projectGroupes = $em->getRepository('ProjectBundle:Common\ProjectGroupe')->findAll();

        return $this->render('ProjectBundle:common\projectgroupe:index.html.twig', array(
            'projectGroupes' => $projectGroupes,
        ));
    }

    /**
     * Creates a new projectGroupe entity.
     *
     * @Route("/{idProjet}/new", name="projectgroupe_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {        
        $projectGroupe = new Projectgroupe();
        $form = $this->createForm('ProjectBundle\Form\Common\ProjectGroupeType', $projectGroupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $idProjet = $request->get('idProjet');
            // date creation
            $projectGroupe->setDateCreation( new \DateTime('now ' . date('e')) );
            // date debut
            $projectGroupe->setDatedebut( new \DateTime($projectGroupe->getDatedebut()) );
            // date fin
            $projectGroupe->setDatefin( new \DateTime($projectGroupe->getDatefin()) );
            // id projet
            $projectGroupe->setIdProjet( $idProjet );

            $em = $this->getDoctrine()->getManager();
            $em->persist($projectGroupe);
            $em->flush();

            return $this->redirectToRoute('agenda_new', ['idProjet' => $idProjet]);
        }

        return $this->render('ProjectBundle:common\projectgroupe:new.html.twig', array(
            'projectGroupe' => $projectGroupe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projectGroupe entity.
     *
     * @Route("/{id}", name="projectgroupe_show")
     * @Method("GET")
     */
    public function showAction(ProjectGroupe $projectGroupe)
    {
        $deleteForm = $this->createDeleteForm($projectGroupe);

        return $this->render('ProjectBundle:common\projectgroupe:show.html.twig', array(
            'projectGroupe' => $projectGroupe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projectGroupe entity.
     *
     * @Route("/{id}/edit", name="projectgroupe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProjectGroupe $projectGroupe)
    {
        $deleteForm = $this->createDeleteForm($projectGroupe);
        $editForm = $this->createForm('ProjectBundle\Form\Common\ProjectGroupeType', $projectGroupe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
             // date debut
            $projectGroupe->setDatedebut( new \DateTime($projectGroupe->getDatedebut()) );
            // date fin
            $projectGroupe->setDatefin( new \DateTime($projectGroupe->getDatefin()) );

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('projectgroupe_edit', array('id' => $projectGroupe->getId()));
        }

        return $this->render('ProjectBundle:common\projectgroupe:edit.html.twig', array(
            'projectGroupe' => $projectGroupe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projectGroupe entity.
     *
     * @Route("/{id}", name="projectgroupe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProjectGroupe $projectGroupe)
    {
        $form = $this->createDeleteForm($projectGroupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectGroupe);
            $em->flush();
        }

        return $this->redirectToRoute('projectgroupe_index');
    }

    /**
     * Creates a form to delete a projectGroupe entity.
     *
     * @param ProjectGroupe $projectGroupe The projectGroupe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectGroupe $projectGroupe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projectgroupe_delete', array('id' => $projectGroupe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
