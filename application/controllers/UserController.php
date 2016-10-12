<?php
class UserController extends Zend_Controller_Action
{
    public function preDispatch()
    {

    }

    public function init()
    {
        if(!Service\Authentication::hasIdentity())
       {
           $this->_helper->redirector ('index', 'authenticate');
       }
    }

    public function indexAction()
    {

    }
    /**
     * This action use to be add the data into database .
     * @version 1.0
     * @author SinghSandeep
     */
         public function addAction()

    {
        $data=$this->getRequest()->getPost();
        // print_r($data); die;
        $usersObj = new \Extended\users();
        $usersObj->create($data);
        $this->_helper->redirector('index', 'authenticate', 'default');
    }
   //  public function ajaxAction()
   //  {
   //     // $params=$this->getRequest()->getParams('data');
   //     $name=$_POST['pattren'];
   //     // echo $params; die;
   //     // echo "<pre>";
   //     // print_r($params);
   //     $id=array();
   //     $this->_helper->layout()->disableLayout();
   //     $this->_helper->viewRenderer->setNoRender(true);
   //     // $patt="san";        
   //     $data= \Extended\users::search($name);
   //     // for($i=0;$i<count($data);$i++)
   //     // {
   //     //     $id[]=$data[$i]['id'];
   //     // }
   //     // $img= \Extended\profile::select($id);
   //     // if(count($data)==count($img))
   //     // {
   //     //     for($i=0;$i<count($img);$i++)
   //     //     {
   //     //         $data[$i]["photo"]=$img[$i]["photo"];        
   //     //     }
   //     // }
       
   //  echo json_encode($data);
   //   // return $jsonData;
   //  die;
   //  }
   //    public function friendsAction()
   // {
   //     $name=$this->getRequest()->getPost('search');
   //     $id=array();
   //     $data= \Extended\users::search($name);
   //     // for($i=0;$i<count($data);$i++)
   //     // {
   //     //     $id[]=$data[$i]['id'];
   //     // }
   //     // $img= \Extended\profile::select($id);
   //     // if(count($data)==count($img))
   //     // {
   //     //     for($i=0;$i<count($img);$i++)
   //     //     {
   //     //         $data[$i]["photo"]=$img[$i]["photo"];        
   //     //     }
   //     // }
   //     // echo "<pre>";
   //     // print_r($data); die;
   //     $this->view->data=$data;
      
   // }
}