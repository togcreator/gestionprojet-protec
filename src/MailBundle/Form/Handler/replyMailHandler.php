<?php
/**
 * Created by PhpStorm.
 * User: HP4510
 * Date: 26/09/2017
 * Time: 12:59
 */

namespace MailBundle\Form\Handler;

use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class replyMailHandler {

    protected $rh;
    protected $request;
    protected $manager;
    protected $currentUser;

    public function __construct($recipient_handler, RequestStack $request_stack, EntityManager $manager, TokenStorage $tokenStorage){
        $this->rh = $recipient_handler;
        $this->manager = $manager;
        $this->request = $request_stack->getCurrentRequest();
        $this->currentUser = $tokenStorage->getToken()->getUser();
    }

    public function process($form, $codemail, $mpj, $mailpj){
        $mpj->handleRequest($this->request);
        if($this->request->isMethod('POST')){
            $this->onSuccess($form, $this->request, $this->currentUser, $codemail, $mailpj);
            return true;
        }

        return false;
    }

    public function getValues($form)
    {
        $obj = new \stdClass();
        $obj->daty = new \DateTime('now');
        $obj->flagAR = 0;
        $obj->notifMail = 0;
        $obj->notifSMS = 0;
        $obj->reply = $form->replyStatus;
        $obj->idOrigineMail = $form->idOrigin;
        $obj->sujet = $form->subject;
        $obj->message = $form->msg;
        $obj->priorite = $form->priority;
        $obj->userto = $form->userTo;
        $obj->itbox = $form->tBox;
        $obj->mailto = $form->mailto;
        $obj->mailcc = $form->mailcc;
        $obj->fwdto = $form->fwdto;

        return $obj;
    }

    public function onSuccess($form, $request, $user, $codemail, $mpj)
    {
        $obj = $this->getValues($form);
        $this->rh->getRecipient($request, $this->currentUser, $codemail, $obj, $this->manager, $mpj, true);
        $this->manager->flush();
    }
}