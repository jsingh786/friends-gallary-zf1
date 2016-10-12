<?php
class PhotoController extends Zend_Controller_Action
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
      $id = $this->getRequest()->getParam('id');
      // echo $id; die;
      $this->view->data=$id;
      }
      public function addAction()
      {
         $this->_helper->layout()->disableLayout();
         $this->_helper->viewRenderer->setNoRender(true);
         $img=array();
         $description=array();
         $post=$this->getRequest()->getPost();
         // echo "<pre>"; 
         //  print_r($post); die;
         $id= $this->getRequest()->getParam('id');
         // echo $id; die;
         unset($post['id']);
          // echo "<pre>"; 
          // print_r($post); die;
         
         foreach ($post as $key => $value)
         {
             $description[]=$value;
             
         }
       
           $file=$_FILES;

          foreach ($file as $key => $value)
         {
             $filename=$file[$key]['photo'];
             $filetype=$file[$key]['type'];
             $tmp_name=$file[$key]['tmp_name'];
             $fileError=$file[$key]['error'];
             $fileSize=$file[$key]['size'];
             $image="";
             $dest="images/";

             if($fileError<=0)
             {
             $ext=pathinfo($filename,PATHINFO_EXTENSION);
             $newName=md5(date('Y-m-d H:i:s').":".microtime());
             $image=$newName.'.'.$ext;
             // echo $ext; die;
             $status=move_uploaded_file($tmp_name,$dest.$image);
             }
             $img[]= $image;
         }
             $imgObj = \Extended\photo::insert($img,$description,$id);
             $albumId=$this->getRequest()->getParam('id');
             $this->_helper->redirector('view', 'photo', 'default',['id'=>$albumId]);
      }


         public function viewAction()

        {
          //$post=$this->getRequest()->getPost();
         // $data=\Doctrine\Common\Util\Debug::dump($resultObj);
      
          // $sess= new \Zend_Auth_Storage_Session('frontend_user');
          // $id=$sess->read();
          $id = $this->getRequest()->getParam('id');
          // echo $id; die;
          $userObj = \Extended\photo::get(['album'=>$id]);
            $this->view->data=$userObj;


        }

  }


       

     