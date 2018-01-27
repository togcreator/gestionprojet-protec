<?php

namespace ClientBundle\Controller;

use ClientBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SrihController extends Controller
{
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();

        $id_bu = $session->get('BU');
        $bus = $em->getRepository('UsersBundle:BusinessUnit')->findOneBy(['id' => $id_bu]);

        if(!$bus) $id_bu = 0;
        else $id_bu = $bus->getId();

        $clients = $em->getRepository('UsersBundle:UserClient')->findSalarierParBU($id_bu);
        return $this->render('ClientBundle:Default:srih.html.twig', array('Srih' => $clients));
    }
}