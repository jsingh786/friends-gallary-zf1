<?php

use Zend\Http\PhpEnvironment\Request;

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
           $this->_helper->redirector ('index', 'authenticate');
       }
    }

    public function indexAction()
    {
        $sess= new \Zend_Auth_Storage_Session('frontend_user');
        $id= $sess->read();
        $userObj = \Extended\profile::get(['users'=>$id], []);
        $resultObj = \Extended\users::get(['id'=>$id], []);
        // echo "<pre>";
         //$data=\Doctrine\Common\Util\Debug::dump($resultObj);
        if(!empty($userObj))
        {
            // echo "Empty"; die;
            $this->view->data=$userObj[0];
            
            $this->view->result=$resultObj[0];
        }
    }
    
    public function updateAction() 
    {
        // echo "Hrrererere"; die;
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $target_dir = "images/";
        $data=$this->getRequest()->getPost();
        $file= $_FILES['photo'];
        $filename= $file['name'];
        $ext=pathinfo($filename,PATHINFO_EXTENSION);
        // echo $ext; die;
        $newName=md5(date('Y-m-d H:i:s').":".microtime());
        $image=$newName.'.'.$ext;
        $status = move_uploaded_file($tmp_name, $target_dir.$image);
        // echo $image; die;
        $result = \Extended\profile::edit($data,$image); 
    } 
    /**
    */
    
    public function addAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $sess= new \Zend_Auth_Storage_Session('frontend_user');
        $id= $sess->read();
        $target_dir = "images/";
        $data=$this->getRequest()->getPost();
        $data= $this->getRequest()->getPost();
        $file= $_FILES['photo'];
        $filename= $file['name'];
        $tmp_name=$file['tmp_name'];
        $ext=pathinfo($filename,PATHINFO_EXTENSION);
        $newName=md5(date('Y-m-d H:i:s').":".microtime());
        $image=$newName.'.'.$ext;
        $status = move_uploaded_file($tmp_name, $target_dir.$image);
        $result= \Extended\profile::insert($data,$image,$id);
        $this->_helper->redirector('index', 'index');
    }

}

    
