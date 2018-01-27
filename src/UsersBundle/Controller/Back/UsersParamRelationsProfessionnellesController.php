<?php

namespace UsersBundle\Controller\Back;

use UsersBundle\Entity\Back\UsersParamRelationsProfessionnelles;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * UsersParamRelationsProfessionnelles controller.
 *
 * @Route("user/paramrelationsprofessionnelles")
 */
class UsersParamRelationsProfessionnellesController extends Controller
{
    /**
     * Lists all usersParamRelationsFonctions entities.
     *
     * @Route("/", name="usersparamrelationsprofessionnelles_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usersParams = $em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findAll();

        return $this->render('UsersBundle:back/usersparamrelationsprofessionnelles:index.html.twig', array(
            'usersParams' => $usersParams,
        ));
    }

    /**
     * Creates a new usersParam entity.
     *
     * @Route("/new", name="usersparamrelationsprofessionnelles_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $usersParam = new UsersParamRelationsProfessionnelles();
        $form = $this->createForm('UsersBundle\Form\Back\UsersParamRelationsProfessionnellesType', $usersParam, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /* entity manager */
            $em = $this->getDoctrine()->getManager();
            /* version */
            $usersParam->setVersion(1);
            /* pour nature user */
            $nature = $em->getRepository('UsersBundle:Back\UsersParamNature')->findOneBy(['id' => $usersParam->getIDNatureUser()]);
            $usersParam->setNatureUser($nature);
            
            $em->persist($usersParam);
            $em->flush();

            return $this->redirectToRoute('usersparamrelationsprofessionnelles_index');
        }

        return $this->render('UsersBundle:back/usersparamrelationsprofessionnelles:new.html.twig', array(
            'usersParam' => $usersParam,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a usersParam entity.
     *
     * @Route("/{id}", name="usersparamrelationsprofessionnelles_show")
     * @Method("GET")
     */
    public function showAction(UsersParamRelationsProfessionnelles $usersParam)
    {
        $deleteForm = $this->createDeleteForm($usersParam);

        return $this->render('UsersBundle:back/usersparamrelationsprofessionnelles:show.html.twig', array(
            'usersParam' => $usersParam,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing usersParam entity.
     *
     * @Route("/{id}/edit", name="usersparamrelationsprofessionnelles_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UsersParamRelationsProfessionnelles $usersParam)
    {
        $deleteForm = $this->createDeleteForm($usersParam);
        $editForm = $this->createForm('UsersBundle\Form\Back\UsersParamRelationsProfessionnellesType', $usersParam, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        // dump($usersParam); exit;

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('usersparamrelationsprofessionnelles_edit', array('id' => $usersParam->getId()));
        }

        return $this->render('UsersBundle:back/usersparamrelationsprofessionnelles:edit.html.twig', array(
            'usersParam' => $usersParam,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a usersParam entity.
     *
     * @Route("/{id}", name="usersparamrelationsprofessionnelles_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UsersParamRelationsProfessionnelles $usersParam)
    {
        $form = $this->createDeleteForm($usersParam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($usersParam);
            $em->flush();
        }

        return $this->redirectToRoute('usersparamrelationsprofessionnelles_index');
    }

    /**
     * Creates a form to delete a usersParam entity.
     *
     * @param UsersParamRelationsProfessionnelles $usersParam The usersParam entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UsersParamRelationsProfessionnelles $usersParam)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usersparamrelationsprofessionnelles_delete', array('id' => $usersParam->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // data form
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'natures' => $em->getRepository('UsersBundle:Back\UsersParamNature')->findAll()
        ];
    }
}
