<?php

namespace UsersBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Classes\Utils;

class RegistrationController extends BaseController
{
    public function registerAction(Request $request)
    {
        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                // ================================
                $user->setRoles(['ROLE_CLIENT']);

                /* add/update */
                $userManager->updateUser($user);

                /*if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }*/

                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('users_list');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }

        return $this->render('@FOSUser/Registration/register.html.twig', array(
            'form' => $form->createView(),
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
            'langages' =>  $em->getRepository('AppBundle:Common\Langage')->findAll()
        ];
    }

    /* Image de user */
    private function setUserPhoto ($user) 
    {
        /* pour l'image de user */
        $dir = $this->getParameter('upload_dir');
        $user->setPhoto(\AppBundle\Entity\Classes\Utils::Upload_file($user->getPhoto(), $dir . '/image/'));
    }
}