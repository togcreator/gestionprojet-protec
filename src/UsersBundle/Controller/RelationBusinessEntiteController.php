<?php

namespace UsersBundle\Controller;

use UsersBundle\Entity\RelationBusinessEntite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * RelationBusinessEntite controller.
 *
 * @Route("relation/businessentite")
 */
class RelationBusinessEntiteController extends Controller
{
    /**
     * Lists all relationBusinessEntite entities.
     *
     * @Route("/", name="relationbusinessentite_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bu_id = $this->container->get('session')->get('BU');
        $bu_id = $bu_id ? ['iDBusinessUnit' => $bu_id] : [];
        $relationBusinessEntites = $em->getRepository('UsersBundle:RelationBusinessEntite')->findBy($bu_id);
        if( $relationBusinessEntites ) 
            foreach( $relationBusinessEntites as &$relation )
                $relation->setRelationsProfessionnelles($em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findOneBy(['id' => $relation->getIDRelationsProfessionnelles()]));

        return $this->render('UsersBundle:relationbusinessentite:index.html.twig', array(
            'relationBusinessEntites' => $relationBusinessEntites,
        ));
    }

    /**
     * Creates a new relationBusinessEntite entity.
     *
     * @Route("/new", name="relationbusinessentite_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $relationBusinessEntite = new RelationBusinessEntite();
        $form = $this->createForm('UsersBundle\Form\RelationBusinessEntiteType', $relationBusinessEntite, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            /**
             * est si existe
             */
            $bu_id = $relationBusinessEntite->getIDBusinessUnit();
            $entite_id = $relationBusinessEntite->getIDentite();
            $pro_id = $relationBusinessEntite->getIDRelationsProfessionnelles();
            $rel = $em->getRepository('UsersBundle:RelationBusinessEntite')->findOneBy(['iDBusinessUnit' => $bu_id, 'iDentite' => $entite_id]);
            if( $rel ) {
                $relationBusinessEntite = $rel;
                $relationBusinessEntite->setIDRelationsProfessionnelles($pro_id);
            }

            //============================================
            $rp = $relationBusinessEntite->getIDRelationsProfessionnelles();
            $relationBusinessEntite->setRelationsProfessionnelles($em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findOneBy(['id' => $rp]));

            //============================================
            $bu = $relationBusinessEntite->getIDBusinessUnit();
            $relationBusinessEntite->setBusinessUnit($em->getRepository('UsersBundle:BusinessUnit')->findOneBy(['id' => $bu]));

            //============================================
            $ej = $relationBusinessEntite->getIDentite();
            $relationBusinessEntite->setEntite($em->getRepository('ClientBundle:Client')->findOneBy(['id' => $ej]));
            // 
            $em->persist($relationBusinessEntite);
            $em->flush();

            return $this->redirectToRoute('relationbusinessentite_index');
        }

        return $this->render('UsersBundle:relationbusinessentite:new.html.twig', array(
            'relationBusinessEntite' => $relationBusinessEntite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a relationBusinessEntite entity.
     *
     * @Route("/{id}", name="relationbusinessentite_show")
     * @Method("GET")
     */
    public function showAction(RelationBusinessEntite $relationBusinessEntite)
    {
        $deleteForm = $this->createDeleteForm($relationBusinessEntite);

        return $this->render('UsersBundle:relationbusinessentite:show.html.twig', array(
            'relationBusinessEntite' => $relationBusinessEntite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing relationBusinessEntite entity.
     *
     * @Route("/{id}/edit", name="relationbusinessentite_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, RelationBusinessEntite $relationBusinessEntite)
    {
        $deleteForm = $this->createDeleteForm($relationBusinessEntite);
        $editForm = $this->createForm('UsersBundle\Form\RelationBusinessEntiteType', $relationBusinessEntite, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //============================================
            $rp = $relationBusinessEntite->getIDRelationsProfessionnelles();
            $relationBusinessEntite->setRelationsProfessionnelles($em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findOneBy(['id' => $rp]));

            //============================================
            $bu = $relationBusinessEntite->getIDBusinessUnit();
            $relationBusinessEntite->setBusinessUnit($em->getRepository('UsersBundle:BusinessUnit')->findOneBy(['id' => $bu]));

            //============================================
            $ej = $relationBusinessEntite->getIDentite();
            $relationBusinessEntite->setEntite($em->getRepository('ClientBundle:Client')->findOneBy(['id' => $ej]));

            $em->persist($relationBusinessEntite);
            $em->flush();

            if( ($iDEntite = $request->get('iDEntite')) )
                return $this->redirectToRoute('client_update_client', ['id' => $iDEntite]);                

            return $this->redirectToRoute('relationbusinessentite_edit', array('id' => $relationBusinessEntite->getId()));
        }

        return $this->render('UsersBundle:relationbusinessentite:edit.html.twig', array(
            'relationBusinessEntite' => $relationBusinessEntite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a relationBusinessEntite entity.
     *
     * @Route("/{id}", name="relationbusinessentite_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, RelationBusinessEntite $relationBusinessEntite)
    {
        $form = $this->createDeleteForm($relationBusinessEntite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($relationBusinessEntite);
            $em->flush();
        }

        if( ($iDEntite = $request->get('iDEntite')) )
            return $this->redirectToRoute('client_update_client', ['id' => $iDEntite]);   

        return $this->redirectToRoute('relationbusinessentite_index');
    }

    /**
     * Creates a form to delete a relationBusinessEntite entity.
     *
     * @param RelationBusinessEntite $relationBusinessEntite The relationBusinessEntite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RelationBusinessEntite $relationBusinessEntite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('relationbusinessentite_delete', array('id' => $relationBusinessEntite->getId())))
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
            'relationsProfessionnelles' => $em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findBy(['IDNatureUser' => 2]),
            'businessunits' => $em->getRepository('UsersBundle:BusinessUnit')->findAll(),
            'entites' => $em->getRepository('ClientBundle:Client')->findAll(),
        ];
    }
}
