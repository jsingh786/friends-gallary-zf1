<?php
/**
* Created by PhpStorm.
* User: jsingh7
* Date: 9/8/2016
* Time: 4:01 PM
**/
class AuthenticateController extends Zend_Controller_Action
{
    public function preDispatch()
    {

    }
    public function init()
    {
        /* Initialize action controller here */
    }
    public function indexAction()
    {

    }
    public function loginAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        if($this->getRequest()->isPost())
        {
            $auth = Zend_Auth::getInstance();
            $auth->setStorage(new Zend_Auth_Storage_Session('frontend_user'));
            $adapter = new Service\Authentication($this->getRequest()->getParam("email"), $this->getRequest()->getParam("pass"));
            $result = $auth->authenticate($adapter);
            $result = $auth->authenticate($adapter);
            if  ( $result->getCode () == Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID
                || $result->getCode () == Zend_Auth_Result::FAILURE
                || $result->getCode () == Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS
                || $result->getCode () == Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND
                || $result->getCode () == Zend_Auth_Result::FAILURE_UNCATEGORIZED
                )
            {
                $msg = $result->getMessages();
                $this->_helper->redirector ('index', 'authenticate');
                $this->_helper->redirector ('index', 'authenticate');   
            }
            else if ( Service\Authentication::hasIdentity() ) //Successful Login
            {
                $this->_helper->redirector('index', 'index');
            }
        }
    }
    public function addAction()
    {
        $data=$this->getRequest()->getPost();
        // print_r($data); die;
        $usersObj = new \Extended\users();
        $usersObj->create($data);
        $this->_helper->redirector('index', 'authenticate', 'default');
    }
    /**
    * This action use to Logout the users from main pages and redirect to login page .
    * @version 1.0
    * @author SinghSandeep
    */
    public function logoutAction()
    {
        session_destroy(); // todo Why you have used this method to destroy session when we have Service\Authentication class for this?
        $this->_helper->redirector ('index', 'index', 'default');
    } 
    public function registerAction()
    {

    }
}



