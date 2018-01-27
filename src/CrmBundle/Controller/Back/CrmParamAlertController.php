<?php

namespace CrmBundle\Controller\Back;

use CrmBundle\Entity\Back\CrmParamAlert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Classes\Utils;

/**
 * Crmparamalert controller.
 *
 * @Route("crm/paramalert")
 */
class CrmParamAlertController extends Controller
{
    /**
     * Lists all crmParamAlert entities.
     *
     * @Route("/", name="crmparamalert_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $crmParamAlerts = $em->getRepository('CrmBundle:Back\CrmParamAlert')->findAll();

        return $this->render('CrmBundle:back/crmparamalert:index.html.twig', array(
            'crmParamAlerts' => $crmParamAlerts,
        ));
    }

    /**
     * Creates a new crmParamAlert entity.
     *
     * @Route("/new", name="crmparamalert_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmParamAlert = new Crmparamalert();
        $form = $this->createForm('CrmBundle\Form\Back\CrmParamAlertType', $crmParamAlert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /* updload for img et logo */
            $dir = $this->getParameter('upload_dir');            
            $crmParamAlert->setLogo(Utils::Upload_file($crmParamAlert->getLogo(), $dir));

            $em = $this->getDoctrine()->getManager();
            $em->persist($crmParamAlert);
            $em->flush();

            return $this->redirectToRoute('crmparamalert_index');
        }

        return $this->render('CrmBundle:back/crmparamalert:new.html.twig', array(
            'crmParamAlert' => $crmParamAlert,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmParamAlert entity.
     *
     * @Route("/{id}", name="crmparamalert_show")
     * @Method("GET")
     */
    public function showAction(CrmParamAlert $crmParamAlert)
    {
        $deleteForm = $this->createDeleteForm($crmParamAlert);

        return $this->render('CrmBundle:back/crmparamalert:show.html.twig', array(
            'crmParamAlert' => $crmParamAlert,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmParamAlert entity.
     *
     * @Route("/{id}/edit", name="crmparamalert_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmParamAlert $crmParamAlert)
    {
        $deleteForm = $this->createDeleteForm($crmParamAlert);
        $editForm = $this->createForm('CrmBundle\Form\Back\CrmParamAlertType', $crmParamAlert);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            /* update upload logo and img */
            $dir = $this->getParameter('upload_dir');
            $crmParamAlert->setLogo(Utils::Upload_file($crmParamAlert->getLogo(), $dir));

            $em = $this->getDoctrine()->getManager();
            $em->persist($crmParamAlert);
            $em->flush();

            return $this->redirectToRoute('crmparamalert_edit', array('id' => $crmParamAlert->getId()));
        }

        return $this->render('CrmBundle:back/crmparamalert:edit.html.twig', array(
            'crmParamAlert' => $crmParamAlert,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmParamAlert entity.
     *
     * @Route("/{id}", name="crmparamalert_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmParamAlert $crmParamAlert)
    {
        $form = $this->createDeleteForm($crmParamAlert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmParamAlert);
            $em->flush();
        }

        return $this->redirectToRoute('crmparamalert_index');
    }

    /**
     * Creates a form to delete a crmParamAlert entity.
     *
     * @param CrmParamAlert $crmParamAlert The crmParamAlert entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmParamAlert $crmParamAlert)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmparamalert_delete', array('id' => $crmParamAlert->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
