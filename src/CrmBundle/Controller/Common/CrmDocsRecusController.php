<?php

namespace CrmBundle\Controller\Common;

use CrmBundle\Entity\Common\CrmDocsRecus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Crmdocsenvoye controller.
 *
 * @Route("crm/docsrecus")
 */
class CrmDocsRecusController extends Controller
{
    /**
     * Override method getUser parent
     *
     * @return UserClient
     */
    protected function getUser() {

        $auth_checker = $this->get('security.authorization_checker');
        if( $auth_checker->isGranted('ROLE_ADMIN') ) 
            return true;
        
        $user_id = parent::getUser()->getId();
        $bu_id = $this->container->get('session')->get('BU');
        return $this->getDoctrine()->getRepository('UsersBundle:UserClient')->findUserByCompte($bu_id, $user_id);
    }

    /**
     * Lists all crmDocsRecus entities.
     *
     * @Route("/", name="crmdocsrecus_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user_id = is_object($this->getUser()) ? $this->getUser()->getId() : null;
        $bu_id = $this->container->get('session')->get('BU');

        $criter = $request->get('idCRM') ? ['idCrm' => $request->get('idCRM')] : [];
        if( $request->get('idOperation') )
            $criter['idCrm'] = $request->get('idOperation');

        $crmDocsRecus = $em->getRepository('CrmBundle:Common\CrmDocsRecus')->findAllBy($criter, $user_id, $bu_id);
        if( $crmDocsRecus )
            foreach( $crmDocsRecus as &$recus ) {
                $recus->setCrm($em->getRepository('CrmBundle:Common\CrmDossier')->findOneBy(['id' => $recus->getIdCRM()]));
                $recus->setOperation($em->getRepository('CrmBundle:Common\CrmEtapesOperations')->findOneBy(['id' => $recus->getIdCRM()]));
            }

        return $this->render('CrmBundle:common/crmdocsrecus:index.html.twig', array(
            'crmDocsRecus' => $crmDocsRecus,
        ));
    }

    /**
     * Creates a new crmDocsRecus entity.
     *
     * @Route("/new", name="crmdocsrecus_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmDocsRecus = new CrmDocsRecus();

        /* pour crm */
        $idOperation = [];
        if( ($idCRM = $request->get('idCRM')) ) {
            //============ crm
            $crmDocsRecus->setIdCRM($idCRM);
            //============ opération
            $idOperation = array_map(function($obj){
                return $obj->getId();
            }, $this->getDoctrine()->getRepository('CrmBundle:Common\CrmEtapesOperations')->findBy(['idCRM' => $idCRM]));
        }
        $dataForm = $this->dataForm($idOperation);
        /* end of */

        $form = $this->createForm('CrmBundle\Form\Common\CrmDocsRecusType', $crmDocsRecus, ['dataForm' => $dataForm]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            /* pour code */
            \AppBundle\Entity\Classes\Utils::setCode($crmDocsRecus);

            // for doc
            $this->setDocument($crmDocsRecus);

            $em->persist($crmDocsRecus);
            $em->flush();

            return $this->redirectToRoute('crmdocsrecus_index');
        }

        return $this->render('CrmBundle:common/crmdocsrecus:new.html.twig', array(
            'crmDocsRecus' => $crmDocsRecus,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmDocsRecus entity.
     *
     * @Route("/{id}", name="crmdocsrecus_show")
     * @Method("GET")
     */
    public function showAction(CrmDocsRecus $crmDocsRecus)
    {
        $deleteForm = $this->createDeleteForm($crmDocsRecus);

        return $this->render('CrmBundle:common/crmdocsrecus:show.html.twig', array(
            'crmDocsRecus' => $crmDocsRecus,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmDocsRecus entity.
     *
     * @Route("/{id}/edit", name="crmdocsrecus_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmDocsRecus $crmDocsRecus)
    {
        $deleteForm = $this->createDeleteForm($crmDocsRecus);

        /* pour crm */
        $idOperation = [];
        if( ($idCRM = $request->get('idCRM')) ) {
            //============ crm
            $crmDocsRecus->setIdCRM($idCRM);
        }else 
            $idCRM = $crmDocsRecus->getIdCRM();

        //============ opération
        $idOperation = array_map(function($obj){
            return $obj->getId();
        }, $this->getDoctrine()->getRepository('CrmBundle:Common\CrmEtapesOperations')->findBy(['idCRM' => $idCRM]));
    
        $dataForm = $this->dataForm($idOperation);
        /* end of */

        // type document
        $type_file = '';
        $file = $this->getParameter('upload_dir') . DIRECTORY_SEPARATOR . 'document' . DIRECTORY_SEPARATOR . $crmDocsRecus->getNomDoc();
        if( is_file($file) )
            $type_file = mime_content_type($file);

        $editForm = $this->createForm('CrmBundle\Form\Common\CrmDocsRecusType', $crmDocsRecus, ['dataForm' => $dataForm]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            // for doc
            $this->setDocument($crmDocsRecus);

            // doctrine
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmDocsRecus);
            $em->flush();

            return $this->redirectToRoute('crmdocsrecus_edit', array('id' => $crmDocsRecus->getId()));
        }

        return $this->render('CrmBundle:common/crmdocsrecus:edit.html.twig', array(
            'crmDocsRecus' => $crmDocsRecus,
            'filetype' => $type_file,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmDocsRecus entity.
     *
     * @Route("/{id}", name="crmdocsrecus_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmDocsRecus $crmDocsRecus)
    {
        $form = $this->createDeleteForm($crmDocsRecus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // delete file
            $file = $this->getParameter('upload_dir') . DIRECTORY_SEPARATOR . 'document' . DIRECTORY_SEPARATOR . $crmDocsRecus->getNomDoc();
            if(is_file($file))
                @unlink($file);

            $em = $this->getDoctrine()->getManager();
            $em->remove($crmDocsRecus);
            $em->flush();
        }

        return $this->redirectToRoute('crmdocsrecus_index');
    }

    /**
     * Creates a form to delete a crmDocsRecus entity.
     *
     * @param CrmDocsRecus $crmDocsRecus The crmDocsRecus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmDocsRecus $crmDocsRecus)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmdocsrecus_delete', array('id' => $crmDocsRecus->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // dataForm
    private function dataForm ($idOp)
    {
        $em = $this->getDoctrine()->getManager();
        $user_id = is_object($this->getuser()) ? $this->getUser()->getId() : null;
        $bu_id = $this->container->get('session')->get('BU');
        
        return [
            'crms' => $em->getRepository('CrmBundle:Common\CrmDossier')->findAllBy($user_id, $bu_id),
            'operations' => $em->getRepository('CrmBundle:Common\CrmEtapesOperations')->findBy(['id' => $idOp])
        ];
    }

    // for doc
    private function setDocument ($crmDocsRecus)
    {
        $dir = $this->getParameter('upload_dir') . DIRECTORY_SEPARATOR . 'document';
        if( !is_dir($dir) && !mkdir($dir) ) 
            return;

        $doc = \AppBundle\Entity\Classes\Utils::Upload_file($crmDocsRecus->getNomDoc(), $dir);
        if( $doc )
            $crmDocsRecus->setNomDoc($doc);
    }
}
