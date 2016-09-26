<?php
class IndexController extends Zend_Controller_Action
{
	public function preDispatch()
	{

	}

	public function init()
	{
		/* Initialize action controller here */
		if(!Service\Authentication::hasIdentity())
       {
           $this->_helper->redirector ('index', 'authenticate');
       }
		
	}

	public function indexAction()
	{

		// echo '<pre>';
		// \Doctrine\Common\Util\Debug::dump(Service\Authentication::getIdentity()); die;
	}

	public function AuthenticateAction()
	 {
	
	}

}





