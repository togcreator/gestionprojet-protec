<?php

namespace ClientBundle\Controller;

use ClientBundle\Entity\Client;
use ClientBundle\Entity\ClientFilter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FilterClientController extends Controller
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
        $return = $manager->getRepository('UsersBundle:UserClient')->findBBU($login->getUsername(), $bu_id, true);

       return $return;
    }

	/**
	* index page
	*/
	public function indexAction (Request $request) {

		$em = $this->getDoctrine()->getManager();
        $idUser = $this->container->get('session')->get('log');

        $clientFilter = $em->getRepository('ClientBundle:ClientFilter')->findOneBy(['idUser' => $idUser]);
        $clientFilter = $clientFilter ? $clientFilter : new ClientFilter();
       
        $form = $this->createForm('ClientBundle\Form\ClientFilterType', $clientFilter, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        // form
        if( !$form->isSubmitted() && !$form->isValid() ) {
            if( $request->isXmlHttpRequest() ) return $this->render('ClientBundle:Default:filter_client.html.twig', ['form' => $form->createView()]);
            else return $this->redirectToRoute('client_liste_clients');
        }

        /* pour resultat du filtre */
        $clients = [];
        if( $clientFilter->getIdUser() )
            $clients = $this->search($clientFilter);

        if($clients) {
            foreach($clients as $key => &$client)
                if( isset($client[0]) ) {
                    $client[0]->setRelationsProfessionnelles($em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findOneBy(['id' => (int)$client[0]->getIDRelationsProfessionnelles()]));
                }
        }

        /* flusher */
        return $this->render('ClientBundle:Default:clients.html.twig', ['filtre' => true, 'clients' => $clients]);
	}

	/**
	* Search page
	*/
	private function search ($clientFilter) {
        $bu_id = $this->container->get('session')->get('BU');

		$data = [
			'cp' => $clientFilter->getCP(),
			'idStatut' => $clientFilter->getIdStatut(),
			'idEntiteJ' => $clientFilter->getIdEntiteJ(),
            'idOwner' => $clientFilter->getIdOwner(),
            'idWatcher' => $clientFilter->getIdWatcher(),
		];

		return $this->getDoctrine()->getRepository('ClientBundle:Client')->filterBy($bu_id, $data);
	}

	/**
	* filter page
	*/
	private function dataForm () {
		$em = $this->getDoctrine();

		return [
			// 'entitej' => $em->getRepository('ClientBundle:Client')->findAll(),
            'codepostal' => $em->getRepository('ClientBundle:CodePostal')->findDistinct(),
            'entitej' => $em->getRepository('ClientBundle:Client')->findAll(),
            'statuts' => $em->getRepository('CrmBundle:Back\CrmParamStatut')->findBy(['ouvert' => 1]),
            'coms' => $em->getRepository('UsersBundle:UserClient')->findSalarierCom([10]), 
            'rescoms' => $em->getRepository('UsersBundle:UserClient')->findSalarierCom([13])
		];
	}
}