<?php

namespace UsersBundle\Controller;

use UsersBundle\Entity\UserNotes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Usernote controller.
 *
 * @Route("usernotes")
 */
class UserNotesController extends Controller
{
    /**
     * Lists all userNote entities.
     *
     * @Route("/", name="usernotes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $userNotes = $em->getRepository('UsersBundle:UserNotes')->findAll();

        return $this->render('UsersBundle:usernotes:index.html.twig', array(
            'userNotes' => $userNotes,
        ));
    }

    /**
     * Creates a new userNote entity.
     *
     * @Route("/new", name="usernotes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $userNote = new UserNotes();
        $form = $this->createForm('UsersBundle\Form\UserNotesType', $userNote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $userNote->setDate(new \DateTime('now'));
            $userNote->setVersion(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($userNote);
            $em->flush();

            if( ($user_id = $request->get('idUser')) )
                return $this->redirectToRoute('user_edit', ['id' => $user_id]);                
            return $this->redirectToRoute('usernotes_index');
        }

        return $this->render('UsersBundle:usernotes:new.html.twig', array(
            'userNote' => $userNote,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a userNote entity.
     *
     * @Route("/{id}", name="usernotes_show")
     * @Method("GET")
     */
    public function showAction(UserNotes $userNote)
    {
        $deleteForm = $this->createDeleteForm($userNote);

        return $this->render('UsersBundle:usernotes:show.html.twig', array(
            'userNote' => $userNote,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing userNote entity.
     *
     * @Route("/{id}/edit", name="usernotes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UserNotes $userNote)
    {
        $deleteForm = $this->createDeleteForm($userNote);
        $editForm = $this->createForm('UsersBundle\Form\UserNotesType', $userNote);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            if( ($user_id = $request->get('idUser')) )
                return $this->redirectToRoute('user_edit', ['id' => $user_id]);     
            return $this->redirectToRoute('usernotes_edit', array('id' => $userNote->getId()));
        }

        return $this->render('UsersBundle:usernotes:edit.html.twig', array(
            'userNote' => $userNote,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a userNote entity.
     *
     * @Route("/{id}", name="usernotes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UserNotes $userNote)
    {
        $form = $this->createDeleteForm($userNote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userNote);
            $em->flush();
        }

        if( ($user_id = $request->get('idUser')) )
            return $this->redirectToRoute('user_edit', ['id' => $user_id]); 

        return $this->redirectToRoute('usernotes_index');
    }

    /**
     * Creates a form to delete a userNote entity.
     *
     * @param UserNotes $userNote The userNote entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserNotes $userNote)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usernotes_delete', array('id' => $userNote->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
