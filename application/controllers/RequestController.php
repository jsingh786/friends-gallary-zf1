<?php
/**
* Created by PhpStorm.
* User: jsingh7
**/
class RequestController extends Zend_Controller_Action
{
    public function preDispatch()
    {

    }
    public function init()
    {
       /* Initialize action controller here */
    }
    /**
    * In this action they will go to the search function in users and go to the select function in profile.
    * @version 1.1
    * @author goyalraghav
    * Date: 5/10/2016  //todo date and time is not part of doc.
    * Time: 4:00 PM
    */
    public function indexAction() //todo why unnecessary enters?

    {
       
        $name       = $this->getRequest()->getPost('search'); //todo Who will check that the search string is valid for search or not?
        $result     = \Extended\users::search($name); ///todo See your search function and fix the error.
        if(!empty($result)) //todo Add space after if.
        {
            for($i=0;$i<count($result);$i++) //todo Add space after punctuation mark(I have told this several times), Add space after FOR.
            {
                $id[]   = $result[$i]['id'];
            }
            $img = \Extended\profile::select($id);
            if(count($result) == count($img))
            {
                for($i= 0;$i<count($img);$i++)
                {
                    $data[$i]= $img[$i];        
                }
            }
            $this->view->data  = $data; //todo What is data? What is result? Who will add docs here?
            $this->view->result= $result;
        }
        else 
        {
            //todo hard coded strings should come form library/Service/constants.php
            //todo Do not just echo here but send integer value to view and print string there.
             echo "<h4><b>No Record found</b></h4>";
        }

    }
    /**
    * In this action they add the senderId and ReciverId.
    * After that, they go to the insert function in Extended\friendRequest.
    * @version 1.1
    */
    public function addAction()
    {
        // $recId=$this->getRequest()->getParam('id');
        // echo $id; die;
        $sess = new \Zend_Auth_Storage_Session('frontend_user');
        $id   = $sess->read();
        $recId=$this->getRequest()->getParam('id');
        \Extended\friendRequest::insert($id,$recId);
        $this->_helper->redirector('index', 'request');
    }
    public function acceptAction()
    {
        $id = \Service\Authentication::getIdentity()->getId();
        $result = \Extended\friendRequest::get(['friendRequestReceiver'=>$id],[]);
       //  echo "<pre>";
       // Doctrine\Common\Util\Debug::Dump($result); die;
        // echo count($result); die;
        $id=array();
        // echo $result[0]->getfriendRequestSender()->getId(); die;
        for($i=0;$i<count($result);$i++)
        {
           $id[]=$result[$i]->getfriendRequestSender()->getId();
        }
        $data = \Extended\friendRequest::select($id);
        $this->view->data=$data;
    }
    public function confirmAction()
    {   
       
        $sid   =$this->getRequest()->getParam('id');
        $rid   = \Service\Authentication::getIdentity()->getId();
        $result= \Extended\friendRequest::update($sid,$rid);
        //$this->_helper->redirector('index','profile'); 
        // echo "<pre>";
        // print_r($result);
        // die;
    }
    // public function declineAction()
    // {
    //     $this->_helper->layout()->disableLayout();
    //     $this->_helper->viewRenderer->setNoRender(true);
    //     $sess = new \Zend_Auth_Storage_Session('frontend_user');
    //     $id   = $sess->read();
    //     \Extended\friendRequest::delete($id);
    //     //$this->_helper->redirector('index','profile'); 
    // }
    public function requestAction()
    {

    }
}
