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

        $result=\Extended\album::get(['users'=>1],[]);
        // $this->_helper->json($result);
        $data=json_encode($result);
        return $data;        
        //echo $jsonData = Zend_Json::encode($result);
        //$this->response->appendBody($jsonData);
        //Doctrine\Common\Util\Debug::dump($result[0]);
         // exit();
        // $this->view->data=$result[0];

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
