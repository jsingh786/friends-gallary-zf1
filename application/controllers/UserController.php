<?php

class UserController extends Zend_Controller_Action
{
    public function preDispatch()
    {

    }

    public function init()
    {
       //  //to prevent the user acsess if session is not set

       //  if(!Service\Authentication::hasIdentity()) 
       // {
       //     $this->_helper->redirector ('index', 'authenticate');
       // }
    }

    public function indexAction()
    {

    }
        /**
     * This action use to be add the data into database .
     * @version 1.0
     * @author SinghSandeep
     */
    public function addAction()
    {
        $data=$this->getRequest()->getPost();
        // print_r($data); die;
        $usersObj = new \Extended\users();
        $usersObj->create($data);
        $this->_helper->redirector('index', 'authenticate', 'default');
    }
    public function friendsAction()
    {
        
    }
}