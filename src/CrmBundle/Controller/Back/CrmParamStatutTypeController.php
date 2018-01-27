<?php

namespace CrmBundle\Controller\Back;

use CrmBundle\Entity\Back\CrmParamStatutType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Crmparamstatuttype controller.
 *
 * @Route("crm/paramstatuttype")
 */
class CrmParamStatutTypeController extends Controller
{
    /**
     * Lists all crmParamStatutType entities.
     *
     * @Route("/", name="crmparamstatuttype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $crmParamStatutTypes = $em->getRepository('CrmBundle:Back\CrmParamStatutType')->findAll();

        return $this->render('CrmBundle:back/crmparamstatuttype:index.html.twig', array(
            'crmParamStatutTypes' => $crmParamStatutTypes,
        ));
    }

    /**
     * Creates a new crmParamStatutType entity.
     *
     * @Route("/new", name="crmparamstatuttype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmParamStatutType = new Crmparamstatuttype();
        $form = $this->createForm('CrmBundle\Form\Back\CrmParamStatutTypeType', $crmParamStatutType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmParamStatutType);
            $em->flush();

            return $this->redirectToRoute('crmparamstatuttype_index');
        }

        return $this->render('CrmBundle:back/crmparamstatuttype:new.html.twig', array(
            'crmParamStatutType' => $crmParamStatutType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmParamStatutType entity.
     *
     * @Route("/{id}", name="crmparamstatuttype_show")
     * @Method("GET")
     */
    public function showAction(CrmParamStatutType $crmParamStatutType)
    {
        $deleteForm = $this->createDeleteForm($crmParamStatutType);

        return $this->render('CrmBundle:back/crmparamstatuttype:show.html.twig', array(
            'crmParamStatutType' => $crmParamStatutType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmParamStatutType entity.
     *
     * @Route("/{id}/edit", name="crmparamstatuttype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmParamStatutType $crmParamStatutType)
    {
        $deleteForm = $this->createDeleteForm($crmParamStatutType);
        $editForm = $this->createForm('CrmBundle\Form\Back\CrmParamStatutTypeType', $crmParamStatutType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('crmparamstatuttype_edit', array('id' => $crmParamStatutType->getId()));
        }

        return $this->render('CrmBundle:back/crmparamstatuttype:edit.html.twig', array(
            'crmParamStatutType' => $crmParamStatutType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmParamStatutType entity.
     *
     * @Route("/{id}", name="crmparamstatuttype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmParamStatutType $crmParamStatutType)
    {
        $form = $this->createDeleteForm($crmParamStatutType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmParamStatutType);
            $em->flush();
        }

        return $this->redirectToRoute('crmparamstatuttype_index');
    }

    /**
     * Creates a form to delete a crmParamStatutType entity.
     *
     * @param CrmParamStatutType $crmParamStatutType The crmParamStatutType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmParamStatutType $crmParamStatutType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmparamstatuttype_delete', array('id' => $crmParamStatutType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
