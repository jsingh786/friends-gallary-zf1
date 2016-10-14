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

        // $sess= new \Zend_Auth_Storage_Session('frontend_user');
        // $id= $sess->read();
         $id =\Service\Authentication::getIdentity()->getId();
        $userObj = \Extended\profile::get(['users'=>$id], []);
        $resultObj = \Extended\users::get(['id'=>$id], []);
        if(!empty($resultObj))
        $sess        = new \Zend_Auth_Storage_Session('frontend_user');
        $id          = $sess->read();
        $profileObj  = \Extended\profile::get(['users'=> $id]);
        $userObj     = \Extended\users::get(['id'=> $id]);
        if(!empty($userObj))
        {
            $this->view->user= $userObj[0];
        }
        if(!empty($profileObj))
        {
            // echo "Empty"; die;
            $this->view->data=$userObj[0];
            $this->view->data= $profileObj[0];
        }
         // $data= \Extended\users::get(['id'=>$id],[]);
         // $this->view->dataa=$data;

    }
    /** 
    * After login you will be update your own profile.
    * After update the data into database they will redirect the dashborad page.
    *@version 1.1
    */
    public function updateAction() 
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $data          = $this->getRequest()->getPost();
        $target_dir    = "images/";
        $file          = $_FILES['photo'];
        $filename      = $file['name'];
        $tmp_name      = $file['tmp_name'];
        $ext           = pathinfo($filename,PATHINFO_EXTENSION);
        $newName       = md5(date('Y-m-d H:i:s').":".microtime());
        $image         = $newName.'.'.$ext;
        $status        = move_uploaded_file($tmp_name, $target_dir.$image);
        $result        = \Extended\profile::edit($data,$image);
        $this->_helper->redirector('index','profile');  
    } 
    /** 
    * To create a new user profile.
    * Image will be move or upload  with new name on the public/image folder.
    * After insert the data into database they will redirect the dashborad page.
    *@version 1.1
    */
    public function addAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $sess         = new \Zend_Auth_Storage_Session('frontend_user');
        $id           = $sess->read();
        $data         = $this->getRequest()->getPost(); 
        $target_dir   = "images/";   
        $file         = $_FILES['photo'];
        $filename     = $file['name'];
        $tmp_name     = $file['tmp_name']; 
        $ext          = pathinfo($filename,PATHINFO_EXTENSION);
        $newName      = md5(date('Y-m-d H:i:s').":".microtime()); 
        $image        = $newName.'.'.$ext;  
        $status       = move_uploaded_file($tmp_name, $target_dir.$image); 
        $result       = \Extended\profile::insert($data,$image,$id); 
        $this->_helper->redirector('index', 'profile');  
    }
}

    

  

