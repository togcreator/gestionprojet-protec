<?php
/**
 * Created by PhpStorm.
 * User: Madatic dev3
 * Date: 07/09/2017
 * Time: 12:12
 */

namespace MailBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Protec\MailBundle\Entity\MailTrash;
use Protec\MailBundle\Entity\MailHistory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteMailsController extends Controller
{
    public function trashMailAction(Request $request) {
        $manager = $this->getDoctrine()->getManager();

        if(!$request->isMethod('POST'))
            return $this->redirectToRoute('mail_list');

        if($records = $request->request->get('mailist')){
            foreach($records as $key=>$value){
                $mailPeople = $manager->getRepository('MailBundle:MailPeople')->find($value);
                $mailTrash = new MailTrash();
                //update trash date
                $mailTrash->setDate4trash(new \DateTime());
                $mailTrash->setMailPeople($mailPeople);

                 $manager->persist($mailTrash);

            }
          
            if(count($records)>0){
                $manager->flush();
                $mail_trash = $this->getDoctrine()->getRepository('MailBundle:MailTrash')->countTrash($this->getUser());

            }

            $tab['trash_value'] = $mail_trash;
            $tab['trash_trans'] = $this->get('translator')->trans('menu_mail.navigation.trash');

            $response = new JsonResponse();
            return $response->setData($tab);
        }

    }

    public function deleteMailAction(Request $request) {
        $manager = $this->getDoctrine()->getManager();
        $date = new \DateTime();
        if(!$request->isMethod('POST'))
            return $this->redirectToRoute('mail_list');

        if($records = $request->request->get('trashlist')){
            foreach($records as $key=>$value){
                $mailPeople = $manager->getRepository('MailBundle:MailPeople')->find($value);

                $mailHistory = new MailHistory();
                $mailHistory->setIdMail($mailPeople->getMail()->getId());
                $mailHistory->setIdUserFrom($mailPeople->getUserFrom()->getId());
                $mailHistory->setIdUserTo($mailPeople->getUserTo()->getId());
                $mailHistory->setFlagCC($mailPeople->getFlagCC());
                $mailHistory->setFlagCCI($mailPeople->getFlagCCI());
                $mailHistory->setDate4History($date);
        
                $manager->persist($mailHistory);
                $manager->remove($mailPeople);

            }
            if(count($records)>0){
                $manager->flush();
                $mail_trash = $this->getDoctrine()->getRepository('MailBundle:MailTrash')->countTrash($this->getUser());
            }

            $tab['trash_value'] = $mail_trash;
            $tab['trash_trans'] = $this->get('translator')->trans('menu_mail.navigation.trash');
            $response = new JsonResponse();
            return $response->setData($tab);
        }

    }

    public function RemoveDraftAction(Request $request) {
        $manager = $this->getDoctrine()->getManager();
        $date = new \DateTime();
        if(!$request->isMethod('POST'))
            return $this->redirectToRoute('mail_list');

        if($records = $request->request->get('draftlist')){
            foreach($records as $key=>$value){
                $mailMessage = $manager->getRepository('MailBundle:MailMessage')->find($value);
                $manager->remove($mailMessage);

            }
            if(count($records)>0){
                $manager->flush();
                $mail_draft = $this->getDoctrine()->getRepository('MailBundle:MailMessage')->countDraft($this->getUser());
            }

            $tab['draft_trans'] = $this->get('translator')->trans('admin.draft');
            $tab['mail_draft']  = $manager->getRepository('MailBundle:MailMessage')->countDraft($this->getUser());
            $response = new JsonResponse();
            return $response->setData($tab);
        }

    }

    public function deleteReadAction($id){
        $manager = $this->getDoctrine()->getManager();

        $mailPeople = $manager->getRepository('MailBundle:MailPeople')->find($id);
        $mailTrash = new MailTrash();
        //update trash date
        $mailTrash->setDate4trash(new \DateTime());
        $mailTrash->setMailPeople($mailPeople);

        $manager->persist($mailTrash);
        $manager->flush();

        return $this->redirectToRoute('mail_list');
    }
}