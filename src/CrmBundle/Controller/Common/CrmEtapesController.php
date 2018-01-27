<?php

namespace CrmBundle\Controller\Common;

use CrmBundle\Entity\Common\CrmEtapes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Crmdocsenvoye controller.
 *
 * @Route("crm/etapes")
 */
class CrmEtapesController extends Controller
{
    /**
     * Lists all crmEtapes entities.
     *
     * @Route("/", name="crmetapes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $crmEtapes = $em->getRepository('CrmBundle:Common\CrmEtapes')->findAll();

        return $this->render('CrmBundle:common/crmetapes:index.html.twig', array(
            'crmEtapes' => $crmEtapes,
        ));
    }

    /**
     * Creates a new crmEtapes entity.
     *
     * @Route("/new", name="crmetapes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $crmEtapes = new CrmEtapes();

        //======================= utilisateur ======================
        $crm_users = [];
        if( ($idCRM = $request->get('idCRM')) ) {
            $crm_users = array_map(function($object) {
                    if( !is_object($object) ) return;
                    return $object->getIdUser();
                }, 
                $em->getRepository('CrmBundle:Common\CrmUsers')->findEmploye(['idCRM' => $idCRM])
            );

            $crmEtapes->setIdCRM($idCRM);
        }
        //==========================================================
        //
        $form = $this->createForm('CrmBundle\Form\Common\CrmEtapesType', $crmEtapes, ['dataForm' => $this->dataForm($crm_users)]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $crmEtapes->setDateCreation(new \DateTime('now '.date('e'))); // date creation
            

            /* pour crm */
            $crm = $em->getRepository('CrmBundle:Common\CrmDossier')->findOneBy(['id' => $crmEtapes->getIdCRM() ]);
            $crmEtapes->setCrm($crm);

            /* pour code */
            \AppBundle\Entity\Classes\Utils::setCode($crmEtapes);

            // for crm etape
            $em->persist($crmEtapes);
            $em->flush();

            // for agenda 
            $agenda = $this->setAgenda($crmEtapes);
            $em->persist($agenda);
            $em->flush();

            // pour user affectation
            $this->setUseAffectation($crmEtapes);

            return $this->redirectToRoute('crmetapes_index');
        }

        return $this->render('CrmBundle:common/crmetapes:new.html.twig', array(
            'crmEtapes' => $crmEtapes,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmEtapes entity.
     *
     * @Route("/{id}", name="crmetapes_show")
     * @Method("GET")
     */
    public function showAction(CrmEtapes $crmEtapes)
    {
        $deleteForm = $this->createDeleteForm($crmEtapes);

        return $this->render('CrmBundle:common/crmetapes:show.html.twig', array(
            'crmEtapes' => $crmEtapes,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmEtapes entity.
     *
     * @Route("/{id}/edit", name="crmetapes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmEtapes $crmEtapes)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($crmEtapes);

        //======================== utilisateur ===========================
        $users = $em->getRepository('CrmBundle:Common\CrmEtapesUsers')->findBy(['idEtape' => $crmEtapes->getId()]);
        $user_ids = [];
        if( count($users) )
            foreach($users as $user)
                $user_ids[] = $user->getIdUser();
        $crmEtapes->setUser4affectation($user_ids);

        /* pour user et l'etape lui même */
        $crm_users = [];
        $crm_users = array_map(function($object) {
                if( !is_object($object) ) return;
                return $object->getIdUser();
            }, 
            $em->getRepository('CrmBundle:Common\CrmUsers')->findEmploye(['idCRM' => $crmEtapes->getIdCRM()])
        );
        //=================================================================
        
        $editForm = $this->createForm('CrmBundle\Form\Common\CrmEtapesType', $crmEtapes, ['dataForm' => $this->dataForm($crm_users)]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            /* pour user */
            $this->setUseAffectation($crmEtapes);

            // for agenda 
            $agenda = $this->setAgenda($crmEtapes);
            $em->persist($agenda);
            $em->flush();

            // for crm etape
            $em->persist($crmEtapes);
            $em->flush();

            return $this->redirectToRoute('crmetapes_edit', array('id' => $crmEtapes->getId()));
        }

        return $this->render('CrmBundle:common/crmetapes:edit.html.twig', array(
            'crmEtapes' => $crmEtapes,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmEtapes entity.
     *
     * @Route("/{id}", name="crmetapes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmEtapes $crmEtapes)
    {
        $form = $this->createDeleteForm($crmEtapes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // delete agenda
            $agenda = $em->getRepository('ProjectBundle:Agenda\AgendaWorker')->findOneBy(['idCRMEtape' => $crmEtapes->getId()]);
            $em->remove($agenda);
            $em->flush();

            // for crm etape
            $em->remove($crmEtapes);
            $em->flush();
        }

        return $this->redirectToRoute('crmetapes_index');
    }

    /**
     * Creates a form to delete a crmEtapes entity.
     *
     * @param CrmEtapes $crmEtapes The crmEtapes entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmEtapes $crmEtapes)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmetapes_delete', array('id' => $crmEtapes->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    // dataForm
    private function dataForm ($crm_users)
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'crms' => $em->getRepository('CrmBundle:Common\CrmDossier')->findAll(),
            'cycles' => $em->getRepository('CrmBundle:Back\CrmParamCycles')->findAll(),
            'resultats' => $em->getRepository('CrmBundle:Back\CrmParamResultat')->findAll(),
            'statuts' => $em->getRepository('ProjectBundle:Back\Statut')->findAll(),
            'users'     => $em->getRepository('UsersBundle:UserClient')->findEmploye(),
            'crm_users' => $crm_users
        ];
    }

    // for agenda
    private function setAgenda ($crmEtapes) 
    {
        $agenda = null;
        if( ($id = $crmEtapes->getId()) != null )
            $agenda  = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Agenda\AgendaWorker')->findOneBy(['idCRMEtape' => $id]);

        $value = [
            'idCRMEtape' => $crmEtapes->getId(),
            'dateDebPrevue' => $crmEtapes->getDatedebutprevue(),
            'dateFinPrevue' => $crmEtapes->getDatefinprevue(),
            'dateDebReelle' => $crmEtapes->getDatedebutreelle(),
            'dateFinReelle' => $crmEtapes->getDatefinreelle()
        ];

        return \ProjectBundle\Entity\Agenda\AgendaWorker::MinAgenda($value, $agenda);
    }

    // pour user
    private function setUseAffectation($crmEtapes) 
    {
        $em = $this->getDoctrine()->getManager();
        $users = $crmEtapes->getUser4affectation();
        if( !count($users) ) return;

        /* à supprimer d'abord **/
        $etape_users = $em->getRepository('CrmBundle:Common\CrmEtapesUsers')->findBy(['idEtape' => $crmEtapes->getId()]);
        if( count($etape_users) )
            foreach( $etape_users as $user )
                if( !in_array($user->getIdUser(), $users) ) {
                    $em->remove($user);  // on supprime
                    $em->flush();
                }

        /* maj ou ajout des nouveaux */
        foreach( $users as $id ) {
            // étape users
            $etape_users = $em->getRepository('CrmBundle:Common\CrmEtapesUsers')->findOneBy(['idUser' => $id]);
            $etape_users = $etape_users ? $etape_users : new \CrmBundle\Entity\Common\CrmEtapesUsers();

            // paramètre
            $etape_users->setIdCRM($crmEtapes->getIdCRM());
            $etape_users->setIdEtape($crmEtapes->getId());

            $user = $em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $id ]);
            $etape_users->setUser($user);

            /* transaction dans la base de donnée */
            $em->persist($etape_users);
            $em->flush();
        }
    }
}
