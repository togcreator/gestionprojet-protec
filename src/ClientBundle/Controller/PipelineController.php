<?php

namespace ClientBundle\Controller;

use ClientBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class PipelineController extends Controller
{
    /**
     * Pipeline Cycle detail
     */
    public function getCycleDetail ($com) {
        $ret = [
            'cycle_details' => [],
            'byDetails' => []
        ];

        $em = $this->getDoctrine()->getManager();
        $selective = isset($com['id_owner']) && $com['id_owner'] ? ['idOwner' => $com['id_owner']] : ['idWatcher' => $com['id_watcher']];

        $crms = $em->getRepository('CrmBundle:Common\CrmDossier')->findBy($selective);
        foreach( $crms as $crm ) {

            $operations = $em->getRepository('CrmBundle:Common\CrmEtapesOperations')->findBy(['idCRM' => $crm->getId()]);
            if(count($operations)) {
                foreach($operations as $operation) {

                    $cycle_detail = $em->getRepository('CrmBundle:Back\CrmParamCyclesDetails')->findOneBy(['id' => $operation->getIdCycledetail()]);
                    $cycle_type = $em->getRepository('CrmBundle:Back\CrmParamCyclesType')->findOneBy(['id' => $cycle_detail->getIdTypecycle()]);
                    if(!$cycle_type) continue;

                    $id_tcycle = $cycle_type->getId();

                    $ret['cycle_details'][$id_tcycle] = $cycle_type;

                    if(!count($ret['byDetails'])) $ret['byDetails'] = [];
                    if(!isset($ret['byDetails'][$crm->getId()])) 
                        $ret['byDetails'][$crm->getId()] = [];

                    if(!isset($ret['byDetails'][$crm->getId()][$id_tcycle])) 
                        $ret['byDetails'][$crm->getId()][$id_tcycle] = [];
                    
                    $crm->setEntite($em->getRepository('ClientBundle:Client')->findOneBy(['id' => $crm->getIdEntiteJ()]));
                    $operation->setCrm($crm);

                    $doc_envoye = $em->getRepository('CrmBundle:Common\CrmDocsEnvoyes')->findBy(['idOperation' => $operation->getId()]);
                    $doc_recus = $em->getRepository('CrmBundle:Common\CrmDocsRecus')->findBy(['idOperation' => $operation->getId()]);
                    $operation->setDocs(count($doc_envoye) + count($doc_recus));
                    $ret['byDetails'][$crm->getId()][$id_tcycle][] = $operation;
                }
            }
        }

        // return
        return $ret;
    }

    /**
     * Pipeline Ajax
     */
    public function pipelineAjaxAction(Request $request) {

        $com = $request->get('id_owner') ? ['id_owner' => $request->get('id_owner')] : ['id_watcher' => $request->get('id_watcher')];

        return $this->render('ClientBundle:Default:column.html.twig', ['Cycles' => $this->getCycleDetail($com)]);   
    }

    /**
     * Pipeline attach
     */
    public function pipelineAttachAction(Request $request) {
        // id opération
        $id = $request->get('id'); 

        if( !$id ) return;
        $em = $this->getDoctrine()->getManager();

        // opération
        $operation = $em->getRepository('CrmBundle:Common\CrmEtapesOperations')->findOneBy(['id' => $id]);
        $doc_envoye = [];
        $doc_recus = [];
        if( count($operation) ) {
            $doc_envoye = $em->getRepository('CrmBundle:Common\CrmDocsEnvoyes')->findBy(['idOperation' => $operation->getId()]);
            $doc_recus = $em->getRepository('CrmBundle:Common\CrmDocsRecus')->findBy(['idOperation' => $operation->getId()]);
        }

        return $this->render('ClientBundle:Default:pipeline_attach.html.twig', ['envoyes' => $doc_envoye, 'recus' => $doc_recus]);  
    }

    /**
     * Pipeline Index
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $watchers = $em->getRepository('UsersBundle:UserClient')->findSalarierCom([13]);
        $owners =  $em->getRepository('UsersBundle:UserClient')->findSalarierCom([10]);

        return $this->render('ClientBundle:Default:pipeline.html.twig', ['Owners' => $owners, 'Watchers' => $watchers]);
    }
}