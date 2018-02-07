<?php

namespace UsersBundle\Controller;

use UsersBundle\Entity\UserClient;
use AppBundle\Entity\Classes\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Userclient controller.
 *
 * @Route("user")
 */
class UserClientController extends Controller
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
     * Lists all userClient entities.
     *
     * @Route("/log", name="user_log")
     * @Method("GET")
     */
    public function logAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /** 
         * Business Unit
         */
        $bu = $request->get('bu');
        if( $bu != null ) {
            $this->get('session')->set('BU', $bu);

            /**
             * pour user
             * si user: non existe erreur
             */
            $user = $em->getRepository('UsersBundle:UserClient')->findUserByCompte($bu, parent::getUser()->getId());
            if( $user )
                $this->get('session')->set('log', $user->getId());
        }

        if( $bu == 0 )
            $this->get('session')->remove('BU');

        $url = $this->get('router')->generate('homepage');
        return $this->redirect($url);
    }

    /**
     * Deletes a userClient entity.
     *
     * @Route("/ajax", name="user_ajax_entite")
     * @Method("GET")
     */
    public function ajaxAction (Request $request) {
        $entite_id = $request->get('entite_id');
        $em = $this->getDoctrine();

        if( $entite_id ) {
            $return = [];
            $r_bu_entitej = $em->getRepository('UsersBundle:RelationBusinessEntite')->findBy(['iDentite' => $entite_id]);
            foreach($r_bu_entitej as &$r_bu) {
                $pro = $em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findOneBy(['id' => $r_bu->getIDRelationsProfessionnelles()]);
                $r_bu->setRelationsProfessionnelles($pro);

                $return[ $r_bu->getId() ] = sprintf("%s - %s", $r_bu->getBusinessunit()->getNomBusinessUnit(), $r_bu->getRelationsProfessionnelles()->getLabel());
            }

            return new JsonResponse($return);
        }

    }

    /**
     * Lists all userClient entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $userClients = $em->getRepository('UsersBundle:UserClient')->findAll();

        return $this->render('UsersBundle:userclient:index.html.twig', array(
            'userClients' => $userClients,
        ));
    }

    /**
     * Creates a new userClient entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        /* entity manager */
        $em = $this->getDoctrine()->getManager();
        $userClient = new UserClient();
        $form = $this->createForm('UsersBundle\Form\UserClientType', $userClient, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /* pour code */
            \AppBundle\Entity\Classes\Utils::setCode($userClient);

            // le fichier document à télécharger
            $dir = $this->getParameter('upload_dir');
            $userClient->setPhoto(Utils::Upload_file($userClient->getPhoto(), $dir));

            /* date creation */
            $userClient->setDateCreation(new \DateTime('now'));
            
            /* persist and flush */
            $em->persist($userClient);
            $em->flush();

            // relation
            $this->AddUpdateRelations($userClient);
            return $this->redirectToRoute('user_index');
        }

        /* code postal */
        $codePostal = $em->getRepository('ClientBundle:CodePostal')->findDistinct();
        return $this->render('UsersBundle:userclient:new.html.twig', [
            'codePostal' => $codePostal,
            'userClient' => $userClient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a userClient entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(UserClient $userClient)
    {
        $deleteForm = $this->createDeleteForm($userClient);

        return $this->render('UsersBundle:userclient:show.html.twig', array(
            'userClient' => $userClient,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing userClient entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UserClient $userClient)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($userClient);

        $editForm = $this->createForm('UsersBundle\Form\UserClientType', $userClient, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // le fichier à télécharger
            $dir = $this->getParameter('upload_dir');
            $userClient->setPhoto(Utils::Upload_file($userClient->getPhoto(), $dir));

            $em->persist($userClient);
            $em->flush();

            $this->AddUpdateRelations($userClient);
            return $this->redirectToRoute('user_edit', ['id' => $userClient->getId()]);
        }

        //============= les tabs
        $tabs = [];
        // tabs mail
        $tabs['mail'] = $this->InBoxMail($userClient->getId());
        // tabs agenda
        $tabs['agenda'] = $this->Agenda($userClient->getId());
        // tabs doc
        $tabs['docs'] = $em->getRepository('UsersBundle:UserDocs')->findBy(['iDUser' => $userClient->getId()]);
        // tabs note
        $tabs['notes'] = $em->getRepository('UsersBundle:UserNotes')->findBy(['idUser' => $userClient->getId()]);

        $bu_id = $this->container->get('session')->get('log');
        $r_users = $em->getRepository('UsersBundle:UserClient')->findRelation($userClient->getIDNatureUser(), $userClient->getId(), $bu_id);
        if( count($r_users) )  {
            foreach( $r_users as &$r_ ) {

                if( $userClient->getIDNatureUser() == 1 ) 
                {
                    /**
                     * Pour Fonction user
                     */
                    $fonction = $em->getRepository('UsersBundle:Back\UsersParamRelationsFonctions')->findOneBy(['id' => $r_['iDRelation_Fonctionnelle']]);
                    if( $fonction ) {
                        $r_['businessUser']->setRelationsFonctionnelles($fonction);
                    }
                }

                if( $userClient->getIDNatureUser() == 2 ) 
                {
                    /**
                     * Pour Profession et Business Unit
                     */
                    $profession = $em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findOneBy(['id' => $r_['businessEntite']->getIDRelationsProfessionnelles()]);
                    if( $profession ) {
                        $r_['businessEntite']->setRelationsProfessionnelles($profession);
                    }


                    /**
                     * Pour Fonction et Service
                     */

                    $fonction = $em->getRepository('UsersBundle:Back\UsersParamRelationsFonctions')->findOneBy(['id' => $r_['iDRelationFonctionnelle']]);
                    if( $fonction ) {
                        $r_['businessEntite']->getEntite()->setRelationsProfessionnelles($fonction);
                    }
                }
            }
        }

        /* code postal */
        $codePostal = $em->getRepository('ClientBundle:CodePostal')->findDistinct();

        return $this->render('UsersBundle:userclient:edit.html.twig', [
            'codePostal' => $codePostal,
            'r_users' => $r_users,
            'tabs' => $tabs,
            'userClient' => $userClient,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a userClient entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UserClient $userClient)
    {
        $form = $this->createDeleteForm($userClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userClient);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a userClient entity.
     *
     * @param UserClient $userClient The userClient entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserClient $userClient)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $userClient->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    

    /* data form */
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();

        // $r_bu_entitej = $em->getRepository('UsersBundle:RelationBusinessEntite')->findBy([]);
        // foreach($r_bu_entitej as &$r_bu) {
        //     $pro = $em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findOneBy(['id' => $r_bu->getIDRelationsProfessionnelles()]);
        //     $r_bu->setRelationsProfessionnelles($pro);
        // }

        $user_param_groupe = [];
        $admins = $em->getRepository('UsersBundle:UserClient')->findBy(['id' => $this->container->get('session')->get('log')]);
        if( $admins )
            foreach( $admins as $admin ) {

                $criter = [];
                switch($admin->getIDGroupe()) {
                    case 2:
                        $criter = ['id' => [3, 4]];
                        break;
                    case 3:
                        $criter = ['id' => 4];
                }

                $user_param_groupe = $em->getRepository('UsersBundle:Back\UsersParamGroupe')->findBy($criter);
            }


        // pour r_bu_entitej
        return [
            'entiteJ' => $em->getRepository('ClientBundle:Client')->findAll(),
            'r_bu_entitej' => [],
            'relationsFonctionnelles' => $em->getRepository('UsersBundle:Back\UsersParamRelationsFonctions')->findAll(),
            'businessunits' => $em->getRepository('UsersBundle:BusinessUnit')->findAll(),
            'natures' => $em->getRepository('UsersBundle:Back\UsersParamNature')->findAll(),
            'langages' =>  $em->getRepository('AppBundle:Common\Langage')->findAll(),
            'user_compte' =>  $em->getRepository('UsersBundle:Users')->findAll(),
            'pays' =>  $em->getRepository('ClientBundle:Pays')->findBy(['ouvert' => 1]),
            'user_param_groupe' =>  $user_param_groupe,
            'codepostal' => $em->getRepository('ClientBundle:CodePostal')->findDistinct()
        ];
    }

    /**
     * Agenda
     */
    private function Agenda ($user_id) {

        if( !is_object($this->getUser()) )
            $user_id = null;

        $bu_id = $this->container->get('session')->get('BU');
        return $this->getDoctrine()->getRepository('ProjectBundle:Agenda\AgendaWorker')->findCrmEtapesOperationsByUser($user_id, null, $bu_id);
    }

    /**
     * Box Mail
     */
    private function InBoxMail ($user_id) {
        $manager = $this->getDoctrine()->getManager();
        $user = $manager->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $user_id]);

        $dataTrash  = $this->getDoctrine()->getRepository('MailBundle:MailTrash')->dataTrash($user);
        $mails     = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash);        

        $all_out   = $manager->getRepository('MailBundle:MailPeople')->findOutbox($user, $dataTrash);
        $tbox      = $manager->getRepository('MailBundle:ParamMailTbox')->findAll();
        $priorites = $manager->getRepository('MailBundle:ParamMailPriorites')->findAll();
        $trash_count = $manager->getRepository('MailBundle:MailTrash')->countTrash($user);
        $mail_draft = $manager->getRepository('MailBundle:MailMessage')->countDraft($user);

        $list = $manager->createQuery('SELECT IDENTITY(mpj.mail) from MailBundle:MailPJ mpj JOIN MailBundle:Mail m WITH m.id = mpj.mail where mpj.typePj = 0')->getScalarResult();

        $pjs = array();

        foreach($list as $pj) $pjs[] = $pj[1];

        // $spam = $this->getNotification();
        $jour   = new \DateTime();
        // $allmails = count($all_out) + $trash_count + $spam['spam'] + count($mails);
        return ['mails'  => $mails,
            'jour'   => $jour, 
            // 'all_mails' =>$allmails, 
            'pjs'=>$pjs, 
            'nonlus' => count($mails),
            'all_out'=>count($all_out), 
            // 'spam' => $spam['spam'],
            'tbox' => $tbox, 
            'priorites' => $priorites, 
            'type' => 'inbox',
            'mail_trash'=>$trash_count, 
            'title'=>$this->get('translator')->trans('list_mail.my_inbox'), 
            'mail_draft'=>$mail_draft, "new_today" => count($mails)
        ];
    }

    public function AddUpdateRelations ($userClient) {
        $em = $this->getDoctrine()->getManager();
        $user_id = $userClient->getId();
        $client_id = $userClient->getIDEntite();
        $bu_id = $userClient->getIDBusinessUnit();
        $fonc_id = $userClient->getIDRelationFonctionnelle();
        $r_bu_id = $userClient->getRbuentitej();
        $nature = $userClient->getIDNatureUser();
        // if( !$user_id && !$client_id && !$bu_id && !$fonc_id && !$pro_id ) return;

        /**
         *  pour contact
         */
        if( $nature == 2 ) {
            if( !$r_bu_id || !$client_id || !$fonc_id ) return;

            /**
             * r_bu_entitej
             *  id_bu, id_entite, id_pro
             */
            $r_bu_entitej = $em->getRepository('UsersBundle:RelationBusinessEntite')->findOneBy([
                'id' => $r_bu_id,
            ]);
            if(!$r_bu_entitej) {
                $r_bu_entitej = new \UsersBundle\Entity\RelationBusinessEntite();

                // foreign key
                $r_bu_entitej->setEntite($em->getRepository('ClientBundle:Client')->findOneBy(['id' => $client_id]));
                $r_bu_entitej->setBusinessunit($em->getRepository('UsersBundle:BusinessUnit')->findOneBy(['id' => $bu_id]));
                $r_bu_entitej->setRelationsProfessionnelles($em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findOneBy(['id' => $pro_id]));

                $r_bu_entitej->setIDBusinessUnit($bu_id);
                $r_bu_entitej->setIDentite($client_id);
                $r_bu_entitej->setIDRelationsProfessionnelles($pro_id);
                $em->persist($r_bu_entitej);
                $em->flush();
            }

            /**
             * r_user_entitej
             *  id_user, id_entite, id_bu_entitej, id_fonc
             */
            // pour l'instant, on met à plusieur
            $r_user_entitej = $em->getRepository('UsersBundle:RelationUserEntite')->findOneBy(['iDUser' => $user_id, 'idEntiteJ' => $client_id]);
            if(!$r_user_entitej) {
                $r_user_entitej = new \UsersBundle\Entity\RelationUserEntite();

                // foreign
                $r_user_entitej->setEntite($em->getRepository('ClientBundle:Client')->findOneBy(['id' => $client_id]));
                $r_user_entitej->setUser($em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $user_id]));
                $r_user_entitej->setRelations($em->getRepository('UsersBundle:RelationBusinessEntite')->findOneBy(['id' => $r_bu_entitej->getId()]));
            }
            $r_user_entitej->setIdEntiteJ($client_id);
            $r_user_entitej->setIDUser($user_id);
            $r_user_entitej->setIDUserEntite($r_bu_entitej->getId());
            $r_user_entitej->setIDRelationFonctionnelle($fonc_id);
            $em->persist($r_user_entitej);
            $em->flush();
        }


        /**
         * r_bu_user
         * id_user, id_bu, id_fonc
         */
        if( $nature == 1 ) {

            if( !$user_id || !$bu_id && !$fonc_id ) return;

            $r_bu_user = $em->getRepository('UsersBundle:RelationBusinessUser')->findOneBy(['iDUser' => $user_id, 'iDBusinessUnit' => $bu_id]);

            if(!$r_bu_user) {
                $r_bu_user = new \UsersBundle\Entity\RelationBusinessUser(); 

                // foreign
                $r_bu_user->setUser($em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $user_id]));
                $r_bu_user->setBusinessUnit($em->getRepository('UsersBundle:BusinessUnit')->findOneBy(['id' => $bu_id]));
                $r_bu_user->setRelationsFonctionnelles($em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findOneBy(['id' => $fonc_id]));
            }


            $r_bu_user->setIDuser($user_id);
            $r_bu_user->setIDBusinessUnit($bu_id);
            $r_bu_user->setIDRelationFonctionnelle($fonc_id);

            $em->persist($r_bu_user);
            $em->flush();
        }
    }
}
