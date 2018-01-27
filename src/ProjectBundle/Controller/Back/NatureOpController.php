<?php

namespace ProjectBundle\Controller\Back;

use ProjectBundle\Entity\Back\NatureOp;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Classes\Utils;

/**
 * Priorite controller.
 *
 * @Route("back/natureop")
 */
class NatureOpController extends Controller
{
    /**
     * Lists all priorite entities.
     *
     * @Route("/", name="back_natureop_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $natureop = $em->getRepository('ProjectBundle:Back\NatureOp')->findAll();

        return $this->render('ProjectBundle:back\natureop:index.html.twig', array(
            'natureops' => $natureop,
        ));
    }

    /**
     * Creates a new priorite entity.
     *
     * @Route("/new", name="back_natureop_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $priorite = new NatureOp();
        $form = $this->createForm('ProjectBundle\Form\Back\NatureOpType', $priorite, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dir = $this->getParameter('upload_dir');
            // imgcouleur
            $priorite->setImgcouleur(Utils::Upload_file($priorite->getImgcouleur(), $dir));
            // img
            $priorite->setLogo(Utils::Upload_file($priorite->getLogo(), $dir));

            $em = $this->getDoctrine()->getManager();
            $em->persist($priorite);
            $em->flush();

            return $this->redirectToRoute('back_natureop_index');
        }

        return $this->render('ProjectBundle:back\natureop:new.html.twig', array(
            'priorite' => $priorite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a priorite entity.
     *
     * @Route("/{id}", name="back_natureop_show")
     * @Method("GET")
     */
    public function showAction(NatureOp $priorite)
    {
        $deleteForm = $this->createDeleteForm($priorite);

        return $this->render('ProjectBundle:back\natureop:show.html.twig', array(
            'priorite' => $priorite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing priorite entity.
     *
     * @Route("/{id}/edit", name="back_natureop_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, NatureOp $priorite)
    {
        $deleteForm = $this->createDeleteForm($priorite);
        $editForm = $this->createForm('ProjectBundle\Form\Back\NatureOpType', $priorite, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dir = $this->getParameter('upload_dir');
            // imgcouleur
            if( ($imgcouleur_string = Utils::Upload_file($priorite->getImgcouleur(), $dir)) )
                $priorite->setImgcouleur($imgcouleur_string);
            else
                $priorite->setImgcouleur($request->get('img_couleur'));

            // logo
            if( ($logo = Utils::Upload_file($priorite->getLogo(), $dir)) )
                $priorite->setLogo($logo);
            else
                $priorite->setLogo($request->get('logo'));

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('back_natureop_edit', array('id' => $priorite->getId()));
        }

        return $this->render('ProjectBundle:back\natureop:edit.html.twig', array(
            'priorite' => $priorite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a priorite entity.
     *
     * @Route("/{id}", name="back_natureop_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, NatureOp $priorite)
    {
        $form = $this->createDeleteForm($priorite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($priorite);
            $em->flush();
        }

        return $this->redirectToRoute('back_natureop_index');
    }

    /**
     * Creates a form to delete a priorite entity.
     *
     * @param NatureOp $priorite The priorite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(NatureOp $priorite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('back_natureop_delete', array('id' => $priorite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // data form
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'workshops' => $em->getRepository('ProjectBundle:Back\Workshop')->findAll(),
        ];
    }
}
