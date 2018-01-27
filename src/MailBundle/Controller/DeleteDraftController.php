<?php
/**
 * Created by PhpStorm.
 * User: Madatic dev2
 * Date: 08/09/2017
 * Time: 08:30
 */

namespace MailBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeleteDraftController extends Controller
{
    public function removeReadAction($id){
        $manager = $this->getDoctrine()->getManager();

        $draft = $manager->getRepository('MailBundle:MailMessage')->find($id);

        $manager->remove($draft);
        $manager->flush();

        return $this->redirectToRoute('mail_draft');
    }
}