<?php

namespace CrmBundle\Controller\Back;

use CrmBundle\Entity\Back\CrmParamCyclesDetails;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Crmparamactivity controller.
 *
 * @Route("crm/paramcyclesdetails")
 */
class CrmParamCyclesDetailsController extends Controller
{
    /**
     * Lists all crmParamCyclesDetails entities.
     *
     * @Route("/", name="crmparamcyclesdetails_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $crmParamCyclesDetails = $em->getRepository('CrmBundle:Back\CrmParamCyclesDetails')->findAll();

        // pas vide
        if( count($crmParamCyclesDetails) )
            foreach( $crmParamCyclesDetails as $detail ) {
                // cycle
                $detail->setCycle($em->getRepository('CrmBundle:Back\CrmParamCycles')->findOneBy(['id' => $detail->getIdCycle()]));
                // type cycle
                $detail->setTypecycle($em->getRepository('CrmBundle:Back\CrmParamCyclesType')->findOneBy(['id' => $detail->getIdTypecycle()]));
            }   

        return $this->render('CrmBundle:back/crmparamcyclesdetails:index.html.twig', array(
            'crmParamCyclesDetails' => $crmParamCyclesDetails,
        ));
    }

    /**
     * Creates a new crmParamCyclesDetails entity.
     *
     * @Route("/new", name="crmparamcyclesdetails_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $crmParamCyclesDetails = new CrmParamCyclesDetails();
            
        //cycle
        $dataForm = $this->setCycle($request, $crmParamCyclesDetails);

        $form = $this->createForm('CrmBundle\Form\Back\CrmParamCyclesDetailsType', $crmParamCyclesDetails, ['dataForm' => $dataForm]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($crmParamCyclesDetails);
            $em->flush();

            return $this->redirectToRoute('crmparamcyclesdetails_index');
        }

        return $this->render('CrmBundle:back/crmparamcyclesdetails:new.html.twig', array(
            'crmParamCyclesDetails' => $crmParamCyclesDetails,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmParamCyclesDetails entity.
     *
     * @Route("/{id}", name="crmparamcyclesdetails_show")
     * @Method("GET")
     */
    public function showAction(CrmParamCyclesDetails $crmParamCyclesDetails)
    {
        $deleteForm = $this->createDeleteForm($crmParamCyclesDetails);

        return $this->render('CrmBundle:back/crmparamcyclesdetails:show.html.twig', array(
            'crmParamCyclesDetails' => $crmParamCyclesDetails,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmParamCyclesDetails entity.
     *
     * @Route("/{id}/edit", name="crmparamcyclesdetails_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmParamCyclesDetails $crmParamCyclesDetails)
    {
        $deleteForm = $this->createDeleteForm($crmParamCyclesDetails);
        $editForm = $this->createForm('CrmBundle\Form\Back\CrmParamCyclesDetailsType', $crmParamCyclesDetails, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('crmparamcyclesdetails_edit', array('id' => $crmParamCyclesDetails->getId()));
        }

        return $this->render('CrmBundle:back/crmparamcyclesdetails:edit.html.twig', array(
            'crmParamCyclesDetails' => $crmParamCyclesDetails,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmParamCyclesDetails entity.
     *
     * @Route("/{id}", name="crmparamcyclesdetails_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmParamCyclesDetails $crmParamCyclesDetails)
    {
        $form = $this->createDeleteForm($crmParamCyclesDetails);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmParamCyclesDetails);
            $em->flush();
        }

        return $this->redirectToRoute('crmparamcyclesdetails_index');
    }

    /**
     * Creates a form to delete a crmParamCyclesDetails entity.
     *
     * @param CrmParamCyclesDetails $crmParamCyclesDetails The crmParamCyclesDetails entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmParamCyclesDetails $crmParamCyclesDetails)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmparamcyclesdetails_delete', array('id' => $crmParamCyclesDetails->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    private function setCycle(Request $request, $crmParamCyclesDetails) {

        $id_cycle = 0;
        if( ($idTypeCycle = $request->get('idTypeCycle')) ) 
        {
            $typeCycles = $em->getRepository('CrmBundle:Back\CrmParamCyclesType')->fdinOneBy(['id' => $idTypeCycle]);
            if($typeCycles) {
                $id_cycle = $typeCycles->getId();
                $crmParamCyclesDetails->setIdTypecycle($typeCycles->getId());
            }
        }
        // return $this->dataForm($id_cycle);
        return $this->dataForm();
    }

    // dataForm
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'cycles' => $em->getRepository('CrmBundle:Back\CrmParamCycles')->findAll(),
            'typecycles' => $em->getRepository('CrmBundle:Back\CrmParamCyclesType')->findBy(['ouvert' => 1]),
        ];
    }

}
