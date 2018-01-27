<?php

namespace CrmBundle\Controller\Common;

use CrmBundle\Entity\Common\CrmDossier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * CrmDossier controller.
 *
 * @Route("crm/dossier")
 */
class CrmDossierController extends Controller
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
     * Lists all crmdossier entities.
     *
     * @Route("/", name="crmdossier_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $orderby = ($orderby = $request->get('orderby')) ? $orderby : 'Statut';
        $orderby = $this->getOrderProject($orderby);

        $crmDossiers = $em->getRepository('CrmBundle:Common\CrmDossier')->findAllBy($this->getUser());

        // return
        $crms = [];
        foreach($crmDossiers as $key => $crm) 
        {
            $clefs = null;

            if( strpos(strtolower($orderby), 'date') !== false )
                $clefs = $crm->getDatefinPrevue();

            if( strpos(strtolower($orderby), 'statut') !== false ) {
                $clefs = $em->getRepository('CrmBundle:Back\CrmParamStatut')->findOneBy(['id' => $crm->getStatut()]);
                if(!is_object($clefs)) continue;
                $clefs = $clefs->getLabel();
            }

            if( strpos(strtolower($orderby), 'identitej') !== false ) {
                $entite = $em->getRepository('ClientBundle:Client')->findOneBy(['id' => $crm->getIdEntiteJ()]);
                if( !$entite ) continue;
                $clefs = $entite->getRaisonSociale();
            }

            /* clef null on continue */
            if( $clefs == null ) continue;

            if( $clefs instanceof \DateTime ) {
                $date_format = ['fr' => 'd-m-Y', 'en' => 'm-d-Y'];
                $locale = $request->getLocale();
                $format = array_key_exists($locale, $date_format) ? $date_format[$locale] : $date_format['en'];
                $clefs = $clefs->format($format );
                $clefs = str_replace('--', '-', $clefs);
                if( $clefs == '30-11-0001' || $clefs == '-0001-11-30' ) {
                    continue;
                }
            }

            $clefs = str_replace(' ', '-', $clefs);
            if( !isset($crms[$clefs]) ) $crms[$clefs] = [];

            //=============== entite J ==============
            $entite = $em->getRepository('ClientBundle:Client')->findOneBy(['id' => $crm->getIdEntiteJ()]);
            $crm->setEntite($entite);
            //=============== Cycle ================
            $cycle = $em->getRepository('CrmBundle:Back\CrmParamCycles')->findOneBy(['id' => $crm->getIdCycle()]);
            $crm->setCycle($cycle);

            //============== append =============
            $crms[$clefs][] = $crm;
        }

        return $this->render('CrmBundle:common\crmdossier:index.html.twig', array(
            'crmDossiers' => $crms,
        ));
    }

    /**
     * Creates a new crmdossier entity.
     *
     * @Route("/new", name="crmdossier_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmdossier = new CrmDossier();

        $form = $this->createForm('CrmBundle\Form\Common\CrmDossierType', $crmdossier, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // pour code
            \AppBundle\Entity\Classes\Utils::setCode($crmdossier);
            
            // icone
            $this->setIcone($crmdossier);

            // date creation
            $crmdossier->setDateCreation(new \DateTime('now'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($crmdossier);
            $em->flush();

            //================================
            // getting to setting type to user
            //================================
            // $this->setTypeToUser($crmdossier);

            // next form
            return $this->redirectToRoute('crmdossier_edit', ['id'=>$crmdossier->getId()]);            
        }

        return $this->render('CrmBundle:common\crmdossier:new.html.twig', array(
            'crmdossier' => $crmdossier,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmdossier entity.
     *
     * @Route("/{id}", name="crmdossier_show")
     * @Method("GET")
     */
    public function showAction(CrmDossier $crmdossier)
    {
        $deleteForm = $this->createDeleteForm($crmdossier);

        return $this->render('CrmBundle:common\crmdossier:show.html.twig', array(
            'crmdossier' => $crmdossier,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmdossier entity.
     *
     * @Route("/{id}/edit", name="crmdossier_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmDossier $crm)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($crm);

        $editForm = $this->createForm('CrmBundle\Form\Common\CrmDossierType', $crm, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            //========= custom save ==============
           // $this->setTypeToUser($crm); // set user
            $this->setIcone($crm); // set icone
            //====================================

            $em->persist($crm);
            $em->flush();

            return $this->redirectToRoute('crmdossier_edit', array('id' => $crm->getId()));
        }

        return $this->render('CrmBundle:common\crmdossier:edit.html.twig', array(
            'crmdossier' => $crm,
            'filename' => $crm->getIcone(),
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmdossier entity.
     *
     * @Route("/{id}", name="crmdossier_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmDossier $crmdossier)
    {
        $form = $this->createDeleteForm($crmdossier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmdossier);
            $em->flush();
        }

        return $this->redirectToRoute('crmdossier_index');
    }

    /**
     * Creates a form to delete a crmdossier entity.
     *
     * @param CrmDossier $crmdossier The crmdossier entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmDossier $crmdossier)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmdossier_delete', array('id' => $crmdossier->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // dataForm
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        $bu_id = $this->container->get('session')->get('BU');
        
        return [
            'entityJ' => $em->getRepository('ClientBundle:Client')->findByBU($this->getUser() ? $bu_id : -1),
            'clients' => $this->client(),
            'owner' => $em->getRepository('UsersBundle:UserClient')->findSalarierCom([10]), 
            'watcher' => $em->getRepository('UsersBundle:UserClient')->findSalarierCom([13]), 
            'modeacces' => $em->getRepository('CrmBundle:Back\CrmParamModeAccess')->findAll(),
            'statuts' => $em->getRepository('CrmBundle:Back\CrmParamStatut')->findAll(),
            'resultats' => $em->getRepository('CrmBundle:Back\CrmParamResultat')->findAll(),
            'cycles' => $em->getRepository('CrmBundle:Back\CrmParamCycles')->findAll()
        ];
    }

    // for icone
    private function setIcone ($crmdossier)
    {
        $icone = \AppBundle\Entity\Classes\Utils::Upload_file($crmdossier->getIcone(), $this->getParameter('upload_dir'));
        if( $icone )
            $crmdossier->setIcone($icone);
    }

    // type to user
    private function setTypeToUser ($crm)
    {
        if( !is_object($crm) ) return;
        $em = $this->getDoctrine()->getManager();
        $crm_id = $crm->getId();
        $user_s = $crm->getUser();
        $users = [];
        foreach ($user_s as $key => $user) {
            $u = explode('-', $user);
            $users[$key] = (int)$u[0];
        }
        if( !count($user_s) ) return;

        //================
        // contact
        //================
        $contact = (string)$crm->getContact();
        $contacts = explode('-', $contact);
        $users['contact'] = (int)$contacts[0];

        //================ Supression ==============
        $crms = $em->getRepository('CrmBundle:Common\CrmUsers')->findBy(['idCRM' => $crm_id]);
        if( count($crms) )
            foreach( $crms as $crm )
                if( !in_array($crm->getIdUser(), $users) ) { /* if not inside change to 0 */
                    $em->remove($crm);
                    $em->flush(); // update it
                }

        //================= Ajout/Modification =================
        foreach ($users as $key => $id)
        {
            if(!$id || $id == 0) continue;
            $idRelation = $key === 'contact' ? $contact : $user_s[$key];
            $user = $em->getRepository('CrmBundle:Common\CrmUsers')->findOneBy(['idUser' => $id, 'idRelation' => $idRelation]);
            $user = $user ? $user : new \CrmBundle\Entity\Common\CrmUsers;

            /* pour users */
            $uu = $em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $id]);
            $user->setUser($uu); // setting user id

            /* pour crm */
            $user->setIdCRM($crm_id); // setting user id
            if($key === 'contact') { 
                $user->setIdRelation($contact);
            }else{
                $s = (string)$user_s[$key];
                $user->setIdRelation($s);
            }

            /* persist user */
            $em->persist($user);
            $em->flush(); /* maj */
        }
    }

    /**
     * Order of OrderBy 
     */
    private function getOrderProject( $orderby ) 
    {
        // for statut
        if( $orderby == 'idEntiteJ' )
            $orderby = 'idEntiteJ';

        // for statut
        if( $orderby == 'idStatut' )
            $orderby = 'statut';

        // for date fin prevue
        if( $orderby == 'datefinprevue' )
            $orderby = 'datefinPrevue';

        return $orderby;
    }

    //============ client ============
    private function client () 
    {   
        $em = $this->getDoctrine()->getManager();
        $data = [
            'total_count' => 0,
            'incomplete_results' => true,
            'items' => []
        ];

        // user_client
        $users = $em->getRepository('UsersBundle:UserClient')->findSalarierCom([10, 13, 14]);
        if( count($users) ) {
            $data['incomplete_results'] = false;

            foreach($users as $user) {
                $data['items'][] = [
                    'id' => $user['id'] . ($user[0] != null ? '-' . $user[0]->getId() : ''), 
                    'text' => $user['firstname'] . ' ' . $user['lastname'] . ($user[0] != null ? ' - ' . $user[0]->getLabel() : '')
                ];
            }
        }

        return $data;
    }
    //=================================
}