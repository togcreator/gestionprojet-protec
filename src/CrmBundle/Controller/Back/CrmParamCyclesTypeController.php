<?php

namespace CrmBundle\Controller\Back;

use CrmBundle\Entity\Back\CrmParamCyclesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Crmparamactivity controller.
 *
 * @Route("crm/paramcyclestype")
 */
class CrmParamCyclesTypeController extends Controller
{
    /**
     * Lists all crmParamCyclesType entities.
     *
     * @Route("/", name="crmparamcyclestype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $crmParamCyclesType = $em->getRepository('CrmBundle:Back\CrmParamCyclesType')->findAll();

        return $this->render('CrmBundle:back/crmparamcyclestype:index.html.twig', array(
            'crmParamCyclesType' => $crmParamCyclesType,
        ));
    }

    /**
     * Creates a new crmParamCyclesType entity.
     *
     * @Route("/new", name="crmparamcyclestype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmParamCyclesType = new CrmParamCyclesType();
        $form = $this->createForm('CrmBundle\Form\Back\CrmParamCyclesTypeType', $crmParamCyclesType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            
            $em->persist($crmParamCyclesType);
            $em->flush();

            return $this->redirectToRoute('crmparamcyclestype_index');
        }

        return $this->render('CrmBundle:back/crmparamcyclestype:new.html.twig', array(
            'crmParamCyclesType' => $crmParamCyclesType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmParamCyclesType entity.
     *
     * @Route("/{id}", name="crmparamcyclestype_show")
     * @Method("GET")
     */
    public function showAction(CrmParamCyclesTypeType $crmParamCyclesType)
    {
        $deleteForm = $this->createDeleteForm($crmParamCyclesType);

        return $this->render('CrmBundle:back/crmparamcyclestype:show.html.twig', array(
            'crmParamCyclesType' => $crmParamCyclesType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmParamCyclesType entity.
     *
     * @Route("/{id}/edit", name="crmparamcyclestype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmParamCyclesType $crmParamCyclesType)
    {
        $deleteForm = $this->createDeleteForm($crmParamCyclesType);
        $editForm = $this->createForm('CrmBundle\Form\Back\CrmParamCyclesTypeType', $crmParamCyclesType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('crmparamcyclestype_edit', array('id' => $crmParamCyclesType->getId()));
        }

        return $this->render('CrmBundle:back/crmparamcyclestype:edit.html.twig', array(
            'crmParamCyclesType' => $crmParamCyclesType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmParamCyclesType entity.
     *
     * @Route("/{id}", name="crmparamcyclestype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmParamCyclesType $crmParamCyclesType)
    {

        $form = $this->createDeleteForm($crmParamCyclesType);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmParamCyclesType);
            $em->flush();
        }

        return $this->redirectToRoute('crmparamcyclestype_index');
    }

    /**
     * Creates a form to delete a crmParamCyclesType entity.
     *
     * @param CrmParamCyclesType $crmParamCyclesType The crmParamCyclesType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmParamCyclesType $crmParamCyclesType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmparamcyclestype_delete', array('id' => $crmParamCyclesType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
