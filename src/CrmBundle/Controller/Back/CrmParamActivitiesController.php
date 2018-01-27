<?php

namespace CrmBundle\Controller\Back;

use CrmBundle\Entity\Back\CrmParamActivities;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Classes\Utils;

/**
 * Crmparamactivity controller.
 *
 * @Route("crm/paramactivities")
 */
class CrmParamActivitiesController extends Controller
{
    /**
     * Lists all crmParamActivity entities.
     *
     * @Route("/", name="crmparamactivities_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $crmParamActivities = $em->getRepository('CrmBundle:Back\CrmParamActivities')->findAll();

        return $this->render('CrmBundle:back/crmparamactivities:index.html.twig', array(
            'crmParamActivities' => $crmParamActivities,
        ));
    }

    /**
     * Creates a new crmParamActivity entity.
     *
     * @Route("/new", name="crmparamactivities_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmParamActivity = new CrmParamActivities();
        $form = $this->createForm('CrmBundle\Form\Back\CrmParamActivitiesType', $crmParamActivity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dir = $this->getParameter('upload_dir');
            // imgcouleur
            $crmParamActivity->setImgcouleur(Utils::Upload_file($crmParamActivity->getImgcouleur(), $dir));
            // img
            $crmParamActivity->setLogo(Utils::Upload_file($crmParamActivity->getLogo(), $dir));
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmParamActivity);
            $em->flush();

            return $this->redirectToRoute('crmparamactivities_index');
        }

        return $this->render('CrmBundle:back/crmparamactivities:new.html.twig', array(
            'crmParamActivity' => $crmParamActivity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmParamActivity entity.
     *
     * @Route("/{id}", name="crmparamactivities_show")
     * @Method("GET")
     */
    public function showAction(CrmParamActivities $crmParamActivity)
    {
        $deleteForm = $this->createDeleteForm($crmParamActivity);

        return $this->render('CrmBundle:back/crmparamactivities:show.html.twig', array(
            'crmParamActivity' => $crmParamActivity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmParamActivity entity.
     *
     * @Route("/{id}/edit", name="crmparamactivities_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmParamActivities $crmParamActivity)
    {
        $deleteForm = $this->createDeleteForm($crmParamActivity);
        $editForm = $this->createForm('CrmBundle\Form\Back\CrmParamActivitiesType', $crmParamActivity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dir = $this->getParameter('upload_dir');
            // imgcouleur
            if( ($imgcouleur_string = Utils::Upload_file($crmParamActivity->getImgcouleur(), $dir)) )
                $crmParamActivity->setImgcouleur($imgcouleur_string);
            else
                $crmParamActivity->setImgcouleur($request->get('img_couleur'));

            // logo
            if( ($logo = Utils::Upload_file($crmParamActivity->getLogo(), $dir)) )
                $crmParamActivity->setLogo($logo);
            else
                $crmParamActivity->setLogo($request->get('logo'));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('crmparamactivities_edit', array('id' => $crmParamActivity->getId()));
        }

        return $this->render('CrmBundle:back/crmparamactivities:edit.html.twig', array(
            'crmParamActivity' => $crmParamActivity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmParamActivity entity.
     *
     * @Route("/{id}", name="crmparamactivities_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmParamActivities $crmParamActivity)
    {
        $form = $this->createDeleteForm($crmParamActivity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmParamActivity);
            $em->flush();
        }

        return $this->redirectToRoute('crmparamactivities_index');
    }

    /**
     * Creates a form to delete a crmParamActivity entity.
     *
     * @param CrmParamActivities $crmParamActivity The crmParamActivity entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmParamActivities $crmParamActivity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmparamactivities_delete', array('id' => $crmParamActivity->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
