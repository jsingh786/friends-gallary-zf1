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
        $sess= new \Zend_Auth_Storage_Session('frontend_user');
        $id= $sess->read();
        // echo $id; die;
        $userObj = \Extended\profile::get(['users'=>$id], []);
         $result = \Extended\users::get(['id'=>$id], []);
        // echo "<pre>";
        // 
        $this->view->data = $userObj[0];
        $this->view->result = $result[0];


    }

    public function addAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
      //$result = $this->getAdapter()->fetchAll($select);
    }
}