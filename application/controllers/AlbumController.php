<?php
class AlbumController extends Zend_Controller_Action
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

    }
    public function addAction()
    {
        $data=$this->getRequest()->getPost();
        $data=$this->getRequest()->getPost();
        $profileObj = new \Extended\album();
        // $id=$this->getResponse()->getPost();
        $result = $profileObj->create($data);
        $this->_helper->redirector('index', 'photo', 'default',['id'=>$result]);
        // $this->_helper->redirector('index', 'Photo', 'default', array('id'=>));
        // $this->_helper->redirector('index', 'Photo', 'default', array('id'=>));
    }
    public function showAction()
    {
        $result=\Extended\album::select();
        $this->view->result=$result;
        // echo "<pre>";
        // \Doctrine\Common\Util\Debug::dump($result); die;
    }
    public function galleryAction()
    {
        // echo "Galerefffsd"; die;
        $url = Zend_Controller_Front::getInstance()->getRequest()->getRequestUri();
        $id=substr($url, strpos($url, "albumId=") + 8);
        if(is_numeric($id))
        {
            $result=\Extended\photo::get(['album'=>$id],[]);
            // echo "<pre>";
            // \Doctrine\Common\Util\Debug::dump($result); 
            $this->view->result=$result;
        }
    }
}