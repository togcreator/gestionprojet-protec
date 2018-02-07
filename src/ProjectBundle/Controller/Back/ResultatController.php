<?php

namespace ProjectBundle\Controller\Back;

use ProjectBundle\Entity\Back\Resultat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Resultat controller.
 *
 * @Route("back/resultat")
 */
class ResultatController extends Controller
{
    /**
     * Lists all resultat entities.
     *
     * @Route("/", name="back_resultat_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $resultats = $em->getRepository('ProjectBundle:Back\Resultat')->findAll();

        return $this->render('ProjectBundle:back/resultat:index.html.twig', array(
            'resultats' => $resultats,
        ));
    }

    // for upalded file
    public function upload_file($file) 
    {
        if( !is_object($file) ) return;

        // updload dir
        $dir = $this->getParameter('upload_dir');
        // file name
        $fileName = $file->getClientOriginalName();
        // move file
        $file->move($dir, $fileName);
        // return filename
        return $fileName;
    }

    /**
     * Creates a new resultat entity.
     *
     * @Route("/new", name="back_resultat_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $resultat = new Resultat();
        $form = $this->createForm('ProjectBundle\Form\Back\ResultatType', $resultat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resultat->setImgcouleur($this->upload_file($resultat->getImgcouleur()));
            $resultat->setLogo($this->upload_file($resultat->getLogo()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($resultat);
            $em->flush();

            return $this->redirectToRoute('back_resultat_index');
        }

        return $this->render('ProjectBundle:back/resultat:new.html.twig', array(
            'resultat' => $resultat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a resultat entity.
     *
     * @Route("/{id}", name="back_resultat_show")
     * @Method("GET")
     */
    public function showAction(Resultat $resultat)
    {
        $deleteForm = $this->createDeleteForm($resultat);

        return $this->render('ProjectBundle:back/resultat:show.html.twig', array(
            'resultat' => $resultat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing resultat entity.
     *
     * @Route("/{id}/edit", name="back_resultat_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Resultat $resultat)
    {
        $resultat->setOuvert($resultat->getOuvert() ? true : false);

        $deleteForm = $this->createDeleteForm($resultat);
        $editForm = $this->createForm('ProjectBundle\Form\Back\ResultatType', $resultat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // imgcouleur
            if( ($imgcouleur_string = $this->upload_file($resultat->getImgcouleur())) )
                $resultat->setImgcouleur($imgcouleur_string);
            else
                $resultat->setImgcouleur($request->get('img_couleur'));
            // logo
            if( ($logo = $this->upload_file($resultat->getLogo())) )
                $resultat->setLogo($logo);
            else
                $resultat->setLogo($request->get('logo'));

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('back_resultat_edit', array('id' => $resultat->getId()));
        }

        return $this->render('ProjectBundle:back/resultat:edit.html.twig', array(
            'resultat' => $resultat,
            'filetype' => 'image',
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a resultat entity.
     *
     * @Route("/{id}", name="back_resultat_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Resultat $resultat)
    {
        $form = $this->createDeleteForm($resultat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($resultat);
            $em->flush();
        }

        return $this->redirectToRoute('back_resultat_index');
    }

    /**
     * Creates a form to delete a resultat entity.
     *
     * @param Resultat $resultat The resultat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Resultat $resultat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('back_resultat_delete', array('id' => $resultat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
