<?php

namespace CrmBundle\Controller\Back;

use CrmBundle\Entity\Back\CrmParamTypeResultat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Classes\Utils;

/**
 * Crmparamactivity controller.
 *
 * @Route("crm/paramtyperesultat")
 */
class CrmParamTypeResultatController extends Controller
{
    /**
     * Lists all crmParamTypeResultat entities.
     *
     * @Route("/", name="crmparamtyperesultat_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $crmParamTypeResultat = $em->getRepository('CrmBundle:Back\CrmParamTypeResultat')->findAll();

        return $this->render('CrmBundle:back/crmparamtyperesultat:index.html.twig', array(
            'crmParamTypeResultat' => $crmParamTypeResultat,
        ));
    }

    /**
     * Creates a new crmParamTypeResultat entity.
     *
     * @Route("/new", name="crmparamtyperesultat_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmParamTypeResultat = new CrmParamTypeResultat();
        $form = $this->createForm('CrmBundle\Form\Back\CrmParamTypeResultatType', $crmParamTypeResultat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dir = $this->getParameter('upload_dir');
            // imgcouleur
            $crmParamTypeResultat->setImgcouleur(Utils::Upload_file($crmParamTypeResultat->getImgcouleur(), $dir));
            // img
            $crmParamTypeResultat->setLogo(Utils::Upload_file($crmParamTypeResultat->getLogo(), $dir));
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmParamTypeResultat);
            $em->flush();

            return $this->redirectToRoute('crmparamtyperesultat_index');
        }

        return $this->render('CrmBundle:back/crmparamtyperesultat:new.html.twig', array(
            'crmParamTypeResultat' => $crmParamTypeResultat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmParamTypeResultat entity.
     *
     * @Route("/{id}", name="crmparamtyperesultat_show")
     * @Method("GET")
     */
    public function showAction(CrmParamTypeResultat $crmParamTypeResultat)
    {
        $deleteForm = $this->createDeleteForm($crmParamTypeResultat);

        return $this->render('CrmBundle:back/crmparamtyperesultat:show.html.twig', array(
            'crmParamTypeResultat' => $crmParamTypeResultat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmParamTypeResultat entity.
     *
     * @Route("/{id}/edit", name="crmparamtyperesultat_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmParamTypeResultat $crmParamTypeResultat)
    {
        $deleteForm = $this->createDeleteForm($crmParamTypeResultat);
        $editForm = $this->createForm('CrmBundle\Form\Back\CrmParamTypeResultatType', $crmParamTypeResultat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dir = $this->getParameter('upload_dir');
            // imgcouleur
            $crmParamTypeResultat->setImgcouleur(Utils::Upload_file($crmParamTypeResultat->getImgcouleur(), $dir));
            $crmParamTypeResultat->setLogo(Utils::Upload_file($crmParamTypeResultat->getLogo(), $dir));

            $em = $this->getDoctrine()->getManager();
            $em->persist($crmParamTypeResultat);
            $em->flush();

            return $this->redirectToRoute('crmparamtyperesultat_edit', array('id' => $crmParamTypeResultat->getId()));
        }

        return $this->render('CrmBundle:back/crmparamtyperesultat:edit.html.twig', array(
            'crmParamTypeResultat' => $crmParamTypeResultat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmParamTypeResultat entity.
     *
     * @Route("/{id}", name="crmparamtyperesultat_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmParamTypeResultat $crmParamTypeResultat)
    {
        $form = $this->createDeleteForm($crmParamTypeResultat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmParamTypeResultat);
            $em->flush();
        }

        return $this->redirectToRoute('crmparamtyperesultat_index');
    }

    /**
     * Creates a form to delete a crmParamTypeResultat entity.
     *
     * @param CrmParamTypeResultat $crmParamTypeResultat The crmParamTypeResultat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmParamTypeResultat $crmParamTypeResultat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmparamtyperesultat_delete', array('id' => $crmParamTypeResultat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
