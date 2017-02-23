<?php

namespace WPA\APIBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController as BaseController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UsersController extends BaseController
{
	
	/**
	 * Check if current request comes from a valid Client Token
	 * 
	 * throws BadRequestHttpException
	 */	
	protected function requireClientToken()
	{
		if ($this->getTokenUser()){
			throw new BadRequestHttpException('Client token is required to access this resource.');
		}		
	}
	
	/**
	 * Check if current request comes from a valid User Token
	 * 
	 * throws BadRequestHttpException
	 */
	protected function requireUserToken()
	{
		if (!$this->getTokenUser()) {
			throw new BadRequestHttpException('User token is required to access this resource.');
		}
	}
	
	/**
	 * Get Current user
	 * 
	 * @return boolean
	 */
	protected function getTokenUser()
	{
		if (($token = $this->container->get('security.token_storage')->getToken())) {
			if (($user = $token->getUser())) {
				return $user;
			}
		}
		return null;
	}
	
	
    public function getUserAction()
    { 
		$this->requireUserToken();
		
		$user = $this->getUser();  
		 
		$view = $this->view($user, 200);  

        return $this->handleView($view);
		
	}  
}