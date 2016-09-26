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
      $filename=$file[$key]['name'];
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
      $img[]= $newName;
    }
    $imgObj = \Extended\photo::insert($img,$description,$id);
  }
}
