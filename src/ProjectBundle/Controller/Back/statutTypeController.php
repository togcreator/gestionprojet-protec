<?php

namespace ProjectBundle\Controller\Back;

use ProjectBundle\Entity\Back\StatutType;
use AppBundle\Entity\Common\Langue;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * statutType controller.
 *
 * @Route("back/statutType")
 */
class statutTypeController extends Controller
{
    /**
     * Lists all statutType entities.
     *
     * @Route("/", name="back_statutType_index",)
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $statutTypes = $em->getRepository('ProjectBundle:Back\StatutType')->findAll();

        return $this->render('ProjectBundle:back\statutType:index.html.twig', array(
            'statutTypes' => $statutTypes,
        ));
    }

    /**
     * Creates a new statutType entity.
     *
     * @Route("/new", name="back_statutType_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $statutType = new statutType();
        $form = $this->createForm('\ProjectBundle\Form\Back\statutTypeType', $statutType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($statutType);
            $em->flush();

            return $this->redirectToRoute('back_statutType_index');
        }

        return $this->render('ProjectBundle:back\statutType:new.html.twig', array(
            'statutType' => $statutType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a statutType entity.
     *
     * @Route("/{id}", name="back_statutType_show")
     * @Method("GET")
     */
    public function showAction(statutType $statutType)
    {
        $deleteForm = $this->createDeleteForm($statutType);

        return $this->render('ProjectBundle:back\statutType:show.html.twig', array(
            'statutType' => $statutType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing statutType entity.
     *
     * @Route("/{id}/edit", name="back_statutType_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, StatutType $statutType)
    {
        $deleteForm = $this->createDeleteForm($statutType);
        $editForm = $this->createForm('ProjectBundle\Form\Back\statutTypeType', $statutType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('back_statutType_edit', array('id' => $statutType->getId()));
        }

        return $this->render('ProjectBundle:back\statutType:edit.html.twig', array(
            'statutType' => $statutType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a statutType entity.
     *
     * @Route("/{id}", name="back_statutType_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, statutType $statutType)
    {
        $form = $this->createDeleteForm($statutType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($statutType);
            $em->flush();
        }

        return $this->redirectToRoute('back_statutType_index');
    }

    /**
     * Creates a form to delete a statutType entity.
     *
     * @param statutType $statutType The statutType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(statutType $statutType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('back_statutType_delete', array('id' => $statutType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
