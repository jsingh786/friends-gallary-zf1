 
<?php 
class RequestController extends Zend_Controller_Action
{
    public function preDispatch()
    {

    }

    public function init()
    {
    /* Initialize action controller here */
    }

    public function indexAction()
    {

    }

    public function requestAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
        $recId=$this->getRequest()->getParam('id');
        // echo $recId; die;
        $sess= new \Zend_Auth_Storage_Session('frontend_user');
        $id= $sess->read();
        \Extended\friendRequest::add($id,$recId);
    }

    public function acceptAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
        $recId=$this->getRequest()->getParam('id');
        // echo $recId; die;
        $sess= new \Zend_Auth_Storage_Session('frontend_user');
        $id= $sess->read();
        \Extended\friendRequest::update($id,$recId);
    }

    public function profileAction()
    {
        
    }

    // public function friendsAction()
    //  {
    //      $sess= new \Zend_Auth_Storage_Session('frontend_user');
    //      $id= $sess->read();
    //      $user=\Extended\friendRequest::select($id);
    //      \Doctrine\Common\Util\Debug::Dump($user);
    //      $this->view->data=$user;
    // }
    public function friendsAction()
    {

    }
}
