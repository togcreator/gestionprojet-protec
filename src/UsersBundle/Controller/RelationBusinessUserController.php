<?php

namespace UsersBundle\Controller;

use UsersBundle\Entity\RelationBusinessUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Relationbusinessuser controller.
 *
 * @Route("relation/businessuser")
 */
class RelationBusinessUserController extends Controller
{
    /**
     * Lists all relationBusinessUser entities.
     *
     * @Route("/", name="relationbusinessuser_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $relationBusinessUsers = $em->getRepository('UsersBundle:RelationBusinessUser')->findByUser();
        if(count($relationBusinessUsers))
            foreach($relationBusinessUsers as &$relation) {
                $relation->setRelationsFonctionnelles($em->getRepository('UsersBundle:Back\UsersParamRelationsFonctions')->findOneBy(['id' => $relation->getIDRelationFonctionnelle()]));
            }

        return $this->render('UsersBundle:relationbusinessuser:index.html.twig', array(
            'relationBusinessUsers' => $relationBusinessUsers,
        ));
    }

    /**
     * Creates a new relationBusinessUser entity.
     *
     * @Route("/new", name="relationbusinessuser_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $relationBusinessUser = new RelationBusinessUser();
        $form = $this->createForm('UsersBundle\Form\RelationBusinessUserType', $relationBusinessUser, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //============================================
            $rf = $relationBusinessUser->getIDRelationFonctionnelle();
            $relationBusinessUser->setRelationsFonctionnelles($em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findOneBy(['id' => $rf]));

            //============================================
            $user_id = $relationBusinessUser->getIDUser();
            $relationBusinessUser->setUser($em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $user_id]));

            //============================================
            $bu_id = $relationBusinessUser->getIDBusinessUnit();
            $relationBusinessUser->setBusinessUnit($em->getRepository('UsersBundle:BusinessUnit')->findOneBy(['id' => $bu_id]));

            $em->persist($relationBusinessUser);
            $em->flush();

            return $this->redirectToRoute('relationbusinessuser_index');
        }

        return $this->render('UsersBundle:relationbusinessuser:new.html.twig', array(
            'relationBusinessUser' => $relationBusinessUser,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a relationBusinessUser entity.
     *
     * @Route("/{id}", name="relationbusinessuser_show")
     * @Method("GET")
     */
    public function showAction(RelationBusinessUser $relationBusinessUser)
    {
        $deleteForm = $this->createDeleteForm($relationBusinessUser);

        return $this->render('UsersBundle:relationbusinessuser:show.html.twig', array(
            'relationBusinessUser' => $relationBusinessUser,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing relationBusinessUser entity.
     *
     * @Route("/{id}/edit", name="relationbusinessuser_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, RelationBusinessUser $relationBusinessUser)
    {
        $deleteForm = $this->createDeleteForm($relationBusinessUser);
        $editForm = $this->createForm('UsersBundle\Form\RelationBusinessUserType', $relationBusinessUser, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //============================================
            $rf = $relationBusinessUser->getIDRelationFonctionnelle();
            $relationBusinessUser->setRelationsFonctionnelles($em->getRepository('UsersBundle:Back\UsersParamRelationsFonctions')->findOneBy(['id' => $rf]));

            //============================================
            $user_id = $relationBusinessUser->getIDUser();
            $relationBusinessUser->setUser($em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $user_id]));

            //============================================
            $bu_id = $relationBusinessUser->getIDBusinessUnit();
            $relationBusinessUser->setBusinessunit($em->getRepository('UsersBundle:BusinessUnit')->findOneBy(['id' => $bu_id]));
            
            $em->persist($relationBusinessUser);
            $em->flush();

            return $this->redirectToRoute('relationbusinessuser_edit', array('id' => $relationBusinessUser->getId()));
        }

        return $this->render('UsersBundle:relationbusinessuser:edit.html.twig', array(
            'relationBusinessUser' => $relationBusinessUser,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a relationBusinessUser entity.
     *
     * @Route("/{id}", name="relationbusinessuser_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, RelationBusinessUser $relationBusinessUser)
    {
        $form = $this->createDeleteForm($relationBusinessUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($relationBusinessUser);
            $em->flush();
        }

        return $this->redirectToRoute('relationbusinessuser_index');
    }

    /**
     * Creates a form to delete a relationBusinessUser entity.
     *
     * @param RelationBusinessUser $relationBusinessUser The relationBusinessUser entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RelationBusinessUser $relationBusinessUser)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('relationbusinessuser_delete', array('id' => $relationBusinessUser->getId())))
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
            'relationsFonctionnelles' => $em->getRepository('UsersBundle:Back\UsersParamRelationsFonctions')->findAll(),
            'users' => $em->getRepository('UsersBundle:UserClient')->findEmploye(),
            'businessunits' => $em->getRepository('UsersBundle:BusinessUnit')->findAll()
        ];
    }
}
