<?php

namespace UsersBundle\Controller\Back;

use UsersBundle\Entity\Back\UsersParamRelationsFonctions;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * UsersParamRelationsFonctions controller.
 *
 * @Route("user/paramrelationsfonctions")
 */
class UsersParamRelationsFonctionsController extends Controller
{
    /**
     * Lists all usersParamRelationsFonctions entities.
     *
     * @Route("/", name="usersparamrelationsfonctions_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usersParams = $em->getRepository('UsersBundle:Back\UsersParamRelationsFonctions')->findAll();

        return $this->render('UsersBundle:back/usersparamrelationsfonctions:index.html.twig', array(
            'usersParams' => $usersParams,
        ));
    }

    /**
     * Creates a new usersParam entity.
     *
     * @Route("/new", name="usersparamrelationsfonctions_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $usersParam = new UsersParamRelationsFonctions();
        $form = $this->createForm('UsersBundle\Form\Back\UsersParamRelationsFonctionsType', $usersParam, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /* version */
            $usersParam->setVersion(1);

            $em = $this->getDoctrine()->getManager();
            $em->persist($usersParam);
            $em->flush();

            return $this->redirectToRoute('usersparamrelationsfonctions_index');
        }

        return $this->render('UsersBundle:back/usersparamrelationsfonctions:new.html.twig', array(
            'usersParam' => $usersParam,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a usersParam entity.
     *
     * @Route("/{id}", name="usersparamrelationsfonctions_show")
     * @Method("GET")
     */
    public function showAction(UsersParamRelationsFonctions $usersParam)
    {
        $deleteForm = $this->createDeleteForm($usersParam);

        return $this->render('UsersBundle:back/usersparamrelationsfonctions:show.html.twig', array(
            'usersParam' => $usersParam,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing usersParam entity.
     *
     * @Route("/{id}/edit", name="usersparamrelationsfonctions_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UsersParamRelationsFonctions $usersParam)
    {
        $deleteForm = $this->createDeleteForm($usersParam);
        $editForm = $this->createForm('UsersBundle\Form\Back\UsersParamRelationsFonctionsType', $usersParam, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('usersparamrelationsfonctions_edit', array('id' => $usersParam->getId()));
        }

        return $this->render('UsersBundle:back/usersparamrelationsfonctions:edit.html.twig', array(
            'usersParam' => $usersParam,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a usersParam entity.
     *
     * @Route("/{id}", name="usersparamrelationsfonctions_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UsersParamRelationsFonctions $usersParam)
    {
        $form = $this->createDeleteForm($usersParam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($usersParam);
            $em->flush();
        }

        return $this->redirectToRoute('usersparamrelationsfonctions_index');
    }

    /**
     * Creates a form to delete a usersParam entity.
     *
     * @param UsersParamRelationsFonctions $usersParam The usersParam entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UsersParamRelationsFonctions $usersParam)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usersparamrelationsfonctions_delete', array('id' => $usersParam->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /* data form */
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'paramServices' =>  $em->getRepository('UsersBundle:Back\ParamServices')->findAll()
        ];
    }
}
