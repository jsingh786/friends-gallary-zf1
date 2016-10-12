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

    public function indexAction()
    {
        /* Get value of user_id */ 
       $this->view->user_id = \Service\Authentication::getIdentity()->getId();

    }

    /**
     * Encode album data into JSON form 
     * @author kaurharjinder
     * @version 1.0
     */        
    public function getAllAlbumsOfLoggedinUserAction()
    {


       // $params = $this->getRequest()->getParams();
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
                $albumArray[$key]['created_at'] = $datee->format('Y-m-d');
                //$gjfgf = /
            }
        }

        //Encode Array data into JSON Form
        echo json_encode($albumArray);
        exit();
    }
    public function addAction()
    {
        $data=$this->getRequest()->getPost();
        $profileObj = new \Extended\album();
        $result = $profileObj->create($data);
        $this->_helper->redirector('index', 'photo', 'default',['id'=>$result]);
    }
}


