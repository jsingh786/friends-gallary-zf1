<?php

use Zend\Http\PhpEnvironment\Request;
/**
 * Created by PhpStorm.
 * User: jsingh7
 * Date: 9/8/2016
 * Time: 4:01 PM
 */
class ProfileController extends Zend_Controller_Action
{
    public function preDispatch()
    {

    }

    public function init()
    {
        /* Initialize action controller here */
        if(!Service\Authentication::hasIdentity())
       {
           $this->_helper->redirector('index', 'authenticate');
       }
    }
    public function indexAction()
    {
        $sess= new \Zend_Auth_Storage_Session('frontend_user');
        $id= $sess->read();
        $userObj = \Extended\profile::get(['users'=>$id], []);
        $resultObj = \Extended\users::get(['id'=>$id], []);
        if(!empty($resultObj))
        {
         $this->view->result=$resultObj[0];
        }
        if(!empty($userObj))
        {
            // echo "Empty"; die;
            $this->view->data=$userObj[0];
           
        }
    }
    /** 
    *@param After login you will be update your own profile.
    *@param After update the data into database they will redirect the dashborad page.
    *@version 1.1
    */
    public function updateAction() 
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $data=$this->getRequest()->getPost();
        $target_dir = "images/";
        $file= $_FILES['photo'];
        $filename= $file['name'];
        $tmp_name=$file['tmp_name'];
        $ext=pathinfo($filename,PATHINFO_EXTENSION);
        // echo $ext; die;
        $newName=md5(date('Y-m-d H:i:s').":".microtime());
        $image=$newName.'.'.$ext;
        $status = move_uploaded_file($tmp_name, $target_dir.$image);
        // echo $image; die;
        $result = \Extended\profile::edit($data,$image);
        $this->_helper->flashMessenger->addMessage('profileinserted');
        $this->_helper->redirector('index','profile');  

    } 
    /** 
    *@param To create a new user profile.
    *@param Image will be move or upload  with new name on the public/image folder.
    *@param After insert the data into database they will redirect the dashborad page.
    *@version 1.1
    */
    public function addAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $sess= new \Zend_Auth_Storage_Session('frontend_user');
        $id= $sess->read();
        $data= $this->getRequest()->getPost(); 
        $target_dir = "images/";   
        $file= $_FILES['photo'];
        $filename= $file['name'];
        $tmp_name= $file['tmp_name']; 
        $ext= pathinfo($filename,PATHINFO_EXTENSION);
        $newName= md5(date('Y-m-d H:i:s').":".microtime()); 
        $image= $newName.'.'.$ext;  
        $status = move_uploaded_file($tmp_name, $target_dir.$image); 
        $result= \Extended\profile::insert($data,$image,$id);
        $this->_helper->flashMessenger->addMessage('profileinserted');
        $this->_helper->redirector('index', 'profile');  
    }
}

    

