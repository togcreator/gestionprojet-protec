<?php
/**
 * Created by PhpStorm.
 * User: Madatic_dev2
 * Date: 05/09/2017
 * Time: 09:45
 */

namespace MailBundle\Controller;

use MailBundle\Entity\MailMessage;
use MailBundle\Entity\MailPeople;
use MailBundle\Entity\Mail;
use MailBundle\Entity\MailPJ;
use MailBundle\Form\Type\MailPJType;
use MailBundle\Form\Type\MailType;
use UsersBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class EnvoiMailController extends Controller
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

    public function EnvoyerMailAction(Request $request) {

        $manager = $this->getDoctrine()->getManager();

        $cm = $this->container->get('codemail');
        $codemail = $cm->getCode();

        $listeUsers = $manager->getRepository('UsersBundle:UserClient')->findAll();
        $boites = $manager->getRepository('MailBundle:ParamMailTbox')->findAll();

        $recipients ="";
        foreach($listeUsers as $recip){
            $recipients .= '<option value="'.$recip->getId().'_'.$recip->getEmail().'">'.$recip->getFirstname().'-'.$recip->getEmail().'</option>';
        }

        $priorites = $manager->getRepository('MailBundle:ParamMailPriorites')->findAll();
        $recipient = $manager->getRepository('UsersBundle:UserClient')->findAll();

        $translator = $this->get('translator');

        $form = $this->createFormBuilder(new Mail())
            ->add('sujet', TextType::class, array('attr'=>array('class'=>"form-control", 'placeholder'=>$translator->trans('mail_write.form.subject.placeholder'))))
            ->add('priorite',null,array('required'=>true, 'attr'=>array('class'=>'priorite')))
            ->add('flagAR', CheckboxType::class, array('required'=>false, 'attr'=>array('class'=>'switchery')))
            ->add('flagNotifEMail', CheckboxType::class, array('required'=>false, 'attr'=>array('class'=>'switchery notif_email')))
            ->add('flagNotifSMS', CheckboxType::class, array('required'=>false, 'attr'=>array('class'=>'switchery notif_sms')))
            ->add('message', TextareaType::class, array('required'=>true, 'attr'=>array('class'=>'summernote')))
            ->getForm();

        $mailpj = new MailPJ();
        $form_pj = $this->createForm(MailPJType::class, $mailpj);

        $user = $this->getUser();

        $dataTrash  = $this->getDoctrine()->getRepository('MailBundle:MailTrash')->dataTrash($user);

        $recipient = $this->get('envoimail_handler');
        if($recipient->process($form, $codemail, $form_pj, $mailpj))
        {
            // Destinataire standard(s)
            if(!empty($request->request->get('copyto_recipient'))){
                foreach($request->request->get('to_recipient') as $to_recipient){
                    $recip = explode("_", $to_recipient);

                    //users
                    $from = $user;
                    $to = $manager->getRepository('UsersBundle:UserClient')->find((int)$recip[0]);

                    //subject
                    $sujet = $form->get('sujet')->getData();

                    //send email notification
                    if($form->get('flagNotifEMail')->getData()){
                        $this->send_mail_notif($from, $to, $sujet);
                    }
                }
            }           
            

            // Destinataire en copie
            if(!empty($request->request->get('copyto_recipient'))) {
                foreach($request->request->get('copyto_recipient') as $to_recipient){
                    $recip = explode("_", $to_recipient);

                    //users
                    $from = $user;
                    $to = $manager->getRepository('UsersBundle:UserClient')->find((int)$recip[0]);

                    //subject
                    $sujet = $form->get('sujet')->getData();

                    //send email notification
                    if($form->get('flagNotifEMail')->getData()){
                        $this->send_mail_notif($from, $to, $sujet);
                    }
                }
            }

            // Destinataire en copie cachée
            if(!empty($request->request->get('hiddencopyto_recipient'))) {
                foreach($request->request->get('hiddencopyto_recipient') as $to_recipient){
                    $recip = explode("_", $to_recipient);

                    //users
                    $from = $user;
                    $to = $manager->getRepository('UsersBundle:UserClient')->find((int)$recip[0]);

                    //subject
                    $sujet = $form->get('sujet')->getData();

                    //send email notification
                    if($form->get('flagNotifEMail')->getData()){
                        $this->send_mail_notif($from, $to, $sujet);
                    }
                }
            }

            $mails = $manager->getRepository('MailBundle:MailPeople')->findByMailsList($user, $dataTrash);
            return $this->redirectToRoute('mail_list', array('mails'=>$mails));
        }

        $tbox        = $manager->getRepository('MailBundle:ParamMailTbox')->findAll();
        $mails       = $manager->getRepository('MailBundle:MailPeople')->findByMailsList($user, $dataTrash);
        $nonlus      = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash);
        $all_out     = $manager->getRepository('MailBundle:MailPeople')->findOutbox($user, $dataTrash);
        $trash_count = $manager->getRepository('MailBundle:MailTrash')->countTrash($user);
        $mail_draft  = $manager->getRepository('MailBundle:MailMessage')->countDraft($user);

        return $this->render('MailBundle:Default:mails/mail_write.html.twig', array(
            'form' => $form->createView(),
            'form_pj'    => $form_pj->createView(),
            'priorites'  => $priorites,
            'users'      => $recipient,
            'recipients' => $recipients,
            'boites'     => $boites,
            'all_mails'  => $trash_count + count($all_out) + count($nonlus),
            'nonlus'     => count($nonlus),
            'all_out'    => count($all_out),
            'tbox'       => $tbox,
            'mail_trash' => $trash_count,
            'mail_draft' => $mail_draft
        ));
    }

    function send_mail_notif($userFrom, $userTo, $sujet) {
        $data = $this->renderView(
            'MailBundle:Default:mails/email_registration.html.twig',
            array(
                'nomUserTo'    => $userTo->getFirstname(),
                'prenomUserTo' => $userTo->getLastname(),
                'nomUserFrom'  => $userFrom->getFirstname(),
                'sujet'        => $sujet
            )
        );

        $message = \Swift_Message::newInstance('PROTEC - Notification email')
            ->setFrom (array($userFrom->getEmailCanonical() => $userFrom->getFirstname()))
            ->setTo (array($userTo->getEmailCanonical() => $userTo->getFirstname()))
            ->setSubject ($sujet)
            ->setBody($data, 'text/html');

        $this->container->get('mailer')->send($message);
    }

    public function ReplyMailAction(Request $request){
        $manager = $this->getDoctrine()->getManager();
        $user    = $this->getUser();

        $dataTrash  = $manager->getRepository('MailBundle:MailTrash')->dataTrash($user);
        $mails      = $manager->getRepository('MailBundle:MailPeople')->findByMailsList($user, $dataTrash);
        $cm         = $this->container->get('codemail');
        $recipient  = $this->get('replymail_handler');
        $codemail   = $cm->getCode();

        $mailpj = new MailPJ();

        //$form = $this->createForm(MailType::class, new Mail());
        $form_pj = $this->createForm(MailPJType::class, $mailpj);

        if($request->isMethod('POST')){
            $data = $request->request->all();            
            $form = new \stdClass();
            $form->replyStatus = $data['reply_status'];
            $form->priority    = $manager->getRepository('MailBundle:ParamMailPriorites')->find((int)$data['priorite']);
            $form->idOrigin    = $data['reply_origin'];
            $form->userTo      = $data['reply_userto'];
            $form->tBox        = $data['reply_tbox'];
            $form->subject     = $data['form']['sujet'];
            $form->msg         = $data['form']['message'];
            $form->mailcc      = null;
            $form->mailto      = null; 
            $form->fwdto       = null;            

            if($form->replyStatus == 'reply_all'){
                $tab = $this->getAllRecipients($data['reply_origin']);
                $form->mailto = $tab['mailto'];                
                $form->mailcc = $tab['mailcc'];
            }

            if($form->replyStatus == 'mail_forward')
            {
                $form->fwdto = $data['fwdto'];
            }             

            $recipient->process($form, $codemail, $form_pj, $mailpj);
        }
        return $this->redirectToRoute('mail_list', array('mails'=>$mails));
    }

    public function getAllRecipients($idMail){
        $manager = $this->getDoctrine()->getManager();
        $str     = "SELECT 
                    GROUP_CONCAT(DISTINCT mp.userFrom) as mailto, GROUP_CONCAT(DISTINCT mp.userTo) as mailcc 
                    FROM MailBundle:MailPeople mp 
                    JOIN MailBundle:Mail m WITH mp.mail = m.id 
                    WHERE  m.id=".$idMail;
        $qb      = $manager->createQuery($str);
        return $qb->getOneOrNullResult();
    }
}