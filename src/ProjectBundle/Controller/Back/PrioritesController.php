<?php

namespace ProjectBundle\Controller\Back;

use ProjectBundle\Entity\Back\Priorites;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Classes\Utils;

/**
 * Priorite controller.
 *
 * @Route("back/priorites")
 */
class PrioritesController extends Controller
{
    /**
     * Lists all priorite entities.
     *
     * @Route("/", name="back_priorites_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $priorites = $em->getRepository('ProjectBundle:Back\Priorites')->findAll();

        return $this->render('ProjectBundle:back\priorites:index.html.twig', array(
            'priorites' => $priorites,
        ));
    }

    /**
     * Creates a new priorite entity.
     *
     * @Route("/new", name="back_priorites_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $priorite = new Priorites();
        $form = $this->createForm('ProjectBundle\Form\Back\PrioritesType', $priorite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dir = $this->getParameter('upload_dir');
            // imgcouleur
            $priorite->setImgcouleur(Utils::Upload_file($priorite->getImgcouleur(), $dir));
            // img
            $priorite->setLogo(Utils::Upload_file($priorite->getLogo(), $dir));

            /**
             * pour code
             */
            \AppBundle\Entity\Classes\Utils::setCode($priorite);

            $em = $this->getDoctrine()->getManager();
            $em->persist($priorite);
            $em->flush();

            return $this->redirectToRoute('back_priorites_index');
        }

        return $this->render('ProjectBundle:back\priorites:new.html.twig', array(
            'priorite' => $priorite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a priorite entity.
     *
     * @Route("/{id}", name="back_priorites_show")
     * @Method("GET")
     */
    public function showAction(Priorites $priorite)
    {
        $deleteForm = $this->createDeleteForm($priorite);

        return $this->render('ProjectBundle:back\priorites:show.html.twig', array(
            'priorite' => $priorite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing priorite entity.
     *
     * @Route("/{id}/edit", name="back_priorites_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Priorites $priorite)
    {
        $deleteForm = $this->createDeleteForm($priorite);
        $editForm = $this->createForm('ProjectBundle\Form\Back\PrioritesType', $priorite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dir = $this->getParameter('upload_dir');
            // imgcouleur
            $priorite->setImgcouleur(Utils::Upload_file($priorite->getImgcouleur(), $dir));
            // img
            $priorite->setLogo(Utils::Upload_file($priorite->getLogo(), $dir));

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('back_priorites_edit', array('id' => $priorite->getId()));
        }

        return $this->render('ProjectBundle:back\priorites:edit.html.twig', array(
            'priorite' => $priorite,
            'filetype' => 'image',
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a priorite entity.
     *
     * @Route("/{id}", name="back_priorites_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Priorites $priorite)
    {
        $form = $this->createDeleteForm($priorite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($priorite);
            $em->flush();
        }

        return $this->redirectToRoute('back_priorites_index');
    }

    /**
     * Creates a form to delete a priorite entity.
     *
     * @param Priorites $priorite The priorite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Priorites $priorite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('back_priorites_delete', array('id' => $priorite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
