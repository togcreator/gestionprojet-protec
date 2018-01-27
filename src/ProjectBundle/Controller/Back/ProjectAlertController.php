<?php

namespace ProjectBundle\Controller\Back;

use ProjectBundle\Entity\Back\ProjectAlert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Classes\Utils;

/**
 * Projectalert controller.
 *
 * @Route("back/projectalert")
 */
class ProjectAlertController extends Controller
{
    /**
     * Lists all projectAlert entities.
     *
     * @Route("/", name="back_projectalert_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projectAlerts = $em->getRepository('ProjectBundle:Back\ProjectAlert')->findAll();

        return $this->render('ProjectBundle:back\projectalert:index.html.twig', array(
            'projectAlerts' => $projectAlerts,
        ));
    }

    /**
     * Creates a new projectAlert entity.
     *
     * @Route("/new", name="back_projectalert_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $projectAlert = new Projectalert();
        $form = $this->createForm('ProjectBundle\Form\Back\ProjectAlertType', $projectAlert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dir = $this->getParameter('upload_dir');
            // img
            $projectAlert->setLogo(Utils::Upload_file($projectAlert->getLogo(), $dir));

            $em = $this->getDoctrine()->getManager();
            $em->persist($projectAlert);
            $em->flush();

            return $this->redirectToRoute('back_projectalert_index');
        }

        return $this->render('ProjectBundle:back\projectalert:new.html.twig', array(
            'projectAlert' => $projectAlert,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projectAlert entity.
     *
     * @Route("/{id}", name="back_projectalert_show")
     * @Method("GET")
     */
    public function showAction(ProjectAlert $projectAlert)
    {
        $deleteForm = $this->createDeleteForm($projectAlert);

        return $this->render('ProjectBundle:back\projectalert:show.html.twig', array(
            'projectAlert' => $projectAlert,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projectAlert entity.
     *
     * @Route("/{id}/edit", name="back_projectalert_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProjectAlert $projectAlert)
    {
        $deleteForm = $this->createDeleteForm($projectAlert);
        $editForm = $this->createForm('ProjectBundle\Form\Back\ProjectAlertType', $projectAlert);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // img
            $dir = $this->getParameter('upload_dir');
            $projectAlert->setLogo(Utils::Upload_file($projectAlert->getLogo(), $dir));

            $em = $this->getDoctrine()->getManager();
            $em->persist($projectAlert);
            $em->flush();

            return $this->redirectToRoute('back_projectalert_edit', array('id' => $projectAlert->getId()));
        }

        return $this->render('ProjectBundle:back\projectalert:edit.html.twig', array(
            'projectAlert' => $projectAlert,
            'filetype' => 'image',
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projectAlert entity.
     *
     * @Route("/{id}", name="back_projectalert_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProjectAlert $projectAlert)
    {
        $form = $this->createDeleteForm($projectAlert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectAlert);
            $em->flush();
        }

        return $this->redirectToRoute('back_projectalert_index');
    }

    /**
     * Creates a form to delete a projectAlert entity.
     *
     * @param ProjectAlert $projectAlert The projectAlert entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectAlert $projectAlert)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('back_projectalert_delete', array('id' => $projectAlert->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
