<?php

namespace CrmBundle\Controller\Common;

use CrmBundle\Entity\Common\CrmDocsEnvoyes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Crmdocsenvoye controller.
 *
 * @Route("crm/docsenvoyes")
 */
class CrmDocsEnvoyesController extends Controller
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
     * Lists all crmDocsEnvoye entities.
     *
     * @Route("/", name="crmdocsenvoyes_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user_id = is_object($this->getuser()) ? $this->getUser()->getId() : null;
        $bu_id = $this->container->get('session')->get('BU');

        $criter = $request->get('idCRM') ? ['idCrm' => $request->get('idCRM')] : [];
        if( $request->get('idOperation') )
            $criter['idCrm'] = $request->get('idOperation');

        $crmDocsEnvoyes = $em->getRepository('CrmBundle:Common\CrmDocsEnvoyes')->findAllBy($criter, $user_id, $bu_id);
        if( $crmDocsEnvoyes )
            foreach( $crmDocsEnvoyes as &$envoye ) {
                $envoye->setCrm($em->getRepository('CrmBundle:Common\CrmDossier')->findOneBy(['id' => $envoye->getIdCrm()]));
                $envoye->setOperation($em->getRepository('CrmBundle:Common\CrmEtapesOperations')->findOneBy(['idCRM' => $envoye->getIdCrm()]));
            }


        return $this->render('CrmBundle:common/crmdocsenvoyes:index.html.twig', array(
            'crmDocsEnvoyes' => $crmDocsEnvoyes,
        ));
    }

    /**
     * Creates a new crmDocsEnvoye entity.
     *
     * @Route("/new", name="crmdocsenvoyes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $crmDocsEnvoye = new CrmDocsEnvoyes();

        /* pour crm */
        $idOperation = [];
        if( ($idCRM = $request->get('idCRM')) ) {
            //============ crm
            $crmDocsEnvoye->setIdCRM($idCRM);
            //============ opération
            $idOperation = array_map(function($obj){
                return $obj->getId();
            }, $em->getRepository('CrmBundle:Common\CrmEtapesOperations')->findBy(['idCRM' => $idCRM]));
        }
        $dataForm = $this->dataForm($idOperation);
        /* end of */

        $form = $this->createForm('CrmBundle\Form\Common\CrmDocsEnvoyesType', $crmDocsEnvoye, ['dataForm' => $dataForm]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // pour code
            \AppBundle\Entity\Classes\Utils::setCode($crmDocsEnvoye);

            // for doc
            $this->setDocument($crmDocsEnvoye);
            
            $em->persist($crmDocsEnvoye);
            $em->flush();

            return $this->redirectToRoute('crmdocsenvoyes_index');
        }

        return $this->render('CrmBundle:common/crmdocsenvoyes:new.html.twig', array(
            'crmDocsEnvoye' => $crmDocsEnvoye,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmDocsEnvoye entity.
     *
     * @Route("/{id}", name="crmdocsenvoyes_show")
     * @Method("GET")
     */
    public function showAction(CrmDocsEnvoyes $crmDocsEnvoye)
    {
        $deleteForm = $this->createDeleteForm($crmDocsEnvoye);

        return $this->render('CrmBundle:common/crmdocsenvoyes:show.html.twig', array(
            'crmDocsEnvoye' => $crmDocsEnvoye,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmDocsEnvoye entity.
     *
     * @Route("/{id}/edit", name="crmdocsenvoyes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmDocsEnvoyes $crmDocsEnvoye)
    {
        $deleteForm = $this->createDeleteForm($crmDocsEnvoye);

        //========== operation
        $idOperation = array_map(function($obj){
            return $obj->getId();
        }, $this->getDoctrine()->getRepository('CrmBundle:Common\CrmEtapesOperations')->findBy(['idCRM' => $crmDocsEnvoye->getIdCRM()]));

        /* pour crm */
        if( ($idCRM = $request->get('idCRM')) ) {
            //============ crm
            $crmDocsEnvoye->setIdCRM($idCRM);
            //============ opération
            $idOperation = array_map(function($obj){
                return $obj->getId();
            }, $this->getDoctrine()->getRepository('CrmBundle:Common\CrmEtapesOperations')->findBy(['idCRM' => $idCRM]));
        }
        $dataForm = $this->dataForm($idOperation);

        // type document
        $type_file = '';
        $file = $this->getParameter('upload_dir') . DIRECTORY_SEPARATOR . 'document' . DIRECTORY_SEPARATOR . $crmDocsEnvoye->getNomDoc();
        if( is_file($file) )
            $type_file = mime_content_type($file);

        //========== form
        $editForm = $this->createForm('CrmBundle\Form\Common\CrmDocsEnvoyesType', $crmDocsEnvoye, ['dataForm' => $this->dataForm($idOperation)]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // for doc
            $this->setDocument($crmDocsEnvoye);

            $em = $this->getDoctrine()->getManager();
            $em->persist($crmDocsEnvoye);
            $em->flush();

            return $this->redirectToRoute('crmdocsenvoyes_edit', array('id' => $crmDocsEnvoye->getId()));
        }

        return $this->render('CrmBundle:common/crmdocsenvoyes:edit.html.twig', array(
            'crmDocsEnvoye' => $crmDocsEnvoye,
            'filetype' => $type_file ? $type_file : '',
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmDocsEnvoye entity.
     *
     * @Route("/{id}", name="crmdocsenvoyes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmDocsEnvoyes $crmDocsEnvoye)
    {
        $form = $this->createDeleteForm($crmDocsEnvoye);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // delete file
            $file = $this->getParameter('upload_dir') . DIRECTORY_SEPARATOR . 'document' . DIRECTORY_SEPARATOR . $crmDocsEnvoye->getNomDoc();
            if(is_file($file))
                @unlink($file);

            $em = $this->getDoctrine()->getManager();
            $em->remove($crmDocsEnvoye);
            $em->flush();
        }

        return $this->redirectToRoute('crmdocsenvoyes_index');
    }

    /**
     * Creates a form to delete a crmDocsEnvoye entity.
     *
     * @param CrmDocsEnvoyes $crmDocsEnvoye The crmDocsEnvoye entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmDocsEnvoyes $crmDocsEnvoye)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmdocsenvoyes_delete', array('id' => $crmDocsEnvoye->getId())))
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
            'operations' => $em->getRepository('CrmBundle:Common\CrmEtapesOperations')->findBy(['id' => $idOp]),
        ];
    }

    /**
    * for doc
    */
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