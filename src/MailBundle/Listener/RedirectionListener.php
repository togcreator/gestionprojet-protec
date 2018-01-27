<?php
/**
 * Created by PhpStorm.
 * User: MAUROTEL
 * Date: 29/08/2017
 * Time: 18:03
 */

namespace Protec\MailBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RedirectionListener
{
    public function __construct(ContainerInterface $container, Session $session)
    {
        $this->session = $session;
        $this->router = $container->get('router');
        $this->securityContext = $container->get('security.context');
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if(!is_object($this->securityContext->getToken()->getUser()))
        {
            $this->session->getFlashBag()->add('notification', 'Vous devez vous identifier');
            $event->setResponse(new RedirectResponse($this->router->generate('fos_user_security_login')));
        }

    }
}