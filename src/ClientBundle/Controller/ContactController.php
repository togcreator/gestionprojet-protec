<?php

namespace ClientBundle\Controller;

use ClientBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ContactController extends Controller
{
    /**
     * Contact
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $bu_id = $this->container->get('session')->get('BU');

        $clients = $em->getRepository('UsersBundle:UserClient')->findContactsClient(0, $bu_id);
        return $this->render('ClientBundle:Default:contacts.html.twig', array('Contacts' => $clients));
    }
}