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
      


    }

    public function requestAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
      //$result = $this->getAdapter()->fetchAll($select);
        $sess= new \Zend_Auth_Storage_Session('frontend_user');
        $id= $sess->read();
        //echo $id; die;
        $recId=$this->getRequest()->getParam('id');
        \Extended\friendRequest::insert($id,$recId);
    }
   
}