<?php
class UserController extends Zend_Controller_Action
{
    public function preDispatch()
    {

    }

    public function init()
    {
        if(!Service\Authentication::hasIdentity())
       {
           $this->_helper->redirector ('index', 'authenticate');
       }
    }

    public function indexAction()
    {

    }

    public function addAction()
    {
        $data=$this->getRequest()->getPost();
        // print_r($data); die;
        $usersObj = new \Extended\users();
        $usersObj->create($data);
        $this->_helper->redirector('index', 'authenticate', 'default');
    }
    
}