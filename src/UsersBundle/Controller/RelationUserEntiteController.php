<?php

namespace UsersBundle\Controller;

use UsersBundle\Entity\RelationUserEntite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Relationuserentite controller.
 *
 * @Route("relation/userentite")
 */
class RelationUserEntiteController extends Controller
{
    /**
     * Lists all relationUserEntite entities.
     *
     * @Route("/", name="relationuserentite_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $relationUserEntites = $em->getRepository('UsersBundle:RelationUserEntite')->findByUser();
        if(count($relationUserEntites))
            foreach($relationUserEntites as &$ue) {
                $ue->setRelations_fonction($em->getRepository('UsersBundle:Back\UsersParamRelationsFonctions')->findOneBy(['id' => $ue->getIDRelationFonctionnelle()]));
            }


        return $this->render('UsersBundle:relationuserentite:index.html.twig', array(
            'relationUserEntites' => $relationUserEntites,
        ));
    }

    /**
     * Creates a new relationUserEntite entity.
     *
     * @Route("/new", name="relationuserentite_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $relationUserEntite = new RelationUserEntite();
        $form = $this->createForm('UsersBundle\Form\RelationUserEntiteType', $relationUserEntite, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //============================================
            $ij = $relationUserEntite->getIdEntiteJ();
            $relationUserEntite->setEntite($em->getRepository('ClientBundle:Client')->findOneBy(['id' => $ij]));

            //============================================
            $user_id = $relationUserEntite->getIDUser();
            $relationUserEntite->setUser($em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $user_id]));

            //============================================
            $entite_id = $relationUserEntite->getIDUserEntite();
            $relationUserEntite->setRelations($em->getRepository('UsersBundle:RelationBusinessEntite')->findOneBy(['id' => $entite_id]));

            $em->persist($relationUserEntite);
            $em->flush();

            return $this->redirectToRoute('relationuserentite_index');
        }

        return $this->render('UsersBundle:relationuserentite:new.html.twig', array(
            'relationUserEntite' => $relationUserEntite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a relationUserEntite entity.
     *
     * @Route("/{id}", name="relationuserentite_show")
     * @Method("GET")
     */
    public function showAction(RelationUserEntite $relationUserEntite)
    {
        $deleteForm = $this->createDeleteForm($relationUserEntite);

        return $this->render('UsersBundle:relationuserentite:show.html.twig', array(
            'relationUserEntite' => $relationUserEntite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing relationUserEntite entity.
     *
     * @Route("/{id}/edit", name="relationuserentite_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, RelationUserEntite $relationUserEntite)
    {
        $deleteForm = $this->createDeleteForm($relationUserEntite);
        $editForm = $this->createForm('UsersBundle\Form\RelationUserEntiteType', $relationUserEntite, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //============================================
            $ij = $relationUserEntite->getIdEntiteJ();
            $relationUserEntite->setEntitej($em->getRepository('ProjectBundle:Back\EntityJ')->findOneBy(['id' => $ij]));

            //============================================
            $user_id = $relationUserEntite->getIDUser();
            $relationUserEntite->setUser($em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $user_id]));

            //============================================
            $entite_id = $relationUserEntite->getIDUserEntite();
            $relationUserEntite->setRelations($em->getRepository('UsersBundle:RelationBusinessEntite')->findOneBy(['id' => $entite_id]));
            
            $em->persist($relationUserEntite);
            $em->flush();

            return $this->redirectToRoute('relationuserentite_edit', array('id' => $relationUserEntite->getId()));
        }

        return $this->render('UsersBundle:relationuserentite:edit.html.twig', array(
            'relationUserEntite' => $relationUserEntite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a relationUserEntite entity.
     *
     * @Route("/{id}", name="relationuserentite_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, RelationUserEntite $relationUserEntite)
    {
        $form = $this->createDeleteForm($relationUserEntite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($relationUserEntite);
            $em->flush();
        }

        return $this->redirectToRoute('relationuserentite_index');
    }

    /**
     * Creates a form to delete a relationUserEntite entity.
     *
     * @param RelationUserEntite $relationUserEntite The relationUserEntite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RelationUserEntite $relationUserEntite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('relationuserentite_delete', array('id' => $relationUserEntite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
    * Data Form
    * 
    * @return Array
    */
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'entites' => $em->getRepository('ClientBundle:Client')->findAll(),
            'users' => $em->getRepository('UsersBundle:UserClient')->findContact(),
            'relations' => $em->getRepository('UsersBundle:RelationUserEntite')->findAll(),
            'relation_fonction' => $em->getRepository('UsersBundle:Back\UsersParamRelationsFonctions')->findAll()
        ];
    }
}
