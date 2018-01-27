<?php

namespace UsersBundle\Controller;

use UsersBundle\Entity\UserClient;
use AppBundle\Entity\Classes\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Userclient controller.
 *
 * @Route("user")
 */
class UserClientController extends Controller
{
    /**
     * Lists all userClient entities.
     *
     * @Route("/log", name="user_log")
     * @Method("GET")
     */
    public function logAction(Request $request)
    {
       // getting the language data
        $user = $request->get('log');
        if( $user != null ) {
            $this->get('session')->set('log', $user);
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $user]);
            $lang = $em->getRepository('AppBundle:Common\Langage')->findOneBy(['id' => $user->getLangage()]);
            $this->get('session')->set('_locale', $lang->getAbr());
        }

        $bu = $request->get('bu');
        if( $bu != null )
            $this->get('session')->set('BU', $bu);

        if( $bu == 0)
            $this->get('session')->remove('BU');

        // on tente de rediriger vers la page d'origine
        $url = $request->headers->get('referer');
        if(empty($url))
        {
            $url = $this->get('router')->generate('homepage');
        }
     
        return $this->redirect($url);
    }

    /**
     * Lists all userClient entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $userClients = $em->getRepository('UsersBundle:UserClient')->findAll();

        return $this->render('UsersBundle:userclient:index.html.twig', array(
            'userClients' => $userClients,
        ));
    }

    /**
     * Creates a new userClient entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $userClient = new UserClient();
        $form = $this->createForm('UsersBundle\Form\UserClientType', $userClient, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /* entity manager */
            $em = $this->getDoctrine()->getManager();
            /* pour code */
            \AppBundle\Entity\Classes\Utils::setCode($userClient);

            // le fichier document à télécharger
            $dir = $this->getParameter('upload_dir');
            $userClient->setPhoto(Utils::Upload_file($userClient->getPhoto(), $dir));

            /* date creation */
            $userClient->setDateCreation(new \DateTime('now'));
            /* status is always enable */
            // $userClient->setStatus(1);
            
            /* persist and flush */
            $em->persist($userClient);
            $em->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('UsersBundle:userclient:new.html.twig', array(
            'userClient' => $userClient,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a userClient entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(UserClient $userClient)
    {
        $deleteForm = $this->createDeleteForm($userClient);

        return $this->render('UsersBundle:userclient:show.html.twig', array(
            'userClient' => $userClient,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing userClient entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UserClient $userClient)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($userClient);

        // relation fonctionnelle
        $relation = $em->getRepository('UsersBundle:RelationBusinessUser')->findOneBy(['id' => $userClient->getId()]);
        if( $relation ) {
            $userClient->setIDBusinessUnit($relation->getIDBusinessUnit());
            $userClient->setIDRelationFonctionnelle($relation->getIDRelationFonctionnelle());
        }

        $editForm = $this->createForm('UsersBundle\Form\UserClientType', $userClient, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        // dump($userClient); exit;

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // le fichier à télécharger
            $dir = $this->getParameter('upload_dir');
            $userClient->setPhoto(Utils::Upload_file($userClient->getPhoto(), $dir));

            $em->persist($userClient);
            $em->flush();

            $bu_id = $userClient->getIDBusinessUnit();
            $rel_f = $userClient->getIDRelationFonctionnelle();
            if( $bu_id && $rel_f ) {
                $relation = $em->getRepository('UsersBundle:RelationBusinessUser')->findOneBy(['id' => $userClient->getId()]);
                if( !$relation ) {
                    $relation = new RelationBusinessUser();
                    $relation->setIdUser($userClient->getId());
                }

                $relation->setIDBusinessUnit($bu_id);
                $relation->setIDRelationFonctionnelle($rel_f);

                $em->persist($relation);
                $em->flush();
            }

            return $this->redirectToRoute('user_edit', array('id' => $userClient->getId()));
        }

        //============= les tabs
        $tabs = [];
        // tabs mail
        $tabs['mail'] = $this->InBoxMail($userClient->getId());
        // tabs agenda
        $tabs['agenda'] = $this->Agenda($userClient->getId());
        // tabs doc
        $tabs['docs'] = $em->getRepository('UsersBundle:UserDocs')->findBy(['iDUser' => $userClient->getId()]);
        // tabs note
        $tabs['notes'] = $em->getRepository('UsersBundle:UserNotes')->findBy(['idUser' => $userClient->getId()]);

        return $this->render('UsersBundle:userclient:edit.html.twig', array(
            'tabs' => $tabs,
            'userClient' => $userClient,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a userClient entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UserClient $userClient)
    {
        $form = $this->createDeleteForm($userClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userClient);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a userClient entity.
     *
     * @param UserClient $userClient The userClient entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserClient $userClient)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $userClient->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /* data form */
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'relationsFonctionnelles' => $em->getRepository('UsersBundle:Back\UsersParamRelationsFonctions')->findAll(),
            'businessunits' => $em->getRepository('UsersBundle:BusinessUnit')->findAll(),
            'natures' => $em->getRepository('UsersBundle:Back\UsersParamNature')->findAll(),
            'langages' =>  $em->getRepository('AppBundle:Common\Langage')->findAll(),
            'user_compte' =>  $em->getRepository('UsersBundle:Users')->findAll(),
            'pays' =>  $em->getRepository('ClientBundle:Pays')->findBy(['ouvert' => 1]),
            'user_param_groupe' =>  $em->getRepository('UsersBundle:Back\UsersParamGroupe')->findAll()// ->findBy(['ouvert' => 1]),
        ];
    }

    private function Agenda ($user_id) {
        return $this->getDoctrine()->getRepository('ProjectBundle:Agenda\AgendaWorker')->findCrmEtapesOperationsByUser($user_id);
    }

    protected function getUser () {
        return $this->getDoctrine()->getRepository('UsersBundle:Userclient')->findOneBy(['id' => $this->container->get('session')->get('log')]);
    }

    private function InBoxMail ($user_id) {
        $manager = $this->getDoctrine()->getManager();
        $user = $manager->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $user_id]);

        $dataTrash  = $this->getDoctrine()->getRepository('MailBundle:MailTrash')->dataTrash($user);
        $mails     = $manager->getRepository('MailBundle:MailPeople')->findInbox($user, $dataTrash);         

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

        // $spam = $this->getNotification();

        $jour   = new \DateTime();
        // $allmails = count($all_out) + $trash_count + $spam['spam'] + count($mails);
        return ['mails'  => $mails,
            'jour'   => $jour, 
            // 'all_mails' =>$allmails, 
            'pjs'=>$pjs, 
            'nonlus' => count($mails),
            'all_out'=>count($all_out), 
            // 'spam' => $spam['spam'],
            'tbox' => $tbox, 
            'priorites' => $priorites, 
            'type' => 'inbox',
            'mail_trash'=>$trash_count, 
            'title'=>$this->get('translator')->trans('list_mail.my_inbox'), 
            'mail_draft'=>$mail_draft, "new_today" => count($mails)
        ];
    }
}
