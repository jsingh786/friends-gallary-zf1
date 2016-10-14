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
        // $sess= new \Zend_Auth_Storage_Session('frontend_user');
        // $id= $sess->read();
        // $data= \Extended\users::get(['id'=>$id],[]);
        // $this->view->dataa=$data;
       $this->view->user_id = \Service\Authentication::getIdentity()->getId();

    }
        /* Encode album data into JSON form */
    public function getAllAlbumsOfLoggedinUserAction()
    {
         // print_r($this->getRequest()->getParams());
         // die;
        $albums = \Extended\album::get(['users'=>\Service\Authentication::getIdentity()->getId()]);
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
            }
        }
        echo json_encode($albumArray);
        die;
    }
    public function addAction()
    {
        $data=$this->getRequest()->getPost();
        $profileObj = new \Extended\album();
        $result = $profileObj->create($data);
        $this->_helper->redirector('index', 'photo', 'default',['id'=>$result]);
    }
}
