<?php

namespace ProjectBundle\Controller\Back;

use ProjectBundle\Entity\Back\Jalon;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Classes\Utils;

/**
 * Jalon controller.
 *
 * @Route("back/jalon")
 */
class JalonController extends Controller
{
    /**
     * Lists all jalon entities.
     *
     * @Route("/", name="back_jalon_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jalons = $em->getRepository('ProjectBundle:Back\Jalon')->findAll();

        return $this->render('ProjectBundle:back\jalon:index.html.twig', array(
            'jalons' => $jalons,
        ));
    }

    /**
     * Creates a new jalon entity.
     *
     * @Route("/new", name="back_jalon_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $jalon = new Jalon();
        $form = $this->createForm('ProjectBundle\Form\Back\JalonType', $jalon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $dir = $this->getParameter('upload_dir');
            // imgcouleur
            $jalon->setImgcouleur(Utils::Upload_file($jalon->getImgcouleur(), $dir));
            // img
            $jalon->setLogo(Utils::Upload_file($jalon->getLogo(), $dir));

            $em = $this->getDoctrine()->getManager();
            $em->persist($jalon);
            $em->flush();

            return $this->redirectToRoute('back_jalon_index');
        }

        return $this->render('ProjectBundle:back\jalon:new.html.twig', array(
            'jalon' => $jalon,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a jalon entity.
     *
     * @Route("/{id}", name="back_jalon_show")
     * @Method("GET")
     */
    public function showAction(Jalon $jalon)
    {
        $deleteForm = $this->createDeleteForm($jalon);

        return $this->render('ProjectBundle:back\jalon:show.html.twig', array(
            'jalon' => $jalon,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing jalon entity.
     *
     * @Route("/{id}/edit", name="back_jalon_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Jalon $jalon)
    {
        $deleteForm = $this->createDeleteForm($jalon);
        $editForm = $this->createForm('ProjectBundle\Form\Back\JalonType', $jalon);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $dir = $this->getParameter('upload_dir');
            // imgcouleur
            $jalon->setImgcouleur(Utils::Upload_file($jalon->getImgcouleur(), $dir));
            // img
            $jalon->setLogo(Utils::Upload_file($jalon->getLogo(), $dir));

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('back_jalon_edit', array('id' => $jalon->getId()));
        }

        return $this->render('ProjectBundle:back\jalon:edit.html.twig', array(
            'jalon' => $jalon,
            'filetype' => 'image',
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a jalon entity.
     *
     * @Route("/{id}", name="back_jalon_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Jalon $jalon)
    {
        $form = $this->createDeleteForm($jalon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jalon);
            $em->flush();
        }

        return $this->redirectToRoute('back_jalon_index');
    }

    /**
     * Creates a form to delete a jalon entity.
     *
     * @param Jalon $jalon The jalon entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Jalon $jalon)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('back_jalon_delete', array('id' => $jalon->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
