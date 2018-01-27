<?php
/**
 * Created by PhpStorm.
 * User: Madatic Dev1
 * Date: 18/09/2017
 * Time: 14:11
 */

namespace MailBundle\Form\Handler;

use MailBundle\Entity\MailMessage;

class recipientDraftHandler{
    public function getDraft($request, $user, $manager, $obj){
        $etat = false;
        if(!empty($request->request->get('save_brouillon')) && $request->request->get('save_brouillon') == 'save_brouillon') {
            $mailMessage = new MailMessage();

            $mailMessage->setUser($user->getId());
            $mailMessage->setVersion(0);
            $message = $obj->message;
            $flag_signature = $request->request->get('signature');
            $signature = "";
         

            if(empty($message)) {
                
            }else {
                if($flag_signature == "yes") {
                    $signature = $request->request->get('signature-content');
                    $message .= "".$signature;
                    $mailMessage->setTexte($message);
                }else {
                    $mailMessage->setTexte($message);
                }
            }

            $manager->persist($mailMessage);

            $etat = true;
        }

        return $etat;
    }
}