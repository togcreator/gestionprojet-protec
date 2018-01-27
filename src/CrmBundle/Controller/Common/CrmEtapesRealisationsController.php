<?php

namespace CrmBundle\Controller\Common;

use CrmBundle\Entity\Common\CrmEtapesRealisations;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Crmetapesrealisation controller.
 *
 * @Route("crm/etapesrealisations")
 */
class CrmEtapesRealisationsController extends Controller
{
    /**
     * Lists all crmEtapesRealisation entities.
     *
     * @Route("/", name="crmetapesrealisations_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $crmEtapesRealisations = $em->getRepository('CrmBundle:Common\CrmEtapesRealisations')->findAll();
        if( $crmEtapesRealisations )
            foreach( $crmEtapesRealisations as &$realisation )
                $realisation->setCrm($em->getRepository('CrmBundle:Common\CrmDossier')->findOneBy(['id' => $realisation->getIdCRM()]));


        return $this->render('CrmBundle:common/crmetapesrealisations:index.html.twig', array(
            'crmEtapesRealisations' => $crmEtapesRealisations,
        ));
    }

    /**
     * Creates a new crmEtapesRealisation entity.
     *
     * @Route("/new", name="crmetapesrealisations_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmEtapesRealisation = new CrmEtapesRealisations();
        $em = $this->getDoctrine()->getManager();
        $dataForm = $this->dataForm();
        
        /* pour projet */
        if( ($idCRM = $request->get('idCRM')) ) {
            /* pour setter idCRMVersion */
            $crmEtapesRealisation->setIdCRM($idCRM);

            /* pour l'étape du projet e question */
            $etapes = $em->getRepository('CrmBundle:Common\CrmEtapes')->findBy(['idCRM' => $idCRM]);
            $dataForm['etapes'] = $etapes;
        }
        /* end of */

        $form = $this->createForm('CrmBundle\Form\Common\CrmEtapesRealisationsType', $crmEtapesRealisation, ['dataForm' => $dataForm]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($crmEtapesRealisation);
            $em->flush();

            return $this->redirectToRoute('crmetapesrealisations_index');
        }

        return $this->render('CrmBundle:common/crmetapesrealisations:new.html.twig', array(
            'crmEtapesRealisation' => $crmEtapesRealisation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmEtapesRealisation entity.
     *
     * @Route("/{id}", name="crmetapesrealisations_show")
     * @Method("GET")
     */
    public function showAction(CrmEtapesRealisations $crmEtapesRealisation)
    {
        $deleteForm = $this->createDeleteForm($crmEtapesRealisation);

        return $this->render('CrmBundle:common/crmetapesrealisations:show.html.twig', array(
            'crmEtapesRealisation' => $crmEtapesRealisation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmEtapesRealisation entity.
     *
     * @Route("/{id}/edit", name="crmetapesrealisations_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmEtapesRealisations $crmEtapesRealisation)
    {
        $deleteForm = $this->createDeleteForm($crmEtapesRealisation);
        $editForm = $this->createForm('CrmBundle\Form\Common\CrmEtapesRealisationsType', $crmEtapesRealisation, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('crmetapesrealisations_edit', array('id' => $crmEtapesRealisation->getId()));
        }

        return $this->render('CrmBundle:common/crmetapesrealisations:edit.html.twig', array(
            'crmEtapesRealisation' => $crmEtapesRealisation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmEtapesRealisation entity.
     *
     * @Route("/{id}", name="crmetapesrealisations_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmEtapesRealisations $crmEtapesRealisation)
    {
        $form = $this->createDeleteForm($crmEtapesRealisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmEtapesRealisation);
            $em->flush();
        }

        return $this->redirectToRoute('crmetapesrealisations_index');
    }

    /**
     * Creates a form to delete a crmEtapesRealisation entity.
     *
     * @param CrmEtapesRealisations $crmEtapesRealisation The crmEtapesRealisation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmEtapesRealisations $crmEtapesRealisation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmetapesrealisations_delete', array('id' => $crmEtapesRealisation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // dataForm
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'crms' => $em->getRepository('CrmBundle:Common\CrmDossier')->findAll(),
            'etapes' => $em->getRepository('CrmBundle:Common\CrmEtapes')->findAll(),
            'resultats' => $em->getRepository('CrmBundle:Back\CrmParamResultat')->findAll(),
            'statuts' => $em->getRepository('CrmBundle:Back\CrmParamStatut')->findAll(),
            'users' => $em->getRepository('UsersBundle:UserClient')->findEmploye(),
        ];
    }
}
