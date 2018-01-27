<?php

namespace UsersBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Controller\ProfileController as BaseController;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends BaseController
{
    /**
     * Edit the user
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser(); dump($user); exit;

        if ( !is_object($user) ) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $formFactory FactoryInterface */
        $formFactory = $this->container->get('fos_user.profile.form.factory');
        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');

        $form = $formFactory->createForm(['dataForm' => $this->dataForm()]);
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                /* update */
                $userManager->updateUser($user);
                return new RedirectResponse($this->container->get('router')->generate('fos_user_profile_edit'));
            }
        }

        return $this->render('@FOSUser/Profile/edit.html.twig', array(
            'form' => $form->createView(),
            'user' => $user
        ));
    }

    /**
    * Data form 
    *
    * @return Array
    */
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'natures' => $em->getRepository('UsersBundle:Back\UsersParamNature')->findAll(),
            'langages' =>  $em->getRepository('AppBundle:Common\Langage')->findAll(),
            'userClient' => $em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $this->getUser()->getId()])
        ];
    }

    /**
    *  Photo user
    * 
    * @param UsersBundle:UserClient
    * @return null
    */
    private function setUserPhoto ($user) 
    {
        /* pour l'image de user */
        $dir = $this->getParameter('upload_dir');
        $user->setPhoto(\AppBundle\Entity\Classes\Utils::Upload_file($user->getPhoto(), $dir . '/image/'));
    }
}