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
     //This action use for Showing the login user name..
	public function indexAction()
	{
         
		
	}

	public function AuthenticateAction()
	 {
	
	}

}





