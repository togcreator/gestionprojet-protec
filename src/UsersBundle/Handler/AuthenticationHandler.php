<?php

namespace UsersBundle\Handler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityManager;
use UsersBundle\Entity\Users;

class AuthenticationHandler implements LogoutSuccessHandlerInterface
{	
	/**
	* @var object
	*/
	private $entitymananger;

	/**
	* @var object
	*/
	private $container;

	/* constructor */
	public function __construct(EntityManager $entitymanager, $container) {
		$this->entitymanager = $entitymanager;
		$this->container = $container;
	}

	/* onLogout */
    public function onLogoutSuccess(Request $request) 
    {        
        //=================================
        Users::logout($request, $this->entitymanager);
        $this->container->get('session')->remove('log');
        $this->container->get('session')->remove('BU');

        return new RedirectResponse($request->headers->get('referer'));
    }
}