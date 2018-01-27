<?php

namespace ProjectBundle\Controller\Back;

use ProjectBundle\Entity\Back\Statut;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Classes\Utils;

/**
 * Statut controller.
 *
 * @Route("back/statut")
 */
class StatutController extends Controller
{
    /**
     * Lists all statut entities.
     *
     * @Route("/", name="back_statut_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $statuts = $em->getRepository('ProjectBundle:Back\Statut')->findAll();
        return $this->render('ProjectBundle:back\statut:index.html.twig', array(
            'statuts' => $statuts,
        ));
    }

    /**
     * Lists one of idType statut1Type statut entities.
     *
     * @Route("/{idType}/get", name="back_statut_get")
     * @Method("GET")
     */
    public function getAction($idType)
    {
        $em = $this->getDoctrine()->getManager();
        if( !$idType ) return $this->redirectToRoute('back_statutType_index');

        $statuts = $em->getRepository('ProjectBundle:Back\Statut')->findBy(['idType' => $idType]);
        return $this->render('ProjectBundle:back\statut:index.html.twig', array(
            'statuts' => $statuts,
        ));
    }

    // for uploads
    private function setUpload ($statut) 
    {
        // imgcouleur
        if( ($up = Utils::Upload_file($statut->getImgcouleur(), $this->getParameter('upload_dir'))) != null )
            $statut->setImgcouleur($up);

        // logo
        if( ($up = Utils::Upload_file($statut->getLogo(), $this->getParameter('upload_dir'))) != null )
            $statut->setLogo($up);
    }


    /**
     * Creates a new statut entity.
     *
     * @Route("/new", name="back_statut_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $statut = new Statut();
        $form = $this->createForm('ProjectBundle\Form\Back\StatutType', $statut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // these upload
            $this->setUpload($statut);

            $em = $this->getDoctrine()->getManager();
            $em->persist($statut);
            $em->flush();

            return $this->redirectToRoute('back_statut_get', ['idType' => $statut->getIdType()]);
        }

        return $this->render('ProjectBundle:back\statut:new.html.twig', array(
            'statut' => $statut,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a statut entity.
     *
     * @Route("/{id}", name="back_statut_show")
     * @Method("GET")
     */
    public function showAction(Statut $statut)
    {
        $deleteForm = $this->createDeleteForm($statut);

        return $this->render('ProjectBundle:back\statut:show.html.twig', array(
            'statut' => $statut,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing statut entity.
     *
     * @Route("/{id}/edit", name="back_statut_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Statut $statut)
    {
        $deleteForm = $this->createDeleteForm($statut);
        $editForm = $this->createForm('ProjectBundle\Form\Back\StatutType', $statut);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            // these upload
            $this->setUpload($statut);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('back_statut_edit', ['id' => $statut->getId(), 'idType' => $statut->getIdType() ]);
        }

        return $this->render('ProjectBundle:back\statut:edit.html.twig', array(
            'statut' => $statut,
            'filetype' => 'image',
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a statut entity.
     *
     * @Route("/{id}", name="back_statut_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Statut $statut)
    {
        $form = $this->createDeleteForm($statut);
        $form->handleRequest($request);
        $idType = $statut->getIdType();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($statut);
            $em->flush();
        }

        return $this->redirectToRoute('back_statut_get', ['idType' => $idType]);
    }

    /**
     * Creates a form to delete a statut entity.
     *
     * @param Statut $statut The statut entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Statut $statut)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('back_statut_delete', array('id' => $statut->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
