<?php

namespace CrmBundle\Controller\Back;

use CrmBundle\Entity\Back\CrmParamStatut;
use AppBundle\Entity\Classes\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Crmparamstatut controller.
 *
 * @Route("crm/paramstatut")
 */
class CrmParamStatutController extends Controller
{
    /**
     * Lists all crmParamStatut entities.
     *
     * @Route("/", name="crmparamstatut_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $crmParamStatuts = $em->getRepository('CrmBundle:Back\CrmParamStatut')->findAll();

        return $this->render('CrmBundle:back/crmparamstatut:index.html.twig', array(
            'crmParamStatuts' => $crmParamStatuts,
        ));
    }

    /**
     * Creates a new crmParamStatut entity.
     *
     * @Route("/new", name="crmparamstatut_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmParamStatut = new Crmparamstatut();
        $form = $this->createForm('CrmBundle\Form\Back\CrmParamStatutType', $crmParamStatut, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /* updload for img et logo */
            $dir = $this->getParameter('upload_dir');            
            $crmParamStatut->setImgcouleur(Utils::Upload_file($crmParamStatut->getImgcouleur(), $dir));
            $crmParamStatut->setLogo(Utils::Upload_file($crmParamStatut->getLogo(), $dir));

            $em = $this->getDoctrine()->getManager();
            $em->persist($crmParamStatut);
            $em->flush();

            return $this->redirectToRoute('crmparamstatut_index');
        }

        return $this->render('CrmBundle:back/crmparamstatut:new.html.twig', array(
            'crmParamStatut' => $crmParamStatut,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmParamStatut entity.
     *
     * @Route("/{id}", name="crmparamstatut_show")
     * @Method("GET")
     */
    public function showAction(CrmParamStatut $crmParamStatut)
    {
        $deleteForm = $this->createDeleteForm($crmParamStatut);

        return $this->render('CrmBundle:back/crmparamstatut:show.html.twig', array(
            'crmParamStatut' => $crmParamStatut,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmParamStatut entity.
     *
     * @Route("/{id}/edit", name="crmparamstatut_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmParamStatut $crmParamStatut)
    {
        $deleteForm = $this->createDeleteForm($crmParamStatut);
        $editForm = $this->createForm('CrmBundle\Form\Back\CrmParamStatutType', $crmParamStatut, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            /* update upload logo and img */
            $dir = $this->getParameter('upload_dir');
            $crmParamStatut->setImgcouleur(Utils::Upload_file($crmParamStatut->getImgcouleur(), $dir));
            $crmParamStatut->setLogo(Utils::Upload_file($crmParamStatut->getLogo(), $dir));

            $em = $this->getDoctrine()->getManager();
            $em->persist($crmParamStatut);
            $em->flush();
            return $this->redirectToRoute('crmparamstatut_edit', array('id' => $crmParamStatut->getId()));
        }

        return $this->render('CrmBundle:back/crmparamstatut:edit.html.twig', array(
            'crmParamStatut' => $crmParamStatut,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmParamStatut entity.
     *
     * @Route("/{id}", name="crmparamstatut_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmParamStatut $crmParamStatut)
    {
        $form = $this->createDeleteForm($crmParamStatut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmParamStatut);
            $em->flush();
        }

        return $this->redirectToRoute('crmparamstatut_index');
    }

    /**
     * Creates a form to delete a crmParamStatut entity.
     *
     * @param CrmParamStatut $crmParamStatut The crmParamStatut entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmParamStatut $crmParamStatut)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmparamstatut_delete', array('id' => $crmParamStatut->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

     // dataForm
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'types' => $em->getRepository('CrmBundle:Back\CrmParamStatutType')->findBy(['ouvert' => 1])
        ];
    }
}
