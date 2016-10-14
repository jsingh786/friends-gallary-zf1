<?php
class RequestController extends Zend_Controller_Action
{
    public function preDispatch()
    {

    }

    public function init()
    {
       
    }

    public function indexAction()
    {
        $name=$this->getRequest()->getParam('search');
        $result = \Extended\users::search($name);
        // Doctrine\Common\Util\Debug::Dump('result');
        //die;
        $this->view->data= $result;
    }
     
    public function addAction()
    {
        // $recId=$this->getRequest()->getParam('id');
        // echo $id; die;
        $sess= new \Zend_Auth_Storage_Session('frontend_user');
        $id= $sess->read();
        //echo $id; die;
        $recId=$this->getRequest()->getParam('id');
        \Extended\friendRequest::insert($id,$recId);
    }
    public function requestAction()
    {

    }

}
