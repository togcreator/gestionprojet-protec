<?php
namespace UsersBundle\Handler;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;


class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    /**
    * @var Object
    */
    private $entitymanager;

    /* constructor */
    public function __construct($entitymanager) {
        $this->entitymanager = $entitymanager;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $token = $event->getAuthenticationToken();
        $request = $event->getRequest();
    }


    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $referer = $request->headers->get('host');
        return new RedirectResponse($request->getBaseUrl() . '/');
    }
}