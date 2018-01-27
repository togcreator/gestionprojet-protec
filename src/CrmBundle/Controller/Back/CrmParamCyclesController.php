<?php

namespace CrmBundle\Controller\Back;

use CrmBundle\Entity\Back\CrmParamCycles;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Classes\Utils;

/**
 * Crmparamactivity controller.
 *
 * @Route("crm/paramcycles")
 */
class CrmParamCyclesController extends Controller
{
    /**
     * Lists all crmParamCycles entities.
     *
     * @Route("/", name="crmparamcycles_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $crmParamCycles = $em->getRepository('CrmBundle:Back\CrmParamCycles')->findAll();

        return $this->render('CrmBundle:back/crmparamcycles:index.html.twig', array(
            'crmParamCycles' => $crmParamCycles,
        ));
    }

    /**
     * Creates a new crmParamCycles entity.
     *
     * @Route("/new", name="crmparamcycles_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmParamCycles = new CrmParamCycles();
        $form = $this->createForm('CrmBundle\Form\Back\CrmParamCyclesType', $crmParamCycles);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dir = $this->getParameter('upload_dir');
            // imgcouleur
            $crmParamCycles->setImgcouleur(Utils::Upload_file($crmParamCycles->getImgcouleur(), $dir));
            // img
            $crmParamCycles->setLogo(Utils::Upload_file($crmParamCycles->getLogo(), $dir));

            $em = $this->getDoctrine()->getManager();
            $em->persist($crmParamCycles);
            $em->flush();

            return $this->redirectToRoute('crmparamcycles_index');
        }

        return $this->render('CrmBundle:back/crmparamcycles:new.html.twig', array(
            'crmParamCycles' => $crmParamCycles,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmParamCycles entity.
     *
     * @Route("/{id}", name="crmparamcycles_show")
     * @Method("GET")
     */
    public function showAction(CrmParamCycles $crmParamCycles)
    {
        $deleteForm = $this->createDeleteForm($crmParamCycles);

        return $this->render('CrmBundle:back/crmparamcycles:show.html.twig', array(
            'crmParamCycles' => $crmParamCycles,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmParamCycles entity.
     *
     * @Route("/{id}/edit", name="crmparamcycles_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmParamCycles $crmParamCycles)
    {
        $deleteForm = $this->createDeleteForm($crmParamCycles);
        $editForm = $this->createForm('CrmBundle\Form\Back\CrmParamCyclesType', $crmParamCycles);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dir = $this->getParameter('upload_dir');

            // fichier image
            $crmParamCycles->setImgcouleur(Utils::Upload_file($crmParamCycles->getImgcouleur(), $dir));
            $crmParamCycles->setLogo(Utils::Upload_file($crmParamCycles->getLogo(), $dir));
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('crmparamcycles_edit', array('id' => $crmParamCycles->getId()));
        }

        return $this->render('CrmBundle:back/crmparamcycles:edit.html.twig', array(
            'crmParamCycles' => $crmParamCycles,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmParamCycles entity.
     *
     * @Route("/{id}", name="crmparamcycles_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmParamCycles $crmParamCycles)
    {
        $form = $this->createDeleteForm($crmParamCycles);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmParamCycles);
            $em->flush();
        }

        return $this->redirectToRoute('crmparamcycles_index');
    }

    /**
     * Creates a form to delete a crmParamCycles entity.
     *
     * @param CrmParamCycles $crmParamCycles The crmParamCycles entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmParamCycles $crmParamCycles)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmparamcycles_delete', array('id' => $crmParamCycles->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
