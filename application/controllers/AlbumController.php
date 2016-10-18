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
        // echo \Service\Common::test();
        // die;
    }
    public function indexAction()
    {
        // $sess= new \Zend_Auth_Storage_Session('frontend_user');
        // $id= $sess->read();
        // $data= \Extended\users::get(['id'=>$id],[]);
        // $this->view->dataa=$data;
       $this->view->user_id = \Service\Authentication::getIdentity()->getId();
    }
    /**
     * Encode album data into JSON form 
     * @author kaurharjinder
     * @version 1.0
     */        
    public function getAllAlbumsOfLoggedinUserAction()
    {
    
        $params = $this->_request->getParams();
               //Get User Id, Limit & offset
        $albums = \Extended\album::get(['users'=>\Service\Authentication::getIdentity()->getId()],['offset'=>$params['offset'],'limit'=>$params['limit']]);
        // echo"<pre>";
        // print_r($albums);
        // die;
        //echo "<pre>";
        // foreach ($albums as $album)
        // {
        //     Doctrine\Common\Util\Debug::dump($album);
        //     foreach ($album->getPhoto() as $photo)
        //     {
        //         Doctrine\Common\Util\Debug::dump($photo->getName());
        //     }
        //     break;
        // }
        // die;
        // Create array for JSON
        $albumArray = array();
        if($albums)
        {
            foreach ($albums as $key=>$album)
            {
                $photos = $album->getPhoto();
                $albumArray[$key]['id'] = $album->getId();
                $albumArray[$key]['name'] = $album->getName();
                if (!empty($photos[0]->getName())) {
                $albumArray[$key]['image_path'] = IMAGE_PATH.'/albums/'.$album->getName().'/'.$photos[0]->getName();
                }else{
                    $albumArray[$key]['image_path'] = IMAGE_PATH.'/static/default-avatar.png';
                }

                $albumArray[$key]['display_name'] = \Service\Common::showCroppedText($album->getName(), 12);
                $albumArray[$key]['location'] = $album->getLocation();
                $albumArray[$key]['description'] = $album->getDescription();
                $datee = $album->getCreatedAt();
                $albumArray[$key]['created_at'] = $datee->format('Y-m-d');
                //  echo "<pre>";
                // Doctrine\Common\Util\Debug::dump($album);
                // die;
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