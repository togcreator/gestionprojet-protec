<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityManager;

class LocaleListener implements EventSubscriberInterface
{
    private $defaultLocale;
    private $entitymanager;
    private $response;
    private $securityToken;

    public function __construct($defaultLocale = 'fr', EntityManager $entitymanager, $securityToken)
    {
        $this->defaultLocale = $defaultLocale;
        $this->entitymanager = $entitymanager;
        $this->securityToken = $securityToken;
    }

    // on controller event
    public function onKernelController(FilterControllerEvent $event) 
    {
        $request = $event->getRequest();
        $token   = $this->securityToken->getToken();
        $user    = $token ? $token->getUser() : '';

        // if( is_object($user) && !preg_match('/fos_user/', $request->get('_route')) ) {
        //     $token->setUser($this->entitymanager->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $user->getId()]));
        // }

        // if( ($id = $request->getSession()->get('log')) ) {
        //     $token->setUser($this->entitymanager->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $id]));
        // }

        $this->setHasCookie($request, $user);
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            return;
        }

        // On essaie de voir si la locale a été fixée dans le paramètre de routing _locale
        if($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
        } else {
            // Si aucune locale n'a été fixée explicitement dans la requête, on utilise celle de la session
            $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
        }
    }

    /**
    * To set cookie if exists
    *
    * @return null
    */
    public function setHasCookie($request, $user) 
    {
        $route = $request->get('_route');
        if( $route == 'fos_user_security_login' || $route == 'users_index' || preg_match('/register/', $request->getPathInfo()) ) return;

        $cookie = \UsersBundle\Entity\Users::getCookieLogin();
        // test si cookie exist ie is logged in
        if( count($cookie) ) 
        {
            // test si session exist dans bdd
            $session = $this->entitymanager->getRepository('UsersBundle:UsersSession')->findBy(['sessionToken' => $cookie[0]]);
            if( !count($session) )
                return $this->response = new RedirectResponse($request->getBaseUrl() . '/logout');

            if( count($session) ) 
            {
                // test la duree de login et maj la session si valid
                $cookie_lifetime = $this->entitymanager->getRepository('ProjectBundle:Back\Param')->findBy(['label' => 'cookie
                    _lifetime']);

                // logout if depasse temps
                $date_old = $session[0]->getDate()->format('H:i:s');
                $date_now = (new \DateTime('now '.date('e')))->format('H:i:s');
                $diff = (strtotime($date_now)-strtotime($date_old));

                // cookie life time
                $cookie_lifetime = count($cookie_lifetime) ? $cookie_lifetime[0]->getValue() : 3600;
                if( $diff >= $cookie_lifetime && $route != 'users_index' )
                    return $this->response = new RedirectResponse($request->getBaseUrl() . '/logout');
                else
                    // update horaire
                    $this->entitymanager->getRepository('UsersBundle:UsersSession')->Update($session[0]->getId());
            }
        }
        else
        {        
            /* sinon login */
            if( !is_object($user) )
                return $this->response = new RedirectResponse($request->getBaseUrl() . '/login');   
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(array('onKernelRequest', 17)),
            KernelEvents::CONTROLLER => array(array('onKernelController', 18)),
        );
    }
}