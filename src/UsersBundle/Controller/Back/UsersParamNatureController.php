<?php

namespace UsersBundle\Controller\Back;

use UsersBundle\Entity\Back\UsersParamNature;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Usersparamnature controller.
 *
 * @Route("user/paramnature")
 */
class UsersParamNatureController extends Controller
{
    /**
     * Lists all usersParamNature entities.
     *
     * @Route("/", name="usersparamnature_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usersParamNatures = $em->getRepository('UsersBundle:Back\UsersParamNature')->findAll();

        return $this->render('UsersBundle:back/usersparamnature:index.html.twig', array(
            'usersParamNatures' => $usersParamNatures,
        ));
    }

    /**
     * Creates a new usersParamNature entity.
     *
     * @Route("/new", name="usersparamnature_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $usersParamNature = new Usersparamnature();
        $form = $this->createForm('UsersBundle\Form\Back\UsersParamNatureType', $usersParamNature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /* pour code */
            \AppBundle\Entity\Classes\Utils::setCode($usersParamNature);

            /* version */
            $usersParamNature->setVersion(1);

            $em = $this->getDoctrine()->getManager();
            $em->persist($usersParamNature);
            $em->flush();

            return $this->redirectToRoute('usersparamnature_index');
        }

        return $this->render('UsersBundle:back/usersparamnature:new.html.twig', array(
            'usersParamNature' => $usersParamNature,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a usersParamNature entity.
     *
     * @Route("/{id}", name="usersparamnature_show")
     * @Method("GET")
     */
    public function showAction(UsersParamNature $usersParamNature)
    {
        $deleteForm = $this->createDeleteForm($usersParamNature);

        return $this->render('UsersBundle:back/usersparamnature:show.html.twig', array(
            'usersParamNature' => $usersParamNature,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing usersParamNature entity.
     *
     * @Route("/{id}/edit", name="usersparamnature_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UsersParamNature $usersParamNature)
    {
        $deleteForm = $this->createDeleteForm($usersParamNature);
        $editForm = $this->createForm('UsersBundle\Form\Back\UsersParamNatureType', $usersParamNature);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($usersParamNature);
            $em->flush();

            return $this->redirectToRoute('usersparamnature_edit', array('id' => $usersParamNature->getId()));
        }

        return $this->render('UsersBundle:back/usersparamnature:edit.html.twig', array(
            'usersParamNature' => $usersParamNature,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a usersParamNature entity.
     *
     * @Route("/{id}", name="usersparamnature_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UsersParamNature $usersParamNature)
    {
        $form = $this->createDeleteForm($usersParamNature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($usersParamNature);
            $em->flush();
        }

        return $this->redirectToRoute('usersparamnature_index');
    }

    /**
     * Creates a form to delete a usersParamNature entity.
     *
     * @param UsersParamNature $usersParamNature The usersParamNature entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UsersParamNature $usersParamNature)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usersparamnature_delete', array('id' => $usersParamNature->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
