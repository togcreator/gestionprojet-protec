<?php
/**
 * Created by PhpStorm.
 * User: Madatic dev3
 * Date: 04/09/2017
 * Time: 19:04
 */

namespace ClientBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListeCPController extends Controller
{
    public function listeCPAction() {
        return $this->render('ClientBundle:Default:cp.html.twig',array());
    }
    public function paginateAction(Request $req) {
        ignore_user_abort(true);
        /*$length = $req->get('length');
        $length = $length && ($length!=-1)?$length:0;

        $start = $req->get('start');
        $start = $length?($start && ($start!=-1)?$start:0)/$length:0;

        $search = $req->get('search');
        $filters = [ 'query' => @$search['value'] ];

        $cps = $this->getDoctrine()->getRepository('ClientBundle:CPFra')->search($filters, $start, $length);*/
        $cps = $this->getDoctrine()->getRepository('ClientBundle:CPFra')->findAll();

        $sortie = array(
            'data'            => array(),
            'recordsFiltered' => count($cps),
            'recordsTotal'    => count($cps)
        );

        foreach ($cps as $cp) {
            $sortie['data'][] = [
                'id'         => $cp->getId(),
                'code'       => $cp->getCode(),
                'ville'      => $cp->getVille(),
                'insee'      => $cp->getInsee(),
                'secteurGeo' => $cp->getSecteurGeo()
            ];
        }

        return new Response(json_encode($sortie), 200, [ 'Content-Type' => 'application/json']);
    }
}