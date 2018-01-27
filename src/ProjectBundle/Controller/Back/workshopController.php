<?php

namespace ProjectBundle\Controller\Back;

use ProjectBundle\Entity\Back\Workshop;
use AppBundle\Entity\Common\Langue;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Workshop controller.
 *
 * @Route("back/workshop")
 */
class workshopController extends Controller
{
    /**
     * Lists all workshop entities.
     *
     * @Route("/", name="back_workshop_index",)
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $workshops = $em->getRepository('ProjectBundle:Back\Workshop')->findAll();

        return $this->render('ProjectBundle:back\workshop:index.html.twig', array(
            'workshops' => $workshops,
        ));
    }

    /**
     * Creates a new workshop entity.
     *
     * @Route("/new", name="back_workshop_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $workshop = new Workshop();
        $form = $this->createForm('\ProjectBundle\Form\Back\workshopType', $workshop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // imgcouleur
            $workshop->setImgcouleur($this->upload_file($workshop->getImgcouleur()));
            // img
            $workshop->setLogo($this->upload_file($workshop->getLogo()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($workshop);
            $em->flush();

            return $this->redirectToRoute('back_workshop_index');
        }

        return $this->render('ProjectBundle:back\workshop:new.html.twig', array(
            'workshop' => $workshop,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a workshop entity.
     *
     * @Route("/{id}", name="back_workshop_show")
     * @Method("GET")
     */
    public function showAction(workshop $workshop)
    {
        $deleteForm = $this->createDeleteForm($workshop);

        return $this->render('ProjectBundle:back/workshop:show.html.twig', array(
            'workshop' => $workshop,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing workshop entity.
     *
     * @Route("/{id}/edit", name="back_workshop_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, workshop $workshop)
    {
        $deleteForm = $this->createDeleteForm($workshop);
        $editForm = $this->createForm('ProjectBundle\Form\Back\workshopType', $workshop);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            // imgcouleur
            $workshop->setImgcouleur($this->upload_file($workshop->getImgcouleur()));
            // img
            $workshop->setLogo($this->upload_file($workshop->getLogo()));
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('back_workshop_edit', array('id' => $workshop->getId()));
        }

        return $this->render('ProjectBundle:back\workshop:edit.html.twig', array(
            'workshop' => $workshop,
            'filename' => [$workshop->getImgcouleur(), $workshop->getLogo()],
            'filetype' => 'image',
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a workshop entity.
     *
     * @Route("/{id}", name="back_workshop_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, workshop $workshop)
    {
        $form = $this->createDeleteForm($workshop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($workshop);
            $em->flush();
        }

        return $this->redirectToRoute('back_workshop_index');
    }

    /**
     * Creates a form to delete a workshop entity.
     *
     * @param workshop $workshop The workshop entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(workshop $workshop)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('back_workshop_delete', array('id' => $workshop->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // pour les fichiers
    private function upload_file ($file) {
        return \AppBundle\Entity\Classes\Utils::Upload_file($file, $this->getParameter('upload_dir'));
    }
}
