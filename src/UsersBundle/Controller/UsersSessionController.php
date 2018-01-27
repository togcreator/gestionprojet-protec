<?php

namespace UsersBundle\Controller;

use AppBundle\Entity\Common\UsersSession;
use UsersBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Userssession controller.
 *
 * @Route("userssession")
 */
class UsersSessionController extends Controller
{
    /**
     * Lists all usersSession entities.
     *
     * @Route("/", name="userssession_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        // redirect to       
        return $this->redirectToRoute('users_index');
    }

    /**
     * Creates a new usersSession entity.
     *
     * @Route("/new", name="common_userssession_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $usersSession = new Userssession();
        $form = $this->createForm('UsersBundle\Form\UsersSessionType', $usersSession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($usersSession);
            $em->flush();

            return $this->redirectToRoute('common_userssession_show', array('id' => $usersSession->getId()));
        }

        return $this->render('common/userssession/new.html.twig', array(
            'usersSession' => $usersSession,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a usersSession entity.
     *
     * @Route("/{id}", name="common_userssession_show")
     * @Method("GET")
     */
    public function showAction(UsersSession $usersSession)
    {
        $deleteForm = $this->createDeleteForm($usersSession);

        return $this->render('common/userssession/show.html.twig', array(
            'usersSession' => $usersSession,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing usersSession entity.
     *
     * @Route("/edit", name="userssession_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UsersSession $usersSession)
    {
        $deleteForm = $this->createDeleteForm($usersSession);
        $editForm = $this->createForm('UsersBundle\Form\UsersSessionType', $usersSession);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('common_userssession_edit', array('id' => $usersSession->getId()));
        }

        return $this->render('common/userssession/edit.html.twig', array(
            'usersSession' => $usersSession,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a usersSession entity.
     *
     * @Route("/{id}", name="common_userssession_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UsersSession $usersSession)
    {
        $form = $this->createDeleteForm($usersSession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($usersSession);
            $em->flush();
        }

        // print_r($usersSession); exit;

        return $this->redirectToRoute('common_userssession_index');
    }

    /**
     * Creates a form to delete a usersSession entity.
     *
     * @param UsersSession $usersSession The usersSession entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UsersSession $usersSession)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('common_userssession_delete', array('id' => $usersSession->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
