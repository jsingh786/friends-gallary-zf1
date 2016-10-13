<?php
class AlbumController extends Zend_Controller_Action
{
    public function preDispatch()
    {
        if(!\Service\Authentication::hasIdentity())
        {
            $this->_helper->redirector('index', 'authenticate', 'default');
        }
    }

    public function init()
    {
        /* Initialize action controller here */
    }

/**
     * @param This action use to be add the data into database .
     * @version 1.0
     * @author PathakAshish
     */

    public function indexAction()
    {

    }
        /* Encode album data into JSON form */

     public function getAllAlbumsOfLoggedinUser()
    {
        $result=\Extended\album::get(['users'=>\Service\Authentication::getIdentity()]);
        echo json_encode($result);
    }

 /**
    * @param This action used to create album data into the database and redirect photo page. 
    * @version 1.0
    * @author PathakAshish
    */

    public function addAction()
    {
    	
        $data=$this->getRequest()->getPost();
        $profileObj = new \Extended\album();
        $result = $profileObj->create($data);
        $data=\Extended\album::get(['id'=>$result],[]); 
        $fdir="./images/album/";
        $albumName=$data[0]->getName();
        if (file_exists($fdir. $albumName)) 
        {          
        $this->_helper->redirector('msg', 'photo', 'default',['id'=>$result,'name'=>$albumName]);
        }
        else 
        {
        mkdir($fdir.$albumName, 0777, true);
        $this->_helper->redirector('index', 'photo', 'default',['id'=>$result,'name'=>$albumName]);
         }
      }
      
  }