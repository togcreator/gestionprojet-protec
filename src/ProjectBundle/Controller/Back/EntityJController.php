<?php

namespace ProjectBundle\Controller\Back;

use ProjectBundle\Entity\Back\EntityJ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Entityj controller.
 *
 * @Route("back/entity")
 */
class EntityJController extends Controller
{
    /**
     * Lists all entityJ entities.
     *
     * @Route("/", name="back_entity_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entityJs = $em->getRepository('ProjectBundle:Back\EntityJ')->findAll();

        return $this->render('ProjectBundle:back\entityj:index.html.twig', array(
            'entityJs' => $entityJs,
        ));
    }

    /**
     * Creates a new entityJ entity.
     *
     * @Route("/new", name="back_entity_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $entityJ = new Entityj();
        $form = $this->createForm('ProjectBundle\Form\Back\EntityJType', $entityJ);
        $form->handleRequest($request);

        // date
        $entityJ->setDateCreated(new \DateTime('now'));

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entityJ);
            $em->flush();

            return $this->redirectToRoute('back_entity_index');
        }

        return $this->render('ProjectBundle:back\entityj:new.html.twig', array(
            'entityJ' => $entityJ,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a entityJ entity.
     *
     * @Route("/{id}", name="back_entity_show")
     * @Method("GET")
     */
    public function showAction(EntityJ $entityJ)
    {
        $deleteForm = $this->createDeleteForm($entityJ);

        return $this->render('ProjectBundle:back\entityj:show.html.twig', array(
            'entityJ' => $entityJ,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing entityJ entity.
     *
     * @Route("/{id}/edit", name="back_entity_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EntityJ $entityJ)
    {
        $deleteForm = $this->createDeleteForm($entityJ);
        $editForm = $this->createForm('ProjectBundle\Form\Back\EntityJType', $entityJ);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('back_entity_edit', array('id' => $entityJ->getId()));
        }

        return $this->render('ProjectBundle:back\entityj:edit.html.twig', array(
            'entityJ' => $entityJ,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a entityJ entity.
     *
     * @Route("/{id}", name="back_entity_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EntityJ $entityJ)
    {
        $form = $this->createDeleteForm($entityJ);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entityJ);
            $em->flush();
        }

        return $this->redirectToRoute('back_entity_index');
    }

    /**
     * Creates a form to delete a entityJ entity.
     *
     * @param EntityJ $entityJ The entityJ entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EntityJ $entityJ)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('back_entity_delete', array('id' => $entityJ->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
