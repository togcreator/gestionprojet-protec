<?php

namespace CrmBundle\Controller\Back;

use CrmBundle\Entity\Back\CrmParamCyclesDetailsActivity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Crmparamactivity controller.
 *
 * @Route("crm/paramcyclesactivity")
 */
class CrmParamCyclesDetailsActivityController extends Controller
{
    // dataForm
    public function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'cycles' => $em->getRepository('CrmBundle:Back\CrmParamCycles')->findAll(),
            'cyclesdetails' => $em->getRepository('CrmBundle:Back\CrmParamCyclesDetails')->findAll(),
            'activities' => $em->getRepository('CrmBundle:Back\CrmParamActivities')->findAll(),
        ];
    }

    /**
     * Lists all crmParamCyclesDetailsActivity entities.
     *
     * @Route("/", name="crmparamcyclesdetailsactivity_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $crmParamCyclesDetailsActivity = $em->getRepository('CrmBundle:Back\CrmParamCyclesDetailsActivity')->findAll();

        return $this->render('CrmBundle:back/crmparamcyclesdetailsactivity:index.html.twig', array(
            'crmParamCyclesDetailsActivity' => $crmParamCyclesDetailsActivity,
        ));
    }

    /**
     * Creates a new crmParamCyclesDetailsActivity entity.
     *
     * @Route("/new", name="crmparamcyclesdetailsactivity_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmParamCyclesDetailsActivity = new CrmParamCyclesDetailsActivity();
        $form = $this->createForm('CrmBundle\Form\Back\CrmParamCyclesDetailsActivityType', $crmParamCyclesDetailsActivity, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($crmParamCyclesDetailsActivity);
            $em->flush();

            return $this->redirectToRoute('crmparamcyclesdetailsactivity_index');
        }

        return $this->render('CrmBundle:back/crmparamcyclesdetailsactivity:new.html.twig', array(
            'crmParamCyclesDetailsActivity' => $crmParamCyclesDetailsActivity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmParamCyclesDetailsActivity entity.
     *
     * @Route("/{id}", name="crmparamcyclesdetailsactivity_show")
     * @Method("GET")
     */
    public function showAction(CrmParamCyclesDetailsActivity $crmParamCyclesDetailsActivity)
    {
        $deleteForm = $this->createDeleteForm($crmParamCyclesDetailsActivity);

        return $this->render('CrmBundle:back/crmparamcyclesdetailsactivity:show.html.twig', array(
            'crmParamCyclesDetailsActivity' => $crmParamCyclesDetailsActivity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmParamCyclesDetailsActivity entity.
     *
     * @Route("/{id}/edit", name="crmparamcyclesdetailsactivity_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmParamCyclesDetailsActivity $crmParamCyclesDetailsActivity)
    {
        $deleteForm = $this->createDeleteForm($crmParamCyclesDetailsActivity);
        $editForm = $this->createForm('CrmBundle\Form\Back\CrmParamCyclesDetailsActivityType', $crmParamCyclesDetailsActivity, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('crmparamcyclesdetailsactivity_edit', array('id' => $crmParamCyclesDetailsActivity->getId()));
        }

        return $this->render('CrmBundle:back/crmparamcyclesdetailsactivity:edit.html.twig', array(
            'crmParamCyclesDetailsActivity' => $crmParamCyclesDetailsActivity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmParamCyclesDetailsActivity entity.
     *
     * @Route("/{id}", name="crmparamcyclesdetailsactivity_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmParamCyclesDetailsActivity $crmParamCyclesDetailsActivity)
    {
        $form = $this->createDeleteForm($crmParamCyclesDetailsActivity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmParamCyclesDetailsActivity);
            $em->flush();
        }

        return $this->redirectToRoute('crmparamcyclesdetailsactivity_index');
    }

    /**
     * Creates a form to delete a crmParamCyclesDetailsActivity entity.
     *
     * @param CrmParamCyclesDetailsActivity $crmParamCyclesDetailsActivity The crmParamCyclesDetailsActivity entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmParamCyclesDetailsActivity $crmParamCyclesDetailsActivity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmparamcyclesdetailsactivity_delete', array('id' => $crmParamCyclesDetailsActivity->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
