<?php
/**
 * Created by PhpStorm.
 * User: Madatic dev3
 * Date: 04/09/2017
 * Time: 20:50
 */

namespace ClientBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeleteClientController extends Controller
{
    public function deleteAction($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $clientDepot = $this->getDoctrine()->getRepository('ClientBundle:Client');
        $client = $clientDepot->find($id);
        $entityManager->remove($client);
        $entityManager->flush();
        return $this->redirectToRoute('client_liste_clients', array("delete" => "ok"));
    }
}