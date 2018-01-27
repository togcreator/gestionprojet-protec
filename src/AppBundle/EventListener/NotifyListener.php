<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\KernelEvents;
use Doctrine\Common\EventSubscriber;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Doctrine\Common\EventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\Event\PostFlushEventArgs;

class NotifyListener implements EventSubscriber
{	
	// container
	private $container;

	// construct
	public function __construct(ContainerInterface $container = null)
	{
		if( $container != null )
			$this->container = $container;
	}

	// after update
	public function postUpdate (EventArgs $event)
	{
		// $object = $event->getObject();

		// if( !is_a($object, \UsersBundle\Controller\UsersSessionController::class) ) {
			$request = $this->container->get('request_stack')->getCurrentRequest();
			$request->getSession()->set('notify', 'global.notify_success_update');
		// }
	}

	// after persist
	public function postPersist (EventArgs $event)
	{
		$request = $this->container->get('request_stack')->getCurrentRequest();

		/* pour user login */
		if( $request ) {
			if( $request->get('submit') == 'login' )
				$request->getSession()->set('notify', 'global.notify_success_login');
			else
				$request->getSession()->set('notify', 'global.notify_success_insert');
		}
	}

	// after remove
	public function postRemove (EventArgs $event)
	{
		$request = $this->container->get('request_stack')->getCurrentRequest();
		$request->getSession()->set('notify', 'global.notify_success_delete');
	}

	// override list of event
	public function getSubscribedEvents() 
	{
		return [
			'postPersist',
			'postRemove',
			'postUpdate'
		];
	}
}