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
        $albums = \Extended\album::get(['users'=>\Service\Authentication::getIdentity()->getId()],['offset'=>$params['offset'],'limit'=>$params['limit']]);
        // echo"<pre>";
        // print_r($albums);
        // die;
        // echo "<pre>";

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
        //Create array for JSON

       // echo count($albums);
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
                //$albumArray[$key]['photo'] = $album->getPhoto();
                foreach ($album->getPhoto() as $photo) {
                    echo $albumArray[$key]['photo']=$photo->getName() . ' <br/>';
                }

            //     echo "<pre>";
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

