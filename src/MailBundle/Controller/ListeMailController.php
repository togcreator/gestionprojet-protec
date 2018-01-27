<?php
/**
 * Created by PhpStorm.
 * User: Madatic dev3
 * Date: 04/09/2017
 * Time: 22:00
 */

namespace MailBundle\Controller;


use Protec\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MailBundle\Entity\MailFiltreSession;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ListeMailController extends Controller
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
        $manager = $this->getDoctrine()->getManager();
        return $manager->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $session_id]);
    }

    /**
    * lister les mails envoyés
    */
    public function OutboxAction() {
        $user = $this->getUser();
        $manager = $this->getDoctrine()->getManager();

        $dataTrash  = $this->getDoctrine()->getRepository('MailBundle:MailTrash')->dataTrash($user);
        $tbox      = $manager->getRepository('MailBundle:ParamMailTbox')->findAll();
        $priorites = $manager->getRepository('MailBundle:ParamMailPriorites')->findAll();
        $mails     = $manager->getRepository('MailBundle:MailPeople')->findOutbox($user, $dataTrash);

        //$all_mails = $manager->getRepository('MailBundle:MailPeople')->findByMailsList($user, $dataTrash);
        // $new_today = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash, true);

        $nonlus    = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash);

        // $all_out   = $manager->getRepository('MailBundle:MailPeople')->findOutbox($user, $dataTrash);

        $trash_count = $manager->getRepository('MailBundle:MailTrash')->countTrash($user);
        $mail_draft = $manager->getRepository('MailBundle:MailMessage')->countDraft($user);

         $list = $manager->createQuery('SELECT IDENTITY(mpj.mail) from MailBundle:MailPJ mpj JOIN MailBundle:Mail m WITH m.id = mpj.mail where mpj.typePj = 0')->getScalarResult();

         $pjs = array();

         foreach($list as $pj) {
             $pjs[] = $pj[1];
         }

          $spam = $this->getNotification();

          $jour   = new \DateTime();
          $allmails = count($mails) + $trash_count + $spam['spam'] + count($nonlus);
          return $this->render('MailBundle:Default:mails/liste_mails.html.twig', array(   'mails'  => $mails,
              'jour'   => $jour, 'all_mails' =>$allmails, 'pjs'=>$pjs, 'nonlus' => count($nonlus), 'spam' => $spam['spam'],
              'tbox' => $tbox, 'priorites' => $priorites, 'type' => 'outbox',
              'mail_trash'=>$trash_count, 'title'=>$this->get('translator')->trans('list_mail.outbox'), 'all_out'=>count($mails), 'mail_draft'=>$mail_draft, "new_today" => count($mails)));

     }
     
     /**
      * lister les mails reçus
      */
     public function InboxAction() {
         $user    = $this->getUser();
         $manager = $this->getDoctrine()->getManager();

         $dataTrash  = $this->getDoctrine()->getRepository('MailBundle:MailTrash')->dataTrash($user);
         $mails     = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash);         
         //$all_mails = $manager->getRepository('MailBundle:MailPeople')->findByMailsList($user, $dataTrash);
         // $new_today = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash, true);

         // $nonlus    = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash, true);

         $all_out   = $manager->getRepository('MailBundle:MailPeople')->findOutbox($user, $dataTrash);
         $tbox      = $manager->getRepository('MailBundle:ParamMailTbox')->findAll();
         $priorites = $manager->getRepository('MailBundle:ParamMailPriorites')->findAll();
         $trash_count = $manager->getRepository('MailBundle:MailTrash')->countTrash($user);
         $mail_draft = $manager->getRepository('MailBundle:MailMessage')->countDraft($user);

         $list = $manager->createQuery('SELECT IDENTITY(mpj.mail) from MailBundle:MailPJ mpj JOIN MailBundle:Mail m WITH m.id = mpj.mail where mpj.typePj = 0')->getScalarResult();

         $pjs = array();

         foreach($list as $pj) {
             $pjs[] = $pj[1];
         }

         $spam = $this->getNotification();

         $jour   = new \DateTime();
         $allmails = count($all_out) + $trash_count + $spam['spam'] + count($mails);
         return $this->render('MailBundle:Default:mails/liste_mails.html.twig', array(   'mails'  => $mails,
         'jour'   => $jour, 'all_mails' =>$allmails, 'pjs'=>$pjs, 'nonlus' => count($mails),'all_out'=>count($all_out), 'spam' => $spam['spam'],
         'tbox' => $tbox, 'priorites' => $priorites, 'type' => 'inbox',
         'mail_trash'=>$trash_count, 'title'=>$this->get('translator')->trans('list_mail.my_inbox'), 'mail_draft'=>$mail_draft, "new_today" => count($mails)
         ));

     }

    /**
      * lister tous les mails
      */
     public function ListerMailAction() {      
         $user    = $this->getUser();
         $manager = $this->getDoctrine()->getManager();

         $dataTrash = $manager->getRepository('MailBundle:MailTrash')->dataTrash($user);
         $mails     = $manager->getRepository('MailBundle:MailPeople')->findByMailsList($user, $dataTrash);
         $tbox      = $manager->getRepository('MailBundle:ParamMailTbox')->findAll();         
         $priorites = $manager->getRepository('MailBundle:ParamMailPriorites')->findAll();
         $nonlus    = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash);
         $all_out   = $manager->getRepository('MailBundle:MailPeople')->findOutbox($user, $dataTrash);
         // $draft     = $manager->getRepository('MailBundle:MailMessage')->findByMessage($user);

         $trash     = $manager->getRepository('MailBundle:MailPeople')->findTrashList($user, $dataTrash);

         $tmp = array_merge($nonlus, $all_out);

         $tmp = array_merge($tmp, $trash);
         $trash_count = $manager->getRepository('MailBundle:MailTrash')->countTrash($user);
         $mail_draft = $manager->getRepository('MailBundle:MailMessage')->countDraft($user);

         $list = $manager->createQuery('SELECT IDENTITY(mpj.mail) from MailBundle:MailPJ mpj JOIN MailBundle:Mail m WITH m.id = mpj.mail where mpj.typePj = 0')->getScalarResult();

         $pjs = array();
         foreach($list as $pj) {
             $pjs[] = $pj[1];
         }

         $spam = $this->getNotification();
         $jour   = new \DateTime();
         $allmails = count($all_out) + $trash_count + $spam['spam'] + count($nonlus);
         return $this->render('MailBundle:Default:mails/liste_mails.html.twig', array('mails'=>$tmp,
             'jour' => $jour, 'all_mails' =>$allmails, 'pjs'=>$pjs, 'nonlus' =>count($nonlus), 'spam' => $spam['spam'],
             'tbox' => $tbox, 'priorites' => $priorites, 'type' => 'allmails', 'mail_trash'=>$trash_count, 'data_trash'=>explode(",", $dataTrash),
             'title'=>$this->get('translator')->trans('list_mail.all'), 'all_out'=>count($all_out), 'mail_draft'=>$mail_draft ));

     }
 
     protected function getNotification(){
         $user   = $this->getUser()->getId();
    
         $manager = $this->getDoctrine()->getManager();
         $spam = $manager->createQuery("SELECT count(ms.id) FROM MailBundle:MailPeople mp JOIN MailBundle:MailSpam ms WITH mp.mail = ms.mail WHERE mp.userTo = '$user'")->getSingleScalarResult();
 
         return array(
             'spam' => $spam
         );
     }

     /**
      * @param Request $request
      * @return Reponse
      */
    public function filterAction(Request $request) {
        $type = $request->get('type');
        $mails = $request->get('mails');
        $user = $this->getUser();
        $manager = $this->getDoctrine()->getManager();
        /*$mail_draft = $manager->getRepository('MailBundle:MailMessage')->countDraft($user);*/
        $dataTrash = $manager->getRepository('MailBundle:MailTrash')->dataTrash($user);
        /*$options = $request->get('options');
        $nb = $request->get('nb');
        $new_today = $request->get('new_today');
        $title = $this->get('translator')->trans('list_mail.all');
        if( $type == 'inbox'){
            $title = $this->get('translator')->trans('list_mail.my_inbox');
        }
        else if( $type == 'outbox' ){
            $title = $this->get('translator')->trans('list_mail.outbox');
        }*/

        $jour  = new \DateTime();
        return $this->render('MailBundle:Default:modulesUsed/mails_table.html.twig', array( 'mails'  => $mails,
            'jour' => $jour, 'type' => $type, 'data_trash' =>$dataTrash, /*'mail_draft'=>$mail_draft*/));

    }

      public function filterMailAction(Request $request){
        if($request->isMethod('POST')) {

            $nomFiltre = "";
            //Préparation des données du filtre
            $user = $this->getUser()->getId();
            $tbox = (null !== $request->request->get('tbox')) ? $request->request->get('tbox') : null;
            $priorite = (null !== $request->request->get('priorite')) ? $request->request->get('priorite') : null;
            $motsCles = $request->request->get('motsCles');

            $debut = (('' !== $request->request->get('debut')) && (null !== $request->request->get('debut'))) ? $request->request->get('debut') : null;
            $fin = (('' !== $request->request->get('fin')) && (null !== $request->request->get('fin'))) ? $request->request->get('fin') : null;
            $type = (null !== $request->request->get('type')) ? $request->request->get('type') : 'allmails';

            //Récupération des mails selon les filtres
            $mails = $this->getDoctrine()->getRepository('MailBundle:MailPeople')->findFilterMailList($user, $motsCles, $debut, $fin, $priorite, $tbox, $type);

            if( ! is_null($debut) ){
                $debut = new \DateTime($debut);
                $fin = new \DateTime($fin);
                $debut =  $debut->format('Y-m-d'). ' / '.$fin->format('Y-m-d');
            }

            $em = $this->getDoctrine()->getManager();
            $filtre = $em->getRepository('MailBundle:MailFiltreSession')->findOneBy(array('idUser' =>$user));

            if($filtre == null){
                $filtre = new MailFiltreSession();
            }
            $nomFiltre = 'filtreMail'.$user;

            if( $nomFiltre !== ""){
                $filtre->setIdUser($user);
                $filtre->setFiltreMc($motsCles);
                $filtre->setFiltrePeriode($debut);
                $filtre->setFiltreTbox(($tbox == null) ? null : implode(',', $tbox));
                $filtre->setFiltrePriorite(($priorite == null) ? null : implode(',', $priorite));
                $filtre->setDateFiltre(new \DateTime());
                $filtre->setNomFiltre($nomFiltre);

                $em->persist($filtre);
                $em->flush();
            }

            $response['table'] = $this->forward('MailBundle:ListeMail:filter', array('mails' => $mails, 'type' => $type, "new_today" => count($mails)))->getContent();
            $response['mails'] = count($mails);
            return new Response(json_encode($response), 200, ['Content-Type' => 'text/html']);
        }
    }

    public function DraftMailAction(){
        $user    = $this->getUser();
        $manager = $this->getDoctrine()->getManager();

        $dataTrash = $manager->getRepository('MailBundle:MailTrash')->dataTrash($user);
        //$mails     = $manager->getRepository('MailBundle:MailPeople')->findByMailsList($user, $dataTrash);
        $draft     = $manager->getRepository('MailBundle:MailMessage')->findByMessage($user);

        $tbox      = $manager->getRepository('MailBundle:ParamMailTbox')->findAll();
        $priorites = $manager->getRepository('MailBundle:ParamMailPriorites')->findAll();
        $nonlus    = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash);
        $all_out   = $manager->getRepository('MailBundle:MailPeople')->findOutbox($user, $dataTrash);
        $trash_count = $manager->getRepository('MailBundle:MailTrash')->countTrash($user);
        $draft_count = $manager->getRepository('MailBundle:MailMessage')->countDraft($user);

        $spam = $this->getNotification();
        $jour   = new \DateTime();
        $allmails = count($all_out) + $trash_count + $spam['spam'] + count($nonlus);
        return $this->render('MailBundle:Default:mails/list_draft_trash.html.twig', array( 'draft'=>$draft,
            'jour' => $jour, 'all_mails' =>$allmails, 'nonlus' => count($nonlus), 'spam' => $spam['spam'],
            'tbox' => $tbox, 'priorites' => $priorites, 'type' => 'draft', 'mail_trash'=>$trash_count, 
            'title'=>$this->get('translator')->trans('list_mail.all'), 'all_out'=>count($all_out), 'mail_draft'=>$draft_count ));
      }

      public function trashMailListAction()
      {
         $user    = $this->getUser();
         $manager = $this->getDoctrine()->getManager();

        $dataTrash = $manager->getRepository('MailBundle:MailTrash')->dataTrash($user);
        //$mails     = $manager->getRepository('MailBundle:MailPeople')->findByMailsList($user, $dataTrash);
        $trash     = $manager->getRepository('MailBundle:MailTrash')->findByTrashList($user);
        $tbox      = $manager->getRepository('MailBundle:ParamMailTbox')->findAll();
        $priorites = $manager->getRepository('MailBundle:ParamMailPriorites')->findAll();
        $nonlus    = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash);
        $all_out   = $manager->getRepository('MailBundle:MailPeople')->findOutbox($user, $dataTrash);
        $trash_count = $manager->getRepository('MailBundle:MailTrash')->countTrash($user);
        $draft_count = $manager->getRepository('MailBundle:MailMessage')->countDraft($user);

        $spam = $this->getNotification();
        $jour   = new \DateTime();
        $allmails = count($all_out) + $trash_count + $spam['spam'] + count($nonlus);
        return $this->render('MailBundle:Default:mails/liste_mails_trash.html.twig', array( 'trash'=>$trash,
            'jour' => $jour, 'all_mails' =>$allmails, 'nonlus' => count($nonlus), 'spam' => $spam['spam'],
            'tbox' => $tbox, 'priorites' => $priorites, 'type' => 'trash',
            'mail_trash'=>$trash_count, 'title'=>$this->get('translator')->trans('list_mail.all'), 'all_out'=>count($all_out), 'mail_draft'=>$draft_count ));
      }

      public function filterPaginationAction(Request $request){
          $mails = $request->get('mails');
          $jour  = new \DateTime();
          return $this->render('MailBundle:Default:modulesUsed/mails_table.html.twig', array( 'mails'  => $mails,
             'jour' => $jour));
      }

    protected function pagination($mails, $request, $end = null){
        $paginator  = $this->get('knp_paginator');
        $end = (is_null($end)) ? 25 : $end;
        $page = $paginator->paginate($mails, $request->query->getInt('page', 1), $end);
        return array(
            'mails' => $page );
    }
  
}