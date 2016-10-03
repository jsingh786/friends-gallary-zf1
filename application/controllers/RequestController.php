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
   //  public function searchAction()
   //  {
   //     // $params=$this->getRequest()->getParams('data');
   //     $name=$_POST['path'];
   //     // echo $params; die;
   //     // echo "<pre>";
   //     // print_r($params);
   //     $id=array();
   //     $this->_helper->layout()->disableLayout();
   //     $this->_helper->viewRenderer->setNoRender(true);
   //     // $patt="san";        
   //     $data= \Extended\users::select($name);

   //     // echo $data; die;
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
       
   //     echo json_encode($data);
   //     // return $jsonData;
   // }    
   // public function friendAction()
   // {
   //     $id=$this->getRequest()->getParam('search');
        
   //     $id=array();
   //     $data= \Extended\users::select($name);
   //    // echo $data; die;
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
      
   //     $this->view->data=$data;
   //     // Doctrine\Common\Util\Debug::Dump();
   // }
   
}