<?php
class RequestController extends Zend_Controller_Action
{
  public function preDispatch()
  {

  }

  public function init()
  {

  }

  /**
  * Search name from the user table and fetch details.
  * After fetch details from the profile table on the basis of id.
  * And match alphabet character.
  * Check input is empty or not.
  * @version 1.0
  * @author goyalraghav
  */
  public function indexAction()
  {
    $name = $this->getRequest()->getPost('search');
    // echo $name; die;
    if (preg_match("/^[a-zA-Z]*$/", $name)) {
      $sid  =  \Service\Authentication::getIdentity()->getId();
      $user = \Extended\users::search($name,$sid);
      if (!empty($user)){
        for ($i= 0; $i<count($user); $i++)
        {
          $id[] = $user[$i]['id'];
        }
          $profile = \Extended\profile::select($id);
          $this->view->profile = $profile;
          $this->view->user    = $user;
      } 
      else 
      {
        $valid  = new \Service\Constants();
        $status ='1';
        echo $valid->error($status);
      }
    } 
    else 
    {
      $valid  = new \Service\Constants();
      $status ='0';
      echo $valid->error($status);
    }
  }

  /** 
  * To create for  add new  friends .
  * When Friend request is sent. Button shoud be chanje into "friend requset sent".
  * After insert the data into database the status would be chanje 0 to 1.
  *@version 1.1
  * Date: 7/10/2016
  * Time: 4:13 PM
  *@author singhSandeep
  */
  public function addAction()
  {
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
    $id     = \Service\Authentication::getIdentity()->getId(); 
    $result = \Extended\friendRequest::get(['friendRequestReceiver'=>$id,'status'=>0]);
    $id     =array();
    for($i=0;$i<count($result);$i++)
    {
      $id[]= $result[$i]->getfriendRequestSender()->getId();
    }
    if (!empty($id))
    {
      $data    = \Extended\friendRequest::select($id);     
      $profile = \Extended\friendRequest::search($id);
      //echo "<pre>";
      //\Doctrine\Common\Util\Debug::dump($id); die;
      $this->view->profile= $profile;
      $this->view->data   = $data;  
    }
    else
    {
      $data = "No New Friend Request.";
      // \Doctrine\Common\Util\Debug::dump($data); die;
      $this->view->data= $data;
    }
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
  * When we click on decline button it will chanje the status 0 to 2 in database.
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
    $this->_helper->redirector('index','index');
  }
  /** 
  * To create for Displaying  friends.
  * When we confirmed the request all friends are showing in Displaying Friends page.
  *@version 1.1
  * Date: 13/10/2016
  * Time: 03:13 PM
  *@author singhSandeep
  */
  public function displayingFriendsAction()
  {
    $id =\Service\Authentication::getIdentity()->getId();
    $data =\Extended\friendRequest::displayFriends(['friendRequestSender'=>$id]);
    // echo "<pre>";
    // \Doctrine\Common\Util\Debug::dump($data); die;
    $this->view->data = $data;
    // echo<"pre">;
    // print_r($data);
    // die;
  }
}
