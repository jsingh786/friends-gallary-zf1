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
        //echo '<pre>';

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

    public function getAllAlbumsOfLoggedinUser()
    {
        $result=\Extended\album::get(['users'=>\Service\Authentication::getIdentity()]);
        echo json_encode($result);
    }

    public function addAction()
    {
        $data=$this->getRequest()->getPost();
        $profileObj = new \Extended\album();
        $result = $profileObj->create($data);
        $this->_helper->redirector('index', 'photo', 'default',['id'=>$result]);
    }

}
