<?php

namespace ProjectBundle\Controller\Agenda;

use ProjectBundle\Entity\Agenda\AgendaWorker;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Agendaworker controller.
 *
 * @Route("agenda")
 */
class AgendaWorkerController extends Controller
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
     * Lists all agendaWorker entities.
     *
     * @Route("/", name="agenda_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user_id = is_object($this->getUser()) ? $this->getuser()->getId() : null;

        $agendaWorkers = $em->getRepository('ProjectBundle:Agenda\AgendaWorker')->findAll();
        $project_etapes = $em->getRepository('ProjectBundle:Agenda\AgendaWorker')->findProjectEtapeAll();
        $project_operations = $em->getRepository('ProjectBundle:Agenda\AgendaWorker')->findProjectEtapeOperationAll();
        $project_operations_issues = $em->getRepository('ProjectBundle:Agenda\AgendaWorker')->findProjectEtapeOperationIssueAll();
        $crm_etapes_operations = $em->getRepository('ProjectBundle:Agenda\AgendaWorker')->findCrmEtapesOperationsByUser($user_id, null, $this->container->get('session')->get('BU'));

        $agendaWorkers = [
            'project_etapes' => $project_etapes,
            'project_etapes_operations' => $project_operations,
            'project_etapes_operations_issues' => $project_operations_issues,
            'crm_etapes' => [],
            'crm_etapes_operations' => $crm_etapes_operations
        ];

        return $this->render('ProjectBundle:agenda\agendaworker:index.html.twig', array(
            'agendaWorkers' => $agendaWorkers,
        ));
    }

    /**
     * Creates a new agendaWorker entity.
     *
     * @Route("/ajaxnew", name="agenda_ajax_new")
     * @Method({"GET", "POST"})
     */
    public function ajaxAction(Request $request)
    {
        $agendaWorker = new Agendaworker();
        $users = $this->getDoctrine()->getManager()->getRepository('UsersBundle:Users')->findAll();
        $form = $this->createForm('ProjectBundle\Form\Agenda\AgendaWorkerType', $agendaWorker, ['users'=>$users]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->setDate($agendaWorker); // agenda
            $em = $this->getDoctrine()->getManager();
            $em->persist($agendaWorker);
            $em->flush();

            // list of agenda
            $agendas = ['data'=>[], 'result'=>true];
            $agendaWorker = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Agenda\AgendaWorker')->findAll();
            if(!$agendaWorker) $agendas['result'] = false;

            foreach($agendaWorker as $agenda)
                $agendas['data'][$agenda->getId()] = $agenda->getTitre();

            // return to json
            return new JsonResponse($agendas);
        }

        return $this->render('ProjectBundle:agenda\agendaworker:ajax.new.html.twig', array(
            'agendaWorker' => $agendaWorker,
            'form' => $form->createView(),
        ));
    }

    // setting date
    public function setDate($agendaWorker) 
    {
        // date debut
        $agendaWorker->setDateDebPrevue(new \DateTime(str_replace('-','/',$agendaWorker->getDateDebPrevue())));
        // date fin
        $agendaWorker->setDateFinPrevue(new \DateTime(str_replace('-','/',$agendaWorker->getDateFinPrevue())));
        // date debut
        $agendaWorker->setDateDebReelle(new \DateTime(str_replace('-','/',$agendaWorker->getDateDebReelle())));
        // date debut
        $agendaWorker->setDateFinReelle(new \DateTime(str_replace('-','/',$agendaWorker->getDateFinReelle())));
        // date cloture
        $agendaWorker->setDateCloture(new \DateTime(str_replace('-','/',$agendaWorker->getDateCloture())));
        // date de saisie
        $agendaWorker->setDateSaisie(new \DateTime('now '.date('e')));
    }

    /**
     * Creates a new agendaWorker entity.
     *
     * @Route("/{idProjet}/new", name="agenda_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $agendaWorker = new Agendaworker();
        $users = $this->getDoctrine()->getManager()->getRepository('UsersBundle:Users')->findAll();
        $form = $this->createForm('ProjectBundle\Form\Agenda\AgendaWorkerType', $agendaWorker, ['users'=>$users]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->setDate($agendaWorker); // agenda
            $em = $this->getDoctrine()->getManager();
            $em->persist($agendaWorker);
            $em->flush();

            return $this->redirectToRoute('agenda_index');
        }

        return $this->render('ProjectBundle:agenda\agendaworker:new.html.twig', array(
            'agendaWorker' => $agendaWorker,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a agendaWorker entity.
     *
     * @Route("/{id}", name="agenda_show")
     * @Method("GET")
     */
    public function showAction(AgendaWorker $agendaWorker)
    {
        $deleteForm = $this->createDeleteForm($agendaWorker);

        return $this->render('ProjectBundle:agenda\agendaworker:show.html.twig', array(
            'agendaWorker' => $agendaWorker,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing agendaWorker entity.
     *
     * @Route("/{id}/edit", name="agenda_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AgendaWorker $agendaWorker)
    {
        $deleteForm = $this->createDeleteForm($agendaWorker);
        $users = $this->getDoctrine()->getManager()->getRepository('UsersBundle:Users')->findAll();
        $editForm = $this->createForm('ProjectBundle\Form\Agenda\AgendaWorkerType', $agendaWorker, ['users'=>$users]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->setDate($agendaWorker); // date

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('agenda_edit', array('id' => $agendaWorker->getId()));
        }

        return $this->render('ProjectBundle:agenda\agendaworker:edit.html.twig', array(
            'agendaWorker' => $agendaWorker,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a agendaWorker entity.
     *
     * @Route("/{id}", name="agenda_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AgendaWorker $agendaWorker)
    {
        $form = $this->createDeleteForm($agendaWorker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($agendaWorker);
            $em->flush();
        }

        return $this->redirectToRoute('agenda_index');
    }

    /**
     * Creates a form to delete a agendaWorker entity.
     *
     * @param AgendaWorker $agendaWorker The agendaWorker entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AgendaWorker $agendaWorker)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agenda_delete', array('id' => $agendaWorker->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
