<?php

namespace UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use UsersBundle\Entity\Users;
use AppBundle\Entity\Front\Compaign;


/**
 * User controller.
 *
 * @Route("users")
 */
class UsersController extends Controller
{
    protected $conpaigns = array();
    protected $page_title = 'User';

    public function __construct () 
    {
        $this->compaigns['months'] = (new Compaign())->getCompaignMonths();
    }

    // dataForm
    public function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'langages' => $em->getRepository('AppBundle:Common\Langage')->findAll(),
            'roles' => $em->getRepository('ProjectBundle:Back\Roles')->findAll()
        ];
    }

    /**
     * Lists all user entities.
     *
     * @Route("/list", name="users_list")
     * @Method("GET")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('UsersBundle:Users')->findAll();

        return $this->render('UsersBundle:users:index.html.twig', array(
            'users' => $users ));
    }

    /**
     * Lists all user entities.
     *
     * @Route("/", name="users_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        /* check cookie */
        if( ($user = $this->getUser()) ) {
            $secret = $this->container->getParameter('secret');
            (new Users())->login($request, $this->getDoctrine(), $user, $secret);
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="users_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = new Users();
        $form = $this->get('fos_user.registration.form.factory')->createForm();
        $form->setData($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dateCreated
            $user->setDateCreated(new \DateTime('now'));

            // pour image
            $this->setUserImage($user);

            // type
            $this->setType($user);

            // en md5
            $user->setPassword(md5($user->getPassword()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('users_index', array('id' => $user->getId()));
        }

        return $this->render('UsersBundle:users:new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
            'compaigns' => $this->compaigns,
            'page_title' => $this->page_title
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="users_show")
     * @Method("GET")
     */
    public function showAction(Users $user)
    {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('UsersBundle:users:show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="users_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Users $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('UsersBundle\Form\UsersType', $user, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) 
        {
            // check if not md5 then has it
            // if( !\UsersBundle\Entity\Users::is_md5($user->getPassword()) )
            if( $user->getPlainPassword() )
                $user->setPassword(md5($user->getPassword()));

            // sauvegarde
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('users_edit', ['id' => $user->getId()]);
        }

        $userClients = $this->getDoctrine()->getRepository('UsersBundle:UserClient')->findUsers($user->getId());
        return $this->render('UsersBundle:users:edit.html.twig', array(
            'userClients' => $userClients,
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'compaigns' => $this->compaigns,
            'page_title' => $this->page_title
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="users_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Users $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('users_list');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param Users $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Users $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('users_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /* Image de user **/
    private function setUserImage ($user) 
    {
        /** pour l'image de user **/
        $dir = $this->getParameter('upload_dir');
        $user->setImage(\AppBundle\Entity\Classes\Utils::Upload_file($user->getImage(), $dir . '/image/'));
    }

    /* Type user */
    private function setType ($user) 
    {
        $em = $this->getDoctrine()->getManager();
        $user->setRole($em->getRepository('ProjectBundle:Back\Roles')->findOneBy(['id' => $user->getType()]));
    }
}