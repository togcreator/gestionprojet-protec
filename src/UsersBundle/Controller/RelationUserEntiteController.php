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
                $fonction = $em->getRepository('UsersBundle:Back\UsersParamRelationsFonctions')->findOneBy(['id' => $ue->getIDRelationFonctionnelle()]);
                if( $fonction ) {
                    $ue->setRelations_fonction($fonction);
                    $ue->setService($em->getRepository('UsersBundle:Back\ParamServices')->findOneBy(['id' => $fonction->getIDService()]));
                }
                
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
        $entite_id = $request->get('entite_id');
        if( $entite_id )
            $relationUserEntite->setIdEntiteJ($entite_id);

        $form = $this->createForm('UsersBundle\Form\RelationUserEntiteType', $relationUserEntite, ['dataForm' => $this->dataForm($entite_id)]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            /**
             * test is existe
             */
            $entite_id = $relationUserEntite->getIdEntiteJ();
            $user_id = $relationUserEntite->getIDUser();
            $r_bu_entite = $relationUserEntite->getIDUserEntite();
            $fonc_id = $relationUserEntite->getIDRelationFonctionnelle();
            $rel = $em->getRepository('UsersBundle:RelationUserEntite')->findOneBy(['iDUser' => $user_id, 'idEntiteJ' => $entite_id]);
            if( $rel ) 
            {
                $relationUserEntite = $rel;
                $relationUserEntite->setIDUserEntite($r_bu_entite);
                $relationUserEntite->setIDRelationFonctionnelle($fonc_id);
            }

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
        $entite_id = $request->get('entite_id');
        if( $entite_id )
            $relationUserEntite->setIdEntiteJ($entite_id);
        else
            $entite_id = $relationUserEntite->getIdEntiteJ();

        $editForm = $this->createForm('UsersBundle\Form\RelationUserEntiteType', $relationUserEntite, ['dataForm' => $this->dataForm($entite_id)]);
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
    private function dataForm ($entite_id = 0)
    {
        $em = $this->getDoctrine()->getManager();
        $iDUserEntites = ['global.none'  => 0];

        if( $entite_id ) 
        {
            $bu_id = $this->container->get('session')->get('BU');
            $criter = $bu_id ? ['iDBusinessUnit' => $bu_id] : [];
            $criter['iDentite'] = $entite_id;
            
            $iDUserEntite = $em->getRepository('UsersBundle:RelationBusinessEntite')->findBy($criter);
            foreach( $iDUserEntite as $rel ) {
                $relationsProfessionnelles = $em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findOneBy(['id' => $rel->getIDRelationsProfessionnelles()]);
                $iDUserEntites [ sprintf('%s - %s - %s', $rel->getBusinessunit()->getNomBusinessUnit(), $relationsProfessionnelles->getLabel(), $rel->getEntite()->getRaisonSociale()) ] = $rel->getId();
            }
        }

        return [
            'iDUserEntite' => $iDUserEntites,
            'entites' => $em->getRepository('ClientBundle:Client')->findAll(),
            'users' => $em->getRepository('UsersBundle:UserClient')->findContact(),
            'relations' => $em->getRepository('UsersBundle:RelationUserEntite')->findAll(),
            'relation_fonction' => $em->getRepository('UsersBundle:Back\UsersParamRelationsFonctions')->findAll()
        ];
    }
}
