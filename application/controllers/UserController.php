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
       //  //to prevent the user acsess if session is not set

       //  if(!Service\Authentication::hasIdentity()) 
       // {
       //     $this->_helper->redirector ('index', 'authenticate');
       // }
    }

    public function indexAction()
    {

    }
<<<<<<< HEAD
    /**
     * This action use to be add the data into database .
     * @version 1.0
     * @author SinghSandeep
     */
=======

>>>>>>> a75d7d424ec74c1d7b4ee2ee01a5284ddaeded1f
    public function addAction()
    {
        $data=$this->getRequest()->getPost();
        // print_r($data); die;
        $usersObj = new \Extended\users();
        $usersObj->create($data);
        $this->_helper->redirector('index', 'authenticate', 'default');
    }
    
}