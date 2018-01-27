<?php

namespace AppBundle\Controller;

use AppBundle\Entity\typeCompaign;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Typecompaign controller.
 *
 * @Route("typecompaign")
 */
class typeCompaignController extends Controller
{
    /**
     * Lists all typeCompaign entities.
     *
     * @Route("/", name="typecompaign_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typeCompaigns = $em->getRepository('AppBundle:typeCompaign')->findAll();

        return $this->render('typecompaign/index.html.twig', array(
            'typeCompaigns' => $typeCompaigns,
        ));
    }

    /**
     * Creates a new typeCompaign entity.
     *
     * @Route("/new", name="typecompaign_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typeCompaign = new Typecompaign();
        $form = $this->createForm('AppBundle\Form\typeCompaignType', $typeCompaign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeCompaign);
            $em->flush();

            return $this->redirectToRoute('typecompaign_show', array('id' => $typeCompaign->getId()));
        }

        return $this->render('typecompaign/new.html.twig', array(
            'typeCompaign' => $typeCompaign,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typeCompaign entity.
     *
     * @Route("/{id}", name="typecompaign_show")
     * @Method("GET")
     */
    public function showAction(typeCompaign $typeCompaign)
    {
        $deleteForm = $this->createDeleteForm($typeCompaign);

        return $this->render('typecompaign/show.html.twig', array(
            'typeCompaign' => $typeCompaign,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typeCompaign entity.
     *
     * @Route("/{id}/edit", name="typecompaign_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, typeCompaign $typeCompaign)
    {
        $deleteForm = $this->createDeleteForm($typeCompaign);
        $editForm = $this->createForm('AppBundle\Form\typeCompaignType', $typeCompaign);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typecompaign_edit', array('id' => $typeCompaign->getId()));
        }

        return $this->render('typecompaign/edit.html.twig', array(
            'typeCompaign' => $typeCompaign,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typeCompaign entity.
     *
     * @Route("/{id}", name="typecompaign_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, typeCompaign $typeCompaign)
    {
        $form = $this->createDeleteForm($typeCompaign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeCompaign);
            $em->flush();
        }

        return $this->redirectToRoute('typecompaign_index');
    }

    /**
     * Creates a form to delete a typeCompaign entity.
     *
     * @param typeCompaign $typeCompaign The typeCompaign entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(typeCompaign $typeCompaign)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typecompaign_delete', array('id' => $typeCompaign->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
