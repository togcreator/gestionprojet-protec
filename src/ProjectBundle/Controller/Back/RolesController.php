<?php

namespace ProjectBundle\Controller\Back;

use ProjectBundle\Entity\Back\Roles;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Role controller.
 *
 * @Route("back/roles")
 */
class RolesController extends Controller
{
    /**
     * Lists all role entities.
     *
     * @Route("/", name="back_roles_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $roles = $em->getRepository('ProjectBundle:Back\Roles')->findAll();

        return $this->render('ProjectBundle:back\roles:index.html.twig', array(
            'roles' => $roles,
        ));
    }

    /**
     * Creates a new role entity.
     *
     * @Route("/new", name="back_roles_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $role = new Roles();
        $form = $this->createForm('ProjectBundle\Form\Back\RolesType', $role, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // imgcouleur
            $role->setImgcouleur($this->upload_file($role->getImgcouleur()));
            // img
            $role->setLogo($this->upload_file($role->getLogo()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($role);
            $em->flush();

            return $this->redirectToRoute('back_roles_edit', ['id' => $role->getId()]);
        }

        return $this->render('ProjectBundle:back\roles:new.html.twig', array(
            'role' => $role,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a role entity.
     *
     * @Route("/{id}", name="back_roles_show")
     * @Method("GET")
     */
    public function showAction(Roles $role)
    {
        $deleteForm = $this->createDeleteForm($role);

        return $this->render('ProjectBundle:back\roles:show.html.twig', array(
            'role' => $role,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing role entity.
     *
     * @Route("/{id}/edit", name="back_roles_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Roles $role)
    {
        $em = $this->getDoctrine()->getManager();
        // // listing the user to roles
        // $users = $em->getRepository('UsersBundle:Users')->findAll();
        // $role->setUser($users); // setting to user

        $deleteForm = $this->createDeleteForm($role);
        $editForm = $this->createForm('ProjectBundle\Form\Back\RolesType', $role, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // imgcouleur
            $this->upload_file($role->getImgcouleur());

            // logo
            $this->upload_file($role->getLogo());

            // getting to setting type to user
            // $this->setTypeToUser($role->getUser(), $role->getId());

            $em->flush();

            return $this->redirectToRoute('back_roles_edit', array('id' => $role->getId()));
        }

        return $this->render('ProjectBundle:back\roles:edit.html.twig', array(
            'role' => $role,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a role entity.
     *
     * @Route("/{id}", name="back_roles_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Roles $role)
    {
        $form = $this->createDeleteForm($role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($role);
            $em->flush();
        }

        return $this->redirectToRoute('back_roles_index');
    }

    /**
     * Creates a form to delete a role entity.
     *
     * @param Roles $role The role entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Roles $role)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('back_roles_delete', array('id' => $role->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // dataForm
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'users' => $em->getRepository('UsersBundle:Users')->findAll()
        ];
    }

    // type to user
    private function setTypeToUser ($roles_users, $roles_id)
    {
        if( !count($roles_users) ) return;
        $em = $this->getDoctrine()->getManager();

        // erase for exist data
        $users = $em->getRepository('UsersBundle:Users')->findBy(['type' => $roles_id]);
        if( count($users) )
            foreach( $users as $user )
                if( !in_array($user->getId(), $roles_users) ) { /** if not inside change to 0 **/
                    $user->setType(0); // setting roles id
                    $em->persist($user);
                    $em->flush(); // update it
                }

        // adding and/or updating
        $users = $em->getRepository('UsersBundle:Users')->findBy(['id' => $roles_users]);
        if(!count($users)) return;
        foreach ($users as $user)
        {
            $user->setType($roles_id); // setting roles id
            $em->persist($user);
            $em->flush(); // update it
        }
    }

    // pour les fichiers
    private function upload_file ($file) {
        $img = \AppBundle\Entity\Classes\Utils::Upload_file($file, $this->getParameter('upload_dir'));
        if( $img )
            return $img;
    }
}
