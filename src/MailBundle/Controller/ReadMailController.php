<?php
/**
 * Created by PhpStorm.
 * User: Madatic dev3
 * Date: 05/09/2017
 * Time: 23:12
 */

namespace MailBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MailBundle\Entity\Mail;
use MailBundle\Entity\MailPJ;
use MailBundle\Form\Type\MailPJType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use PrintPDFBundle\Services\Html2Pdf;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReadMailController extends Controller
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

    public function readAction($id){
        $jour      = new \DateTime();
        $user      = $this->getUser();
        $manager   = $this->getDoctrine()->getManager();
        $listeUsers = $manager->getRepository('UsersBundle:UserClient')->findAll();
        $mail_read = $manager->getRepository('MailBundle:MailPeople')->findByIdMP($id);

        $parent = ($mail_read[1] ==0) ? $id : $mail_read[1];

        $dataTrash  = $manager->getRepository('MailBundle:MailTrash')->dataTrash($user);
        $read       = $manager->getRepository('MailBundle:Mail')->getParent($parent);

        $mailPeople = $read->getMailPeople()->toArray()[0];
        $read->mp   = $mailPeople;

        if(count($read->getMailPJ()->toArray()) >0){
            $mailPJ   = $read->getMailPJ()->toArray()[0];
            $read->pj = $mailPJ;
        }

        $read->mailto     = $this->getMailRecipient($parent,0,0)['mailto'];
        $read->mailCopy   = $this->getMailRecipient($parent,1,0)['mailto'];
        $read->mailHidden = $this->getMailRecipient($parent,0,1)['mailto'];

        $children = $manager->getRepository('MailBundle:Mail')->getMailEnfant($parent);

        $table = array();
        if($children){
            foreach($children as $child){
                $tab = array();
                $tab['ml'] = $child;

                $mailPeople = $child->getMailPeople()->toArray()[0];
                $tab['mlp'] = $mailPeople;

                if(count($child->getMailPJ()->toArray()) >0){
                    $mailPJ = $child->getMailPJ()->toArray()[0];
                    $tab['mlpj'] = $mailPJ;
                }

                $tab['mailto']     = $this->getMailRecipient($parent,0,0)['mailto'];
                $tab['mailCopy']   = $this->getMailRecipient($parent,1,0)['mailto'];
                $tab['mailHidden'] = $this->getMailRecipient($parent,0,1)['mailto'];
                array_push($table, $tab);
            }
        }
        $read->children = $table;

        $tbox        = $manager->getRepository('MailBundle:ParamMailTbox')->findAll();
        $priorites   = $manager->getRepository('MailBundle:ParamMailPriorites')->findAll();
        $mails       = $manager->getRepository('MailBundle:MailPeople')->findByMailsList($user, $dataTrash);
        $nonlus      = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash);
        $all_out     = $manager->getRepository('MailBundle:MailPeople')->findOutbox($user, $dataTrash);
        $trash_count = $manager->getRepository('MailBundle:MailTrash')->countTrash($user);
        $mail_draft  = $manager->getRepository('MailBundle:MailMessage')->countDraft($user);



        $recipients ="";
        foreach($listeUsers as $recip){
            $recipients .= '<option value="'.$recip->getId().'_'.$recip->getEmail().'">'.$recip->getFirstname().'-'.$recip->getEmail().'</option>';
        }


        if($mailPeople->getLu() == 0 && $mailPeople->getUserTo()->getId() == $user->getId()){
            if($mailPeople->getIdOriginemail() != 0){
                foreach($read->children as $m) {
                    if($m['ml']->getUser()->getId() != $user->getId()) {
                        $manager->getRepository('MailBundle:Mail')->markRead($m['ml']->getId());
                    }
                }
            }else{
                $manager->getRepository('MailBundle:Mail')->markRead($id);
            }
        }

        $form = $this->createFormBuilder(new Mail())
            ->add('sujet', TextType::class, array('attr'=>array('class'=>"form-control", 'placeholder'=>'Add subject')))
            ->add('message', TextareaType::class, array('required'=>true, 'attr'=>array('class'=>'replay')))
            ->getForm();

        $mailpj  = new MailPJ();
        $form_pj = $this->createForm(MailPJType::class, $mailpj);

        $tmp = $this->getNotification();
        $allmails = count($all_out) + $trash_count + $tmp['spam'] + count($nonlus);
        return $this->render('MailBundle:Default:mails/mail_read.html.twig', array(
            'read' => $read, 'jour'=>$jour, 'all_out' => count($all_out), 'spam' => $tmp['spam'], 'all_mails' =>$allmails, 'nonlus' => count($nonlus),
            'tbox' => $tbox, 'priorites' => $priorites, 'mail_trash'=>$trash_count, 'form' => $form->createView(),
            'form_pj' => $form_pj->createView(), 'recipients' => $recipients, 'mail_draft' => $mail_draft
        ));
    }

    protected function getNotification(){
          $user = $this->getUser();

          $manager = $this->getDoctrine()->getManager();
          $all     = $manager->createQuery("SELECT count(mp.id) FROM MailBundle:MailPeople mp WHERE mp.userTo = '$user' ")->getSingleScalarResult();
          $non_lus = $manager->createQuery("SELECT count(mp.id) FROM MailBundle:MailPeople mp WHERE mp.lu = 0 AND mp.userTo = '$user'")->getSingleScalarResult();
          $spam    = $manager->createQuery("SELECT count(ms.id) FROM MailBundle:MailPeople mp JOIN MailBundle:MailSpam ms WITH mp.mail = ms.mail WHERE mp.userTo = '$user'")->getSingleScalarResult();
  
          return array(
              'all_mails'  => $all,
              'non_lus' => $non_lus,
              'spam' => $spam
          );
    }

    public function getMailRecipient($idMail, $copy=0, $hidden=0){
        $manager = $this->getDoctrine()->getManager();
        $str     = "SELECT 
                        GROUP_CONCAT(DISTINCT mp.to1) as mailto 
                    FROM 
                        MailBundle:MailPeople mp 
                    JOIN 
                        MailBundle:Mail m WITH mp.mail = m.id 
                    WHERE 
                        mp.flagCC=$copy 
                    AND 
                        mp.flagCCI=$hidden 
                    AND 
                        m.id=$idMail
                    ";

        $qb = $manager->createQuery($str);
        return $qb->getOneOrNullResult();
    }

    public function getForward($idMail)
    {
        $manager = $this->getDoctrine()->getManager();        
        $ifCount = "SELECT COUNT(DISTINCT mp1.idOriginemail) FROM MailBundle:MailPeople mp1 WHERE mp1.idOriginemail = $idMail";
        $qb0 = $manager->createQuery($ifCount);
        $cond = $qb0->getOneOrNullResult();

        if($cond[1] >0) {
            $if0 = "SELECT MAX(mp2.id) FROM MailBundle:MailPeople mp2 WHERE mp2.idOriginemail = $idMail";
        }            
        else {
            $if0 = "SELECT MAX(mp3.id) FROM MailBundle:MailPeople mp3 WHERE mp3.mail = $idMail";
        }

        $qb1 = $manager->createQuery($if0);
        $result = $qb1->getOneOrNullResult();

        $str = "SELECT 
                    mp.from1, 
                    mp.to1, 
                    m.daty, 
                    m.sujet, 
                    m.message, 
                    ms.texte 
                FROM 
                    MailBundle:MailPeople mp 
                JOIN 
                    MailBundle:Mail m WITH mp.mail = m.id 
                JOIN 
                    MailBundle:MailMessage ms WITH ms.mail = m.id 
                WHERE mp.id = $result[1]
                ";

        $qb2 = $manager->createQuery($str);

        return $qb2->getOneOrNullResult();
    }

    public function ForwardMailAction(Request $request)
    {
        if(!$request->isMethod('POST'))
            return $this->redirectToRoute('mail_list');

        if($idMail = $request->request->get('forward')){
            $result = $this->getForward($idMail);            
            $str = "---------- Forwarded message ----------<br/>";
            $str .= "From: &lt;".$result['from1']."&gt;<br/>";
            $str .= "Date: ".$result['daty']->format('Y-m-d')."<br/>";
            $str .= "Subject: Re: ".$result['sujet']."<br/>";
            $str .= "To: &lt;".$result['to1']."&gt; <br/><br/>";
            $str .= $result['texte'];
        }

        $response = new JsonResponse();
        return $response->setData($str);
    }

    
    public function printMailAction($id)
    {        
        $jour      = new \DateTime();
        $manager   = $this->getDoctrine()->getManager();
        $mail_read = $manager->getRepository('MailBundle:MailPeople')->findByIdMP($id);
        $parent = ($mail_read[1] ==0) ? $id : $mail_read[1];
        $read       = $manager->getRepository('MailBundle:Mail')->getParent($parent);
        $mailPeople = $read->getMailPeople()->toArray()[0];
        $read->mp   = $mailPeople;
        $read->mailto     = $this->getMailRecipient($parent,0,0)['mailto'];
        $read->mailCopy   = $this->getMailRecipient($parent,1,0)['mailto'];
        $read->mailHidden = $this->getMailRecipient($parent,0,1)['mailto'];

        $children = $manager->getRepository('MailBundle:Mail')->getMailEnfant($parent);

        $table = array();
        if($children){
            foreach($children as $child){
                $tab = array();
                $tab['ml'] = $child;

                $mailPeople = $child->getMailPeople()->toArray()[0];
                $tab['mlp'] = $mailPeople;

                if(count($child->getMailPJ()->toArray()) >0){
                    $mailPJ = $child->getMailPJ()->toArray()[0];
                    $tab['mlpj'] = $mailPJ;
                }

                $tab['mailto']     = $this->getMailRecipient($parent,0,0)['mailto'];
                $tab['mailCopy']   = $this->getMailRecipient($parent,1,0)['mailto'];
                $tab['mailHidden'] = $this->getMailRecipient($parent,0,1)['mailto'];
                array_push($table, $tab);
            }
        }
        $read->children = $table;
        $is_children = count($read->children);
        $template = $this->renderView('MailBundle:Default:mails/mail_read.pdf.twig', array('jour'=>$jour, 'read' => $read, 'is_children' => $is_children));
        $html2pdf = $this->get('print_html2pdf');

        $response = new Response($html2pdf->create($template), 
            array(
        'Content-Type'          => 'application/pdf',
        'Content-Disposition'   => 'inline; filename="mail'.$parent.'.pdf"'));

        return $response;
    }

    public function readDraftAction($id) {
        $jour      = new \DateTime();
        $user      = $this->getUser();
        $manager   = $this->getDoctrine()->getManager();
        $listeUsers = $manager->getRepository('UsersBundle:UserClient')->findAll();

        $dataTrash  = $manager->getRepository('MailBundle:MailTrash')->dataTrash($user);

        $tbox        = $manager->getRepository('MailBundle:ParamMailTbox')->findAll();
        $priorites   = $manager->getRepository('MailBundle:ParamMailPriorites')->findAll();

        $nonlus      = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash);
        $all_out     = $manager->getRepository('MailBundle:MailPeople')->findOutbox($user, $dataTrash);
        $trash_count = $manager->getRepository('MailBundle:MailTrash')->countTrash($user);
        $mail_draft = $manager->getRepository('MailBundle:MailMessage')->countDraft($user);

        $tmp = $this->getNotification();
        $allmails = count($all_out) + $trash_count + $tmp['spam'] + count($nonlus);

        $mailMessage = $manager->getRepository('MailBundle:MailMessage')->find($id);

        return $this->render('MailBundle:Default:mails/draft_read.html.twig', array(
            'jour'=>$jour, 'all_out' => count($all_out),'draft' => $mailMessage, 'spam' => $tmp['spam'], 'all_mails' =>$allmails, 'nonlus' => count($nonlus), 'user' => $user,
            'tbox' => $tbox, 'priorites' => $priorites, 'mail_trash'=>$trash_count, 'mail_draft' => $mail_draft
        ));
    }
}