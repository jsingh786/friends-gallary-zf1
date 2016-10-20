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

            $this->view->userid =\Service\Authentication::getIdentity()->getId();

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

                $photos = $album->getPhoto();
                $albumArray[$key]['id'] = $album->getId();
                $albumArray[$key]['name'] = $album->getName();
                if (!empty($photos[0]->getName())) {
                $albumArray[$key]['image_path'] = IMAGE_PATH.'/albums/'.$album->getName().'/'.$photos[0]->getName();
                }else{
                    $albumArray[$key]['image_path'] = IMAGE_PATH.'/static/default-avatar.png';
                }

                    $albumArray[$key]['display_name'] = \Service\Common::showCroppedText($album->getName(), 10);
                    $albumArray[$key]['location'] = \Service\Common::showCroppedText($album->getLocation(), 10);
                    $albumArray[$key]['description'] = \Service\Common::showCroppedText($album->getDescription(), 8);
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

        /**
        * @param This action used to create album data into the database and redirect photo page. 
        * @version 1.0
        * @author PathakAshish
        */
    public function addAction()
        {

            $data=$this->getRequest()->getPost();
            $profileObj = new \Extended\album();
            $id =\Service\Authentication::getIdentity()->getId();
            $result = $profileObj->create($data,$id);
            $data=\Extended\album::get(['id'=>$result],[]);
            $fdir="./images/albums/";
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

        /**
        * @param This action used to show create Page. 
        * @version 1.0
        * @author PathakAshish
        */      
    public function createAction()
        {

        }

}