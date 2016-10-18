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
        $this->view->userid =\Service\Authentication::getIdentity()->getId();
        $this->view->data=$id;   
    }

       /* Encode album data into JSON form */
        
    /**
     * Encode album data into JSON form 
     * @author kaurharjinder
     * @version 1.0
     */        
    public function getAllAlbumsOfLoggedinUserAction()
{
         // print_r($this->getRequest()->getParams());
         // die;
        $albums = \Extended\album::get(['users'=>\Service\Authentication::getIdentity()->getId()]);
        $params = $this->_request->getParams();
               //Get User Id, Limit & offset
        $albums = \Extended\album::get(['users'=>\Service\Authentication::getIdentity()->getId()],['offset'=>$params['offset'],'limit'=>$params['limit']],['column'=>$params['column'],'order'=>$params['order']]);
        // echo"<pre>";
        // print_r($albums);
        // die; 
        //Create array for JSON
        $albumArray = array();
        if($albums)
        {
            foreach ($albums as $key=>$album)
            {
                $albumArray[$key]['id'] = $album->getId();
                $albumArray[$key]['name'] = $album->getName();
                $albumArray[$key]['location'] = $album->getLocation();
                $albumArray[$key]['description'] = $album->getDescription();
                $datee = $album->getCreatedAt();
                $albumArray[$key]['created_at'] = $datee->format('d/m/y');
            }
        }
        //Encode Array data into JSON Form
        echo json_encode($albumArray);
        exit();
    }


 /**
    * @param This action used to create album data into the database and redirect photo page. 
    * @version 1.0
    * @author PathakAshish
    */

    public function addAction()
    {
       /* $id=$this->getRequest->getParam('id');
        echo "<pre>";
        print_r($id);
        die;*/
               
        $data=$this->getRequest()->getPost();
        /*echo "<pre>";
        print_r($data);
        die;*/
        $profileObj = new \Extended\album();
        /*echo "<pre>";
        print_r($profileObj);
        die;*/
        $result = $profileObj->create($data);
        $data=\Extended\album::get(['id'=>$result],[]);
        /*echo "<pre>";
        print_r($data);
        die; */
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
       public function createAction()
       {


       }


     }
        


