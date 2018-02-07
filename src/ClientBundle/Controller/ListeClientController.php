<?php
/**
 * Created by PhpStorm.
 * User: Madatic dev3
 * Date: 04/09/2017
 * Time: 19:01
 */

namespace ClientBundle\Controller;

use ClientBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListeClientController extends Controller
{
    /**
    * Override method getUser parent
    *
    * @return UserClient
    */
    protected function getUser() {
        //==============================================
        // $user = parent::getUser();
        $session_id = $this->container->get('session')->get('log');
        $bu_id = $this->container->get('session')->get('BU');
        $manager = $this->getDoctrine()->getManager();
        $login = $manager->getRepository('UsersBundle:Users')->findOneBy(['id' => $session_id]);
        $iDCompte = $login ? $login->getIDCompte() : null;
        $return = $manager->getRepository('UsersBundle:UserClient')->findBBU($iDCompte, $bu_id, true);

       return $return;
    }

    public function paginateAction(Request $req) {
        /*$length = $req->get('length');
        $length = $length && ($length!=-1)?$length:0;

        $start = $req->get('start');
        $start = $length?($start && ($start!=-1)?$start:0)/$length:0;

        $search = $req->get('search');
        $filters = [ 'query' => @$search['value'] ]; 

        $clients = $this->getDoctrine()->getRepository('ClientBundle:Client')->search($filters, $start, $length);*/
        $clients = $this->getDoctrine()->getRepository('ClientBundle:Client')->findAll();

        $sortie = array(
            'data'            => array(),
            'recordsFiltered' => count($clients),
            'recordsTotal'    => $this->getDoctrine()->getRepository('ClientBundle:Client')->count(array())
        );

        foreach ($clients as $client) {
            $villeCP = $client->getVille()." - ".$client->getCP();
            $sortie['data'][] = [
                'id'            => $client->getId(),
                'idGroupe'      => $client->getIdGroupe(),
                'ville_cp'      => $villeCP,
                'raisonSociale' => $client->getRaisonSociale(),
                'adr1'          => $client->getAdr1(),
                'tel_gsm'       => "Tel : ".$client->getTel()."<br/>GSM : ".$client->getGsm(),
                ''
            ];
        }

        return new Response(json_encode($sortie), 200, [ 'Content-Type' => 'application/json']);
    }

    
    public function listeClientAction() {

        $em = $this->getDoctrine()->getManager();
        $bu_id = $this->container->get('session')->get('BU');
        $clients = $em->getRepository('ClientBundle:Client')->findByBU(null, $bu_id);

        $return = [];
        if($clients) {
            foreach($clients as $key => &$client)
                if( isset($client[0]) ) {
                    $client[0]->setRelationsProfessionnelles($em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findOneBy(['id' => (int)$client[0]->getIDRelationsProfessionnelles()]));
                }
        }
        return $this->render('ClientBundle:Default:clients.html.twig', array('clients' => $clients));
    }
}