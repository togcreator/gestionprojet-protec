<?php

namespace CrmBundle\Controller\Back;

use CrmBundle\Entity\Back\CrmParamPriorites;
use AppBundle\Entity\Classes\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Crmparampriorite controller.
 *
 * @Route("crm/parampriorites")
 */
class CrmParamPrioritesController extends Controller
{
    /**
     * Lists all crmParamPriorite entities.
     *
     * @Route("/", name="crmparampriorites_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $crmParamPriorites = $em->getRepository('CrmBundle:Back\CrmParamPriorites')->findAll();

        return $this->render('CrmBundle:back/crmparampriorites:index.html.twig', array(
            'crmParamPriorites' => $crmParamPriorites,
        ));
    }

    /**
     * Creates a new crmParamPriorite entity.
     *
     * @Route("/new", name="crmparampriorites_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmParamPriorite = new CrmParamPriorites();
        $form = $this->createForm('CrmBundle\Form\Back\CrmParamPrioritesType', $crmParamPriorite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /* upload for img et logo */
            $dir = $this->getParameter('upload_dir');            
            $crmParamPriorite->setImgcouleur(Utils::Upload_file($crmParamPriorite->getImgcouleur(), $dir));
            $crmParamPriorite->setLogo(Utils::Upload_file($crmParamPriorite->getLogo(), $dir));

            /* for code */
            Utils::setCode($crmParamPriorite);

            $em = $this->getDoctrine()->getManager();
            $em->persist($crmParamPriorite);
            $em->flush();

            return $this->redirectToRoute('crmparampriorites_index');
        }

        return $this->render('CrmBundle:back/crmparampriorites:new.html.twig', array(
            'crmParamPriorite' => $crmParamPriorite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmParamPriorite entity.
     *
     * @Route("/{id}", name="crmparampriorites_show")
     * @Method("GET")
     */
    public function showAction(CrmParamPriorites $crmParamPriorite)
    {
        $deleteForm = $this->createDeleteForm($crmParamPriorite);

        return $this->render('CrmBundle:back/crmparampriorites:show.html.twig', array(
            'crmParamPriorite' => $crmParamPriorite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmParamPriorite entity.
     *
     * @Route("/{id}/edit", name="crmparampriorites_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmParamPriorites $crmParamPriorite)
    {
        $deleteForm = $this->createDeleteForm($crmParamPriorite);
        $editForm = $this->createForm('CrmBundle\Form\Back\CrmParamPrioritesType', $crmParamPriorite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            /* update upload logo and img */
            $dir = $this->getParameter('upload_dir');
            $crmParamPriorite->setImgcouleur(Utils::Upload_file($crmParamPriorite->getImgcouleur(), $dir));
            $crmParamPriorite->setLogo(Utils::Upload_file($crmParamPriorite->getLogo(), $dir));

            $em = $this->getDoctrine()->getManager();
            $em->persist($crmParamPriorite);
            $em->flush();

            return $this->redirectToRoute('crmparampriorites_edit', array('id' => $crmParamPriorite->getId()));
        }

        return $this->render('CrmBundle:back/crmparampriorites:edit.html.twig', array(
            'crmParamPriorite' => $crmParamPriorite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmParamPriorite entity.
     *
     * @Route("/{id}", name="crmparampriorites_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmParamPriorites $crmParamPriorite)
    {
        $form = $this->createDeleteForm($crmParamPriorite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmParamPriorite);
            $em->flush();
        }

        return $this->redirectToRoute('crmparampriorites_index');
    }

    /**
     * Creates a form to delete a crmParamPriorite entity.
     *
     * @param CrmParamPriorites $crmParamPriorite The crmParamPriorite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmParamPriorites $crmParamPriorite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmparampriorites_delete', array('id' => $crmParamPriorite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
