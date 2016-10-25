<?php
class PhotoController extends Zend_Controller_Action
{
  public function preDispatch()
  {

  }  
/* Initialize action controller here */
  public function init()
  {
    if(!Service\Authentication::hasIdentity())
    {
      $this->_helper->redirector ('index', 'authenticate');
    }
  }

 /**
   * @param This action work get name and id from album controller.
   * @version 1.0
   * @author PathakAshish
   */
  public function indexAction() 
  {  
     $name = $this->getRequest()->getParam('name');
     $id=$this->getRequest()->getParam('id');
         $this->view->data=$id;   
         $this->view->name=$name; 
      }

  /**
    * @param This action used to insert images into the database and upload images in directory. 
    * @version 1.0
    * @author PathakAshish
    */
  public function addAction()
  {         
     $this->_helper->layout()->disableLayout();
     $this->_helper->viewRenderer->setNoRender(true);
     $img=array();
     $description=array();         
     $post=$this->getRequest()->getPost();
     $id= $this->getRequest()->getParam('id');
     unset($post['id']);
     $name=$this->getRequest()->getParam('albumname');
     unset($post['name']);
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
         $dest="images/albums/".$name."/";
         if($fileError<=0)
         {
         $newName=$file[$key]['name'];
         $file_ext=explode('.',$file[$key]['name']);
         $ext=end($file_ext);
         $fname = basename($newName, ".".$ext);  
        /* $datetime = date('d-m-Y-H:i:s');       */
         $image= $fname.'_'.rand(01,99).'.'.$ext;
         $status=move_uploaded_file($tmp_name,$dest.$image);
         }
         $img[]= $image;
     }
         $imgObj = \Extended\photo::insert($img,$description,$id);
         $albumId=$this->getRequest()->getParam('id');       
         $this->_helper->redirector('view', 'photo', 'default',['id'=>$albumId,'name'=>$name]);

              
  }

      /**
    * @param In this action used show images in perticulate folder directory. 
    * @version 1.0
    * @author PathakAshish
    */
  public function viewAction()
  {
      $id = $this->getRequest()->getParam('id');
      $name=$this->getRequest()->getParam('name');
      $userObj = \Extended\photo::get(['album'=>$id]);
      $this->view->data=$userObj;
      $this->view->name= $name;
  }

    /**
* @param In this action used only show warning. 
* @version 1.0
* @author PathakAshish
*/
  public function msgAction()
  {

  }

}   