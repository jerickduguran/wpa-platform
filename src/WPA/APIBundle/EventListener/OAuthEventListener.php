<?php
 
namespace WPA\APIBundle\EventListener;

use FOS\OAuthServerBundle\Event\OAuthEvent;

class OAuthEventListener
{
	protected $userManager;
	
	public function __construct($userManager)
	{
		$this->userManager = $userManager;
	}
	
    public function onPreAuthorizationProcess(OAuthEvent $event)
    {
        if ($user = $this->getUser($event)){
            $event->setAuthorizedClient(
                $user->isAuthorizedClient($event->getClient())
            );
        }
    }

    public function onPostAuthorizationProcess(OAuthEvent $event)
    {
        if ($event->isAuthorizedClient()) {
            if (null !== $client = $event->getClient()) {
                $user = $this->getUser($event);
                $user->addClient($client);
                $this->userManager->save($user);
            }
        }
    }

    protected function getUser(OAuthEvent $event)
    {
        return $this->userManager->findOneBy(array("username" => $event->getUser()->getUsername()));
    }
}