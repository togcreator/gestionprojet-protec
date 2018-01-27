<?php
/**
 * Created by PhpStorm.
 * User: Madatic Dev1
 * Date: 17/09/2017
 * Time: 16:58
 */

namespace MailBundle\Form\Handler;

use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class envoiMailHandler {

    protected $rh;
    protected $request;
    protected $manager;
    protected $brouillon;
    protected $currentUser;

    public function __construct($recipient_handler, $recip_draft_handler, RequestStack $request_stack, EntityManager $manager, TokenStorage $tokenStorage){
        $this->rh = $recipient_handler;
        $this->brouillon = $recip_draft_handler;
        $this->manager = $manager;
        $this->request = $request_stack->getCurrentRequest();

        //=============================================
        // $this->currentUser = $tokenStorage->getToken()->getUser();
        $this->currentUser = $this->manager->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $this->request->getSession()->get('log')]);
    }

    public function process($form, $codemail, $mpj, $mailpj){
        $form->handleRequest($this->request);
        $mpj->handleRequest($this->request);

        if($this->request->isMethod('POST') && $form->isSubmitted()){             
            $this->onSuccess($form, $this->request, $this->currentUser, $codemail, $mailpj);
            return true;
        }

        return false;
    }

    public function getValues($form)
    {
        $obj = new \stdClass();
        $obj->daty = new \DateTime('now');
        $obj->flagAR = $form->get('flagAR')->getData();
        $obj->notifMail = $form->get('flagNotifEMail')->getData();
        $obj->notifSMS = $form->get('flagNotifSMS')->getData();
        $obj->sujet = $form->get('sujet')->getData();
        $obj->message = $form->get('message')->getData();
        $obj->priorite = $form->get('priorite')->getData();

        return $obj;
    }

    public function onSuccess($form, $request, $user, $codemail, $mpj)
    {
        $obj = $this->getValues($form);
        if($this->brouillon->getDraft($request, $this->currentUser, $this->manager, $obj) == false) {
            $this->rh->getRecipient($request, $this->currentUser, $codemail, $obj, $this->manager, $mpj);
        }
        $this->manager->flush();
    }

    /**
    * Envoi mail notification projet et crm
    *
    * @return null
    */
    public function mailNotif ($sujet, $message, $codemail, $recipient) {

        $obj = new \stdClass;
        $obj->daty = new \DateTime('now');
        $obj->flagAR = 0;
        $obj->notifMail = 0;
        $obj->notifSMS = 0;
        $obj->sujet = $sujet;
        $obj->message = $message;
        $obj->itbox = 2; // information
        $obj->priorite = $this->manager->getRepository('MailBundle\Entity\ParamMailPriorites')->findOneBy(['id' => 1]);

        // for request
        $this->request->request->set('to_recipient', $recipient);
        $this->rh->getRecipient($this->request, $this->currentUser, $codemail, $obj, $this->manager, new \MailBundle\Entity\MailPJ());

        $this->manager->flush();
    }
}