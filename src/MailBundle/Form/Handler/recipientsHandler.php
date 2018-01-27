<?php
/**
 * Created by PhpStorm.
 * User: Madatic Dev1
 * Date: 17/09/2017
 * Time: 18:20
 */

namespace MailBundle\Form\Handler;

use MailBundle\Entity\Mail;
use MailBundle\Entity\MailPeople;
use MailBundle\Entity\ParamMailTbox;
use MailBundle\Entity\ParamMailPriorites;
use MailBundle\Entity\MailMessage;
use MailBundle\Entity\MailPJ;

class recipientsHandler {

    protected $piece_jointe;

    public function __construct($piece_jointe){
        $this->piece_jointe = $piece_jointe;
    }

    /**
     * @param $request
     * @param $user
     * @param $codemail
     * @param $obj
     * @param $manager
     * @param $mpj
     * @param bool $recip
     * @return bool
     */
    public function getRecipient ($request, $user, $codemail, $obj, $manager, $mpj, $recip=false){
        if($request->request->get('idTBox'))
            $idTbox = $request->request->get('idTBox');
        else $idTbox = $obj->itbox;

        $tbox = $manager->find('MailBundle:ParamMailTbox', $idTbox);

        $flag_signature = $request->request->get('signature');
        $message = $obj->message;
        $signature = "";

        $mail = new Mail();
        $mail->setTbox($tbox);
        $mail->setDaty($obj->daty);
        $mail->setKeywords('');
        $mail->setCodemail($codemail);
        $mail->setIdUserAgenda(0);
        $mail->setIdProjetTask(0);
        $mail->setIdCRMTask(0);
        $mail->setIdStrategie(0);
        $mail->setIdChantier(0);
        $mail->setIdAffaire(0);
        $mail->setLangue(0);
        $mail->setVersion(0);
        $mail->setDatesaisie($obj->daty);
        $mail->setUser($user);
        $mail->setFlagAR($obj->flagAR);
        $mail->setFlagNotifEMAIL($obj->notifMail);
        $mail->setFlagNotifSMS($obj->notifSMS);
        $mail->setSujet($obj->sujet);
        $mail->setPriorite($obj->priorite);

        $mailMsg = new MailMessage();
        $mailMsg->setUser($user->getId());
        $mailMsg->setMail($mail);
        $mailMsg->setVersion(0);

        if($flag_signature == "yes") {

            $signature = $request->request->get('signature-content');

            if(!empty($message)){

                $message .= $signature;

                if (strlen($message) > 250) 
                    $sort_msg = strip_tags(substr(str_replace("</p>"," </p>",$message), 0, 250));
                else $sort_msg = strip_tags(str_replace("</p>"," </p>",$message));

                $mail->setMessage($sort_msg);
                $mailMsg->setTexte($message);
            }
            else{
                $mail->setMessage("");
                $mailMsg->setTexte("");
            }

        }else {

            if(!empty($message)){
                if (strlen($message) > 250) 
                    $sort_msg = strip_tags(substr(str_replace("</p>"," </p>",$message), 0, 250));
                else $sort_msg = strip_tags(str_replace("</p>"," </p>",$message));

                $mail->setMessage($sort_msg);
                $mailMsg->setTexte($message);
            }
            else{
                $mail->setMessage("");
                $mailMsg->setTexte("");
            }
        }

        $manager->persist($mailMsg);
        $manager->persist($mail);

        $this->piece_jointe->getPieceJointe($request, $manager, $mail, $mpj);
        $this->piece_jointe->getDropboxLink($request, $manager, $mail);

        $this->getRecipientTo($request, $user, $obj, $manager, $mail, 1, $recip);
        $this->getRecipientCopy($request, $user, $obj, $manager, $mail, 1, $recip);
        $this->getRecipientHidden($request, $user, $obj, $manager, $mail, 1);

        $this->getRecipientTo($request, $user, $obj, $manager, $mail, 2, $recip);
        $this->getRecipientCopy($request, $user, $obj, $manager, $mail, 2, $recip);
        $this->getRecipientHidden($request, $user, $obj, $manager, $mail, 2);

        return false;
    }

    
    /**
     * @param $request
     * @param $user
     * @param $obj
     * @param $manager
     * @param $mail
     * @param $way
     * @param bool $recip
     * @return bool
     */
    private function getRecipientTo($request, $user, $obj, $manager, $mail, $way, $recip=false)
    {
        if(count($request->request->get('to_recipient')) !=0 || $recip === true){
            if($request->request->get('to_recipient')){
                foreach($request->request->get('to_recipient') as $key=>$value){
                    $recipient = explode("_",$value);
                    $userTo = $manager->getRepository('UsersBundle:UserClient')->find((int)$recipient[0]);
                    $this->getMailpeople($manager, $mail, $way, $userTo, $obj, $user, "to");
                }
            }
            else if($obj->reply == 'reply' || $obj->reply == 'reply_all') {
                $mailpeople = new MailPeople();                
                if($obj->mailto !== null) 
                    $_userTo = (int)$obj->mailto;
                else 
                    $_userTo = (int)$obj->userto;

                $rpto_userTo = $manager->getRepository('UsersBundle:UserClient')->find($_userTo);
                $this->getMailpeople($manager, $mail, $way, $rpto_userTo, $obj, $user, "to");
            }
            else if ($obj->reply == 'mail_forward') {
                foreach ($obj->fwdto as $key => $value) {
                    $recipient = explode("_",$value);
                    $userTo = $manager->getRepository('UsersBundle:UserClient')->find((int)$recipient[0]);
                    $this->getMailpeople($manager, $mail, $way, $userTo, $obj, $user, "to");
                }
            }

            return $manager;
        }
        return false;
    }

    
    /**
     * @param $request
     * @param $user
     * @param $obj
     * @param $manager
     * @param $mail
     * @param $way
     * @param bool $recip
     * @return bool
     */
    private function getRecipientCopy($request, $user, $obj, $manager, $mail, $way, $recip=false){
        if(count($request->request->get('copyto_recipient')) !=0 || $recip === true){
            if($request->request->get('copyto_recipient')){
                foreach($request->request->get('copyto_recipient') as $key=>$value){
                    $recipient = explode("_",$value);
                    $userCp = $manager->getRepository('UsersBundle:UserClient')->find((int)$recipient[0]);
                    $this->getMailpeople($manager, $mail, $way, $userCp, $obj, $user, "copy");
                }
                return $manager;
            }
            else if($obj->reply == 'reply_all') {
                if($obj->mailcc !== null){
                    $mailcc = explode(',',$obj->mailcc);
                    foreach($mailcc as $key=>$value){
                        if($user->getEmailCanonical() != $value){
                            $rpcc_userTo = $manager->getRepository('UsersBundle:UserClient')->find((int)$value);
                            $this->getMailpeople($manager, $mail, $way, $rpcc_userTo, $obj, $user, "copy");
                        }                        
                    }
                }
            }            
        }
        return false;
    }

    
    /**
     * @param $request
     * @param $user
     * @param $obj
     * @param $manager
     * @param $mail
     * @param $way
     * @return bool
     */
    private function getRecipientHidden($request, $user, $obj, $manager, $mail, $way){
        if(count($request->request->get('hiddencopyto_recipient')) !=0){
            foreach($request->request->get('hiddencopyto_recipient') as $key=>$value){
                $recipient = explode("_",$value);
                $userHd = $manager->getRepository('UsersBundle:UserClient')->find((int)$recipient[0]);
                $this->getMailpeople($manager, $mail, $way, $userHd, $obj, $user, "hidden");
            }           

            return $manager;
        }
        return false;
    }

    
    /**
     * @param $manager
     * @param $mail
     * @param $way
     * @param $userTo
     * @param $user
     * @param $choix
     * @return object
     */
    private function getMailpeople($manager, $mail, $way, $userTo, $obj, $user, $choix)
    {
        $mailpeople = new MailPeople();
        $mailpeople->setUserTo($userTo);
        $mailpeople->setUserFrom($user);
        $mailpeople->setIdOriginemail(0);
        $mailpeople->setWay($way);
        $mailpeople->setDateLecture($obj->daty);
        $mailpeople->setFrom1($user->getEmail());
        $mailpeople->setTo1($userTo->getEmail());        
        $mailpeople->setFlagCC(($choix == "copy") ? 1 : 0);
        $mailpeople->setFlagCCI(($choix == "hidden") ? 1 : 0);
        $mailpeople->setVersion(0);
        $mailpeople->setMail($mail);
        $mailpeople->setLu(0);
        $mail->addMailPeople($mailpeople);
        $manager->persist($mailpeople);

        return $manager;
    }
}