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
    $name=$this->getRequest()->getPost('search');
    // echo $name; die;
    $result = \Extended\users::search($name);
    $this->view->data= $result;
    // Doctrine\Common\Util\Debug::Dump($data); die;
  }
  /** 
  * To create for  add new  friends .
  * When Friend request is sent button shoud be chanje into "friend requset sent".
  * After insert the data into database the status would be chanje 0 to 1.
  *@version 1.1
  * Date: 7/10/2016
  * Time: 4:13 PM
  *@author singhSandeep
  */
  public function addAction()
  {
    //added some code by jas.
    $this->_helper->layout()->disableLayout();
    $this->_helper->viewRenderer->setNoRender(true);
    $id      = \Service\Authentication::getIdentity()->getId();
    $recId   = $_POST['id'];
    $insertId= \Extended\friendRequest::insert($id,$recId);
    $data    = \Extended\friendRequest::get(["id"=>$insertId]);
    $status  = $data[0]->getStatus();
    if($status=="0")
    {
      $stat  = "Friend request sent";
      $array = array("stat"=>$stat);
      echo json_encode($array);
    }
  }
  /** 
  * To create for Displaying friends request.
  * Here showing all the details of upcoming requests along with photo,username & email.
  *@version 1.1
  * Date: 10/10/2016
  * Time: 5:10 PM
  *@author singhSandeep
  */
  public function acceptAction()
  {
    //Sandeep    $id     = \Service\Authentication::getIdentity()->getId(); 
    $result = \Extended\friendRequest::get(['friendRequestReceiver'=>$id]);
    $id     =array();
    for($i=0;$i<count($result);$i++)
    {
      $id[]= $result[$i]->getfriendRequestSender()->getId();
    }
    $data = \Extended\friendRequest::select($id);
    $this->view->data= $data;
  }
  /** 
  * To create for Accept friends request.
  * When we click on confirm button it will chanje the status 0 to 1.
  *@version 1.1
  * Date: 12/10/2016
  * Time: 4:13 PM
  *@author singhSandeep
  */
  public function confirmAction()
  {
    $this->_helper->layout()->disableLayout();
    $this->_helper->viewRenderer->setNoRender(true);
    $sid   = $this->getRequest()->getParam('id');
    $rid   = \Service\Authentication::getIdentity()->getId();
    $result= \Extended\friendRequest::update($sid,$rid);
    $this->_helper->redirector('displayingfriends','request');
  }
   /** 
  * To create for Decline  friends request.
  * When we click on decline button it will chanje the status 0 to 2.
  *@version 1.1
  * Date: 13/10/2016
  * Time: 03:13 PM
  *@author singhSandeep
  */
  public function declineAction()
  {    
    $this->_helper->layout()->disableLayout();
    $this->_helper->viewRenderer->setNoRender(true);
    $sid   = $this->getRequest()->getParam('id');
    $rid   = \Service\Authentication::getIdentity()->getId();
    $result= \Extended\friendRequest::delete($sid,$rid);
    $this->_helper->redirector('accept','request');
  }

  public function displayingfriendsAction()
  {
    $id =\Service\Authentication::getIdentity()->getId();
    $data =\Extended\friendRequest::get(['friendRequestSender'=>$id]);
    // echo "<pre>";
    // \Doctrine\Common\Util\Debug::dump($data); die;
    $this->view->data = $data;

    // echo<"pre">;
    // print_r($data);
    // die;
  }
}
