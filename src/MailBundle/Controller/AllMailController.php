<?php


namespace MailBundle\Controller;

use Protec\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class AllMailController extends Controller{

    public function getAllMailAction(){

        $manager = $this->getDoctrine()->getManager();
        $user    = $this->getUser();

        /*$all = $manager->createQuery('SELECT count(mp.id) FROM MailBundle:MailPeople mp ')->getSingleScalarResult();
        $non_lus = $manager->createQuery('SELECT count(mp.id) FROM MailBundle:MailPeople mp WHERE mp.lu = 0')->getSingleScalarResult();*/
        
        $dataTrash  = $manager->getRepository('MailBundle:MailTrash')->dataTrash($user);
        $mails     = $manager->getRepository('MailBundle:MailPeople')->findByMailsList($user, $dataTrash);
        $nonlus    = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash);
        $all_out   = $manager->getRepository('MailBundle:MailPeople')->findOutbox($user, $dataTrash);
        $trash_count = $manager->getRepository('MailBundle:MailTrash')->countTrash($user);
        $mail_draft = $manager->getRepository('MailBundle:MailMessage')->countDraft($user);
        $spam = $manager->createQuery('SELECT count(ms.id) FROM MailBundle:MailSpam ms ')->getSingleScalarResult();

        return new Response(json_encode(array(
            'all_mails'  => count($mails),
            'non_lus' => count($nonlus),
            'all_out' => count($all_out),
            'mail_trash'=>$trash_count,
            'mail_draft'=>$mail_draft,
            'spam' => $spam
        )));
        /*return $this->render('MailBundle:Default:nombre_mails.html.twig', array(
                'all_mails'  => $all,
                'non_lus' => $non_lus,
                'spam' => $spam
            )
        );*/

    }

    public function getNewMailAction(){

        if(!is_object($this->get('security.token_storage')->getToken()->getUser()))
        {
            return new Response('');
        }

        $user   = $this->getUser();
        $manager = $this->getDoctrine()->getManager();
        $jour   = new \DateTime();

        $dataTrash  = $manager->getRepository('MailBundle:MailTrash')->dataTrash($user);
        $mails  = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash);

        $nonlus = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash, true);
        $new_today  = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash, false, true);

        return $this->render('MailBundle:Default:mails/nombre_mails.html.twig', array(
                'non_lus' => count($nonlus),
                'mails' => $mails,
                'jour' => $jour,
                'new_today' => count($new_today)
            )
        );
    }
}
?>