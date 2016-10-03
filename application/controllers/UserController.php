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
       //  //to prevent the user acsess if session is not set

       //  if(!Service\Authentication::hasIdentity()) 
       // {
       //     $this->_helper->redirector ('index', 'authenticate');
       // }
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

rawatabhishek
12:01 PM <div class="col-md-8">
<div class="card">
<div class="header">
<h4 class="title">Edit Profile</h4>
</div>
<div class="content">
<form>
<div class="col-md-4">
<div class="form-group">
<label for="exampleInputEmail1">Email address</label>
<input type="email" class="form-control" placeholder="Email">
</div>
</div><div class="col-md-4">
<div class="form-group">
<label for="exampleInputEmail1">Password</label>
<input type="password" name=pass class="form-control" placeholder="Password">
</div>
</div>
<button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
</form></div></div></div>
goyalraghav
2:11 PM <div class="outer" style="width: 100%; margin-left: 146px;">
<div class="col-md-4">
<div class="card">
<div class="header" style="background-color: #9567D5
;">
<h4 class="title">Login</h4>
</div>
<div class="content" >
<form>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label for="exampleInputEmail1">Email address</label>
<input type="email" class="form-control" placeholder="Email">
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label for="exampleInputEmail1">Password</label>
<input type="password" name=pass class="form-control" placeholder="Password">
</div>
</div>
</div>
<div class="row">
<div class="margin" style="width: 124px; float: left; margin-left: 91px;">
<button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
</div>
</div>
</form></div></div></div></div>
2:12 <?php if($params['controller'] != 'authenticate' && $params['action'] != 'indexx')
goyalraghav
2:19 PM style="background-color: white;
goyalraghav
2:44 PM hi
rawatabhishek
9:54 AM jQuery(function($){
             
                 
               $('#mybutton').on('click', function(){
                   var r = $('</br>'+'<label>Select Image</label>'+'</br>'+'<input/>').attr({
                     type: "File",
                     name: "file[]"
                   });
                    $("form").append(r);
               })
               $("#mybutton").on('click',function () {
                   var a = $('<label>Description::</label>'+'</br>'+'<textarea/>'+'</br>').attr({
                       rows: "2",
                       columns: "6"
                       
                   });
                   $("form").append(a);  
                         
               })
           })
goyalraghav
9:55 AM jQuery(function($){
               
           
               $('#mybutton').on('click', function(){
                   alert("hjgfdf");
                   var r = $('</br>'+'<label>Select Image::</label>'+'</br>'+'<input/>').attr({
                     type: "File",
                     id: "field",
                     name: "file[]",
                   
                   });
                    $("form").append(r);
                   
               })
               $("#mybutton").on('click',function () {
                   var a = $('<label>Description::</label>'+'</br>'+'<textarea/>'+'</br>').attr({
                       rows: "2",
                       columns: "6",
                       id: "desc",
                   });
                   $("form").append(a);    
                         
               })
                         })
9:59 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
rawatabhishek
10:05 AM $this->headScript()->appendFile(PUBLIC_PATH . "/js/photopage.js");
goyalraghav
11:02 AM jQuery(function($)
           {
               $('#mybutton').on('click', function(e){
               e.preventDefault();
               var count=parseInt($('#mybutton').attr("count"));
               var no=count+1;
               // alert(no);
               $('#mybutton').attr("count",no);
               var r = $('</br>'+'<label>Select Image::</label>'+'</br>'+'<input/>').attr({
               type: "File",
               id: "field",
               name: "file"+ no,                });
                   var a = $('<label>Description::</label>'+'</br>'+'<textarea/>'+'</br>').attr({
                   rows: "2",
                   columns: "6",
                   name: "description" + no,
               });
               $("form").append(r);
               $("form").append(a);  
               })
               
                   
                                 
           })
goyalraghav
6:24 PM $target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
echo $target_file; die;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
   // Check if $uploadOk is set to 0 by an error    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
   } else {
       echo "Sorry, there was an error uploading your file.";
   }
}
rawatabhishek
6:39 PM $this->_helper->layout()->disableLayout();
       $this->_helper->viewRenderer->setNoRender(true);
rawatabhishek
9:57 AM <?php
namespace Entities;
use Doctrine\ORM\Mapping AS ORM;
use Gedmo\Mapping\Annotation as Gedmo;/**
* @ORM\Entity
*/
class profile
{
   /**
    * @ORM\Id
    * @ORM\Column(type="integer", length=11)
    * @ORM\GeneratedValue(strategy="AUTO")
    */
   private $id;    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */
   private $photo;    /**
    * @ORM\Column(type="string", length=2000, nullable=true)
    */
   private $description;    /**
    * @ORM\Column(type="string", length=2000, nullable=true)
    */
   private $hobbies;    /**
    * @ORM\Column(type="string", length=500, nullable=true)
    */
   private $education;    /**
    * @ORM\Column(type="string", length=500, nullable=true)
    */
   private $experience;    /**
    * @ORM\Column(type="string", length=20, nullable=true)
    */
   private $contact_no;    /**
    * @ORM\Column(type="string", length=100, nullable=true)
    */
   private $location;    /**
    * @ORM\OneToOne(targetEntity="Entities\users", inversedBy="profile")
    * @ORM\JoinColumn(name="users_id", referencedColumnName="id", nullable=false, unique=true)
    */
   private $users;    public function getId()
   {
       return $this->id;
   }    public function setId($id)
   {
       $this->id = $id;
   }     public function getDescription()
   {
       return $this->description;
   }    public function setDescription($description)
   {
       $this->description = $description;
   }     public function getHobbies()
   {
       return $this->hobbies;
   }    public function setHobbies($hobbies)
   {
       $this->hobbies = $hobbies;
   }     public function getEducation()
   {
       return $this->education;
   }    
   public function setEducation($education)
   {
       $this->education = $education;
   }    public function getExperience()
   {
       return $this->experience;
   }    public function setExperience($experience)
   {
       return $this->experience;
   }    
   public function setContactNo($contact_no)
   {
       $this->contact_no = $contact_no;
   }     public function getContactNo()
   {
       return $this->contact_no;
   }  
   public function setPhoto($photo)
   {
       $this->photo = $photo;
   }    public function getPhoto()
   {
       return $this->photo;
   }     public function getLocation()
   {
       return $this->location;
   }    
   public function setLocation($location)
   {
       $this->location = $location;
   }    public function getUsers()
   {
       return $this->users;
   }    
   public function setUsers($users)
   {
       $this->users = $users;
   }
}
goyalraghav
10:06 AM $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
         $target_dir = "images/";
       $target_file = $target_dir . basename($_FILES["photo"]["name"]);
       echo $target_file; die;
       if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file))
       {
           echo "The file ". basename($_FILES["photo"]["name"]). " has been uploaded.";
       } else
       {
           echo "Sorry, there was an error uploading your file.";
       }
rawatabhishek
4:31 PM $file=$_FILES;
       echo "<pre>";
       print_r($file); die;
       $filename=$file['name'];
       $filetype=$file['type'];
       $tmp_name=$file['tmp_name'];
       $fileError=$file['error'];
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
           if(!$status)
           {
               echo "Error occured while uploading file"; die;
           }
rawatabhishek
4:49 PM <?php
/**
* Created by PhpStorm.
* User: jsingh7
* Date: 9/8/2016
* Time: 12:12 PM
*/namespace Service;class Authentication implements \Zend_Auth_Adapter_Interface
{
   protected $email = "";
   protected $password = "";    public function __construct( $email, $password )
   {
       $this->email = $email;
       $this->password = $password;
   }    /**
    * Checks user email and password, saves
    * zend storage session.
    * storage name is 'fontend_user'.
    *
    * @author jsingh7
    * @version 1.0
    * (non-PHPdoc)
    * @see Zend_Auth_Adapter_Interface::authenticate()
    */
   public function authenticate()
   {
       $userObj = \Extended\users::get(['email_id'=>$this->email], ['limit'=>1, 'offset'=>0], ['order'=>'DESC', 'column'=>'id']);
       if (!$userObj)
       {
           $result = new \Zend_Auth_Result ( \Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID,
               null,
               array ("Oops! The e-mail/password is incorrect.") );
       }
       //CHECKING USER STATUS BEFORE PROCEEDING
       else if ( $userObj[0]->getStatus() == false )
       {
           $result = new \Zend_Auth_Result ( \Zend_Auth_Result::FAILURE,
               $userObj[0]->getId(),
               array ("Login failed. Your account has been disabled.") );
       }
       else if ( $userObj[0]->getPwd() == md5( $this->password ) )
       {
           $result = new \Zend_Auth_Result(
               \Zend_Auth_Result::SUCCESS,
               $userObj[0]->getId(),
               array( 'logged in for the user : ' .$userObj[0]->getEmailId() ));
       }
       else
       {
           $result = new \Zend_Auth_Result(
               \Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID,
               $userObj[0]->getId(),
               array( 'Password Invalid.' ));
       }
       return $result;
   }    /**
    * Checks identity.
    *
    * @author jsingh7
    * @version 1.0
    */
   public static function hasIdentity()
   {
       $sess= new \Zend_Auth_Storage_Session('frontend_user');
       if ($sess->read())
       {
           $U = \Extended\users::get(['id'=>$sess->read()], ['limit'=>1, 'offset'=>0], ['order'=>'DESC', 'column'=>'id']);
           if ($U[0])
           {
               return true;
           }
           return false;
       }
       return false;
   }    /**
    * Get identity.
    *
    * @author jsingh7
    * @version 1.0
    */
   public static function getIdentity()
   {
       $sess= new \Zend_Auth_Storage_Session('frontend_user');
       if ($sess->read())
       {
           $U = \Extended\users::get(['id'=>$sess->read()], ['limit'=>1, 'offset'=>0], ['order'=>'DESC', 'column'=>'id']);
           if ($U[0])
           {
               return $U[0];
           }
           return false;
       }
       return false;
   }    /**
    * Clear identity.
    *
    * @author jsingh7
    * @version 1.0
    */
   public static function clearIdentity()
   {
       $sess= new \Zend_Auth_Storage_Session('frontend_user');
       return $sess->clear();
   }
}
goyalraghav
10:23 AM public function addAction()
   {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $sess= new \Zend_Auth_Storage_Session('frontend_user');
       $id= $sess->read();
       // echo $id; die;
       $target_dir = "images/uploads/";
       $target_file = $target_dir . basename($_FILES["photo"]["name"]);
       $data=$this->getRequest()->getPost();
      //echo $target_file; die;
       //$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
       // Check if image file is a actual image or fake image
          //echo $target_file; die;        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
       
           $data= $this->getRequest()->getPost();
           $file= $_FILES['photo'];
           $filename= $file['name'];
           $ext=pathinfo($filename,PATHINFO_EXTENSION);
           $newName=md5(date('Y-m-d H:i:s').":".microtime());
           $image=$newName.'.'.$ext;
           $result= \Extended\profile::insert($data,$image,$id);
   }
10:25 <?php
namespace Extended;
/**
* Created by Sublime text 2.
* User: rawatabhishek
* Date: 9/9/2016
* Time: 9:46 PM
*/
class profile extends \Entities\profile
{
    public static function insert($data,$image,$id)
    {
        $em = \Zend_Registry::get('em');
       // echo '<pre>';
       // print_r($data); die;
        $profileObj = new \Entities\profile();
       $result=\Extended\users::get(['id'=>$id],[]);
       // echo "<pre>";
       // \Doctrine\Common\Util\Debug::dump($result); die;
        $profileObj->setPhoto($image);
       $profileObj->setDescription($data['description']);
        $profileObj->setHobbies($data['hobbies']);
        $profileObj->setEducation($data['education']);
        $profileObj->setExperience($data['experience']);
        $profileObj->setContactNo($data['contact_no']);
        $profileObj->setLocation($data['location']);
       $profileObj->setUsers($result[0]);
        $em->persist($profileObj);
        $em->flush(); //here
        
    }    public function edit($data)
    {
        $em= \Zend_Registry::get('em');
       $db= $em->createQueryBuilder();
       $photo=$data['photo'];
       $descc=$data['description'];
       $hob=$data['hobbies'];
       $edu=$data['education'];
       $expr=$data['experience'];
       $con=$data['contact_no'];
       $loc=$data['location'];
       
       $db->update('\Entities\profile', 'p')
       ->set('p.photo', '$photo')
       ->set('p.hobbies', '$hob')
       ->set('p.education', '$edu')
       ->set('p.experience', '$expr')
       ->set('p.contact_no', '$con')
       ->set('p.location', '$loc')
       ->set('p.description', '$descc')
       ->where($queryBuilder
       ->expr()
       ->eq('p.users_id', ':$id'));
    }    public static function get(array $whereConditions = [],
                              array $limitAndOffset = [] ,
                              array $order = [])
   {
       $em     = \Zend_Registry::get('em');
       $qb_1   = $em->createQueryBuilder();
       $alias  = 'usrs';
       $q_1    = $qb_1->select($alias)
               ->from('\Entities\profile', $alias);        //Creating where conditions of query.
       if ($whereConditions)
       {
           $counter = 1;
           foreach ($whereConditions as $key=>$whereCondition)
           {
               $q_1->andWhere($alias.'.'.$key."=?$counter");
               $q_1->setParameter("$counter", "$whereCondition");
               $counter++;
           }
       }        //Sorting
       if($order)
       {
           $q_1->orderBy(  $alias.'.'.$order['column'], $order['order'] );
       }        //List length
       if($limitAndOffset)
       {
           $q_1->setFirstResult( $limitAndOffset['offset'] )
               ->setMaxResults( $limitAndOffset['limit'] );
       }        //Debugging by getting SQL
       //echo '<pre>';
       //echo $q_1->getQuery()->getSQL();
       //die;        return $q_1->getQuery()->getResult();
   }}
rawatabhishek
3:49 PM <?php
namespace Extended;class photo extends \Entities\photo
{
    public static function insert($img,$description,$id)
    {
        // echo $id; die;
        $em = \Zend_Registry::get('em');
       $photoObj= new \Entities\photo();
        $num=count($img);
        // $offset=$id-1;
        // echo $num; die;
        $result = \Extended\album::get(['id'=> $id],[]);
        // echo "<pre>";
        // \Doctrine\Common\Util\Debug::dump($result);
        // die;        
        for($i=0;$i<$num;$i++)
        {
            $photoObj->setName($img[$i]);
            $photoObj->setDescription($description[$i]);
            $photoObj->setAlbum($result[0]);
            $em->persist($photoObj);
            // $em->flush();
            // $em->clear();
        }
        $em->flush();
            
    }
}
3:50 <?php
class PhotoController extends Zend_Controller_Action
{
   public function preDispatch()
   {    }    public function init()
   {
       // if(!Service\Authentication::hasIdentity())
       // {
       //     $this->_helper->redirector ('index', 'authenticate');
       // }
       /* Initialize action controller here */
   }    public function indexAction()
   {    }    public function addAction()
   {
       $this->_helper->layout()->disableLayout();
       $this->_helper->viewRenderer->setNoRender(true);
       $img=array();
       $description=array();
       $post=$this->getRequest()->getPost();
       $id=$post['id'];
       unset($post['id']);
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
           $img[]=$newName;
       }
       
      $imgObj = \Extended\photo::insert($img,$description,$id);
       
}
}
rawatabhishek
4:14 PM <?php
namespace Extended;class album extends \Entities\album
{
    public function create($data)
    {
        $userObj = \Extended\users::get(['id'=>6], ['limit'=>1, 'offset'=>0]);
        // echo '<pre>';
        // \Doctrine\Common\Util\Debug::dump($userObj);
        // die;
        $em = \Zend_Registry::get('em');
        $album= new \Entities\album();
        
        $album->setName($data['name']);
        $album->setLocation($data['location']);
        $album->setDescription($data['desc']);
        $album->setUsers($userObj[0]);
        $em->persist($album);
        $em->flush();
        $id=$album->getId();
        return $id;
    }    public static function get(array $whereConditions = [],
                              array $limitAndOffset = [] ,
                              array $order = [])
   {
       $em     = \Zend_Registry::get('em');
       $qb_1   = $em->createQueryBuilder();
       $alias  = 'album';
       $q_1    = $qb_1->select($alias)
               ->from('\Entities\album', $alias);        //Creating where conditions of query.
       if ($whereConditions)
       {
           $counter = 1;
           foreach ($whereConditions as $key=>$whereCondition)
           {
               $q_1->andWhere($alias.'.'.$key."=?$counter");
               $q_1->setParameter("$counter", "$whereCondition");
               $counter++;
           }
       }        //Sorting
       if($order)
       {
           $q_1->orderBy(  $alias.'.'.$order['column'], $order['order'] );
       }        //List length
       if($limitAndOffset)
       {
           $q_1->setFirstResult( $limitAndOffset['offset'] )
               ->setMaxResults( $limitAndOffset['limit'] );
       }        return $q_1->getQuery()->getResult();
   }}
goyalraghav
5:54 PM <?php
/**
* Created by PhpStorm.
* User: jsingh7
* Date: 9/8/2016
* Time: 12:12 PM
*/namespace Service;class Authentication implements \Zend_Auth_Adapter_Interface
{
  protected $email = "";
  protected $password = "";    public function __construct( $email, $password )
  {
      $this->email = $email;
      $this->password = $password;
  }    /**
   * Checks user email and password, saves
   * zend storage session.
   * storage name is 'fontend_user'.
   *
   * @author jsingh7
   * @version 1.0
   * (non-PHPdoc)
   * @see Zend_Auth_Adapter_Interface::authenticate()
   */
  public function authenticate()
  {
      $userObj = \Extended\users::get(['email_id'=>$this->email], ['limit'=>1, 'offset'=>0], ['order'=>'DESC', 'column'=>'id']);
     
      if (!$userObj)
      {
          $result = new \Zend_Auth_Result ( \Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID,
              null,
              array ("Oops! The e-mail/password is incorrect.") );
      }
      //CHECKING USER STATUS BEFORE PROCEEDING
      else if ( $userObj[0]->getStatus() == false )
      {
          $result = new \Zend_Auth_Result ( \Zend_Auth_Result::FAILURE,
              $userObj[0]->getId(),
              array ("Login failed. Your account has been disabled.") );
      }
      else if ( $userObj[0]->getPwd() == md5( $this->password ) )
      {
          $result = new \Zend_Auth_Result(
              \Zend_Auth_Result::SUCCESS,
              $userObj[0]->getId(),
              array( 'logged in for the user : ' .$userObj[0]->getEmailId() ));
      }
      else
      {
          $result = new \Zend_Auth_Result(
              \Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID,
              $userObj[0]->getId(),
              array( 'Password Invalid.' ));
      }
      return $result;
  }    /**
   * Checks identity.
   *
   * @author jsingh7
   * @version 1.0
   */
  public static function hasIdentity()
  {
      $sess= new \Zend_Auth_Storage_Session('frontend_user');
      if ($sess->read())
      {
          $U = \Extended\users::get(['id'=>$sess->read()], ['limit'=>1, 'offset'=>0], ['order'=>'DESC', 'column'=>'id']);
          if ($U[0])
          {
              return true;
          }
          return false;
      }
      return false;
  }    /**
   * Get identity.
   *
   * @author jsingh7
   * @version 1.0
   */
  public static function getIdentity()
  {
      $sess= new \Zend_Auth_Storage_Session('frontend_user');
      if ($sess->read())
      {
          $U = \Extended\users::get(['id'=>$sess->read()], ['limit'=>1, 'offset'=>0], ['order'=>'DESC', 'column'=>'id']);
          if ($U[0])
          {
              return $U[0];
          }
          return false;
      }
      return false;
  }    /**
   * Clear identity.
   *
   * @author jsingh7
   * @version 1.0
   */
  public static function clearIdentity()
  {
      $sess= new \Zend_Auth_Storage_Session('frontend_user');
      return $sess->clear();
  }
}
5:58 <?php
namespace Extended;
/**
* Created by PhpStorm.
* User: jsingh7
* Date: 9/7/2016
* Time: 6:36 PM
*/
class users extends \Entities\users
{
   /**
    * Insert users data into database.
    *
    * @param array $data (key value pair, where 'key' is column)
    * @return integer ID
    * @version 1.0
    * @author RawatAbhishek
    */
   public function create($data)
   {
       $em = \Zend_Registry::get('em');
       $user= new \Entities\users();
       $user->setFname($data['fname']);
       $user->setLname($data['lname']);
       $user->setEmailId($data['email_id']);
       $user->setUsername($data['username']);
       $user->setpwd(md5($data['pwd']));
       $user->setStatus($data['status']);
       $em->persist($user);
       $em->flush();
       return $user->getId();
   }    /**
    * Returns users data
    * on the basis of arguments passed.
    *
    * @param array $whereConditions (key value pair, where 'key' is column)
    * @param array $limitAndOffset [optional] ['limit'=>100, 'offset'=>200]
    * @param array $order [optional] (two possible values 'DESC' or 'ASC') ['order'=>'DESC', 'column'=>'id']
    *
    * @return Array Collection
    * @throws \Zend_Exception
    * @version 1.0
    *
    */
   public static function get(array $whereConditions = [],
                              array $limitAndOffset = [] ,
                              array $order = [])
   {
       $em     = \Zend_Registry::get('em');
       $qb_1   = $em->createQueryBuilder();
       $alias  = 'usrs';
       $q_1    = $qb_1->select($alias)
               ->from('\Entities\users', $alias);        //Creating where conditions of query.
       if ($whereConditions)
       {
           $counter = 1;
           foreach ($whereConditions as $key=>$whereCondition)
           {
               $q_1->andWhere($alias.'.'.$key."=?$counter");
               $q_1->setParameter("$counter", "$whereCondition");
               $counter++;
           }
       }        //Sorting
       if($order)
       {
           $q_1->orderBy(     $alias.'.'.$order['column'], $order['order'] );
       }        //List length
       if($limitAndOffset)
       {
           $q_1->setFirstResult( $limitAndOffset['offset'] )
               ->setMaxResults( $limitAndOffset['limit'] );
       }        //Debugging by getting SQL
       //echo '<pre>';
       //echo $q_1->getQuery()->getSQL();
       //die;        return $q_1->getQuery()->getResult();
   }
}
goyalraghav
6:04 PM <?php
use Zend\Http\PhpEnvironment\Request;class ProfileController extends Zend_Controller_Action
{
   public function preDispatch()
   {    }    public function init()
   {
       /* Initialize action controller here */
   }    public function indexAction()
   {
       $sess= new \Zend_Auth_Storage_Session('frontend_user');
       $id= $sess->read();
       // echo $id; die;
       $userObj = \Extended\profile::get(['users'=>$id], []);
       // \Doctrine\Common\Util\Debug::dump($userObj);
       $this->view->data=$userObj[0];
   }    public function updateAction()
   {
       // echo "Hrrererere"; die;
       $this->_helper->layout()->disableLayout();
       $this->_helper->viewRenderer->setNoRender(true);
       $data=$this->getRequest()->getPost();
       $file= $_FILES['photo'];
       $filename= $file['name'];
       $ext=pathinfo($filename,PATHINFO_EXTENSION);
       // echo $ext; die;
       $newName=md5(date('Y-m-d H:i:s').":".microtime());
       $image=$newName.'.'.$ext;
       // echo $image; die;
       $result = \Extended\profile::edit($data,$image);    }    public function addAction()
   {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $sess= new \Zend_Auth_Storage_Session('frontend_user');
       $id= $sess->read();
       // echo $id; die;
       $target_dir = "images/uploads/";
       $target_file = $target_dir . basename($_FILES["photo"]["name"]);
       $data=$this->getRequest()->getPost();
      //echo $target_file; die;
       //$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
       // Check if image file is a actual image or fake image
          //echo $target_file; die;        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
       
           $data= $this->getRequest()->getPost();
           $file= $_FILES['photo'];
           $filename= $file['name'];
           $ext=pathinfo($filename,PATHINFO_EXTENSION);
           $newName=md5(date('Y-m-d H:i:s').":".microtime());
           $image=$newName.'.'.$ext;
           $result= \Extended\profile::insert($data,$image,$id);
   }    }
goyalraghav
6:05 PM

<?php

class AlbumController extends Zend_Controller_Action

{

    public function preDispatch()

    {

goyalraghav
6:05 PM

<?php

​

/**

 * Created by PhpStorm.

 * User: jsingh7

goyalraghav
6:05 PM

<?php

class IndexController extends Zend_Controller_Action

{

  public function preDispatch()

  {

goyalraghav
6:05 PM

<?php

use Zend\Http\PhpEnvironment\Request;

​

class ProfileController extends Zend_Controller_Action

{

goyalraghav
9:33 AM <?php
namespace Extended;
/**
* Created by PhpStorm.
* User: jsingh7
* Date: 9/7/2016
* Time: 6:36 PM
*/
class users extends \Entities\users
{    /**
    * Insert users data into database.
    *
    * @param array $data (key value pair, where 'key' is column)
    * @return integer ID
    * @version 1.0
    * @author RawatAbhishek
    */
   public function create($data)
   {
       $em = \Zend_Registry::get('em');
       $user= new \Entities\users();
       $user->setFname($data['fname']);
       $user->setLname($data['lname']);
       $user->setEmailId($data['email_id']);
       $user->setUsername($data['username']);
       $user->setpwd(md5($data['pwd']));
       $user->setStatus($data['status']);
       $em->persist($user);
       $em->flush();
       return $user->getId();
   }    /**
    * Returns users data
    * on the basis of arguments passed.
    *
    * @param array $whereConditions (key value pair, where 'key' is column)
    * @param array $limitAndOffset [optional] ['limit'=>100, 'offset'=>200]
    * @param array $order [optional] (two possible values 'DESC' or 'ASC') ['order'=>'DESC', 'column'=>'id']
    *
    * @return Array Collection
    * @throws \Zend_Exception
    * @version 1.0
    *
    */
   public static function get(array $whereConditions = [],
                              array $limitAndOffset = [] ,
                              array $order = [])
   {
       $em     = \Zend_Registry::get('em');
       $qb_1   = $em->createQueryBuilder();
       $alias  = 'usrs';
       $q_1    = $qb_1->select($alias)
               ->from('\Entities\users', $alias);        //Creating where conditions of query.
       if ($whereConditions)
       {
           $counter = 1;
           foreach ($whereConditions as $key=>$whereCondition)
           {
               $q_1->andWhere($alias.'.'.$key."=?$counter");
               $q_1->setParameter("$counter", "$whereCondition");
               $counter++;
           }
       }        //Sorting
       if($order)
       {
           $q_1->orderBy(     $alias.'.'.$order['column'], $order['order'] );
       }        //List length
       if($limitAndOffset)
       {
           $q_1->setFirstResult( $limitAndOffset['offset'] )
               ->setMaxResults( $limitAndOffset['limit'] );
       }        //Debugging by getting SQL
       //echo '<pre>';
       //echo $q_1->getQuery()->getSQL();
       //die;        return $q_1->getQuery()->getResult();
   }   }
rawatabhishek
10:35 AM <?php
/**
* Created by PhpStorm.
* User: jsingh7
* Date: 9/8/2016
* Time: 12:12 PM
*/namespace Service;class Authentication implements \Zend_Auth_Adapter_Interface
{
  protected $email = "";
  protected $password = "";    public function __construct( $email, $password )
  {
      $this->email = $email;
      $this->password = $password;
  }    /**
   * Checks user email and password, saves
   * zend storage session.
   * storage name is 'fontend_user'.
   *
   * @author jsingh7
   * @version 1.0
   * (non-PHPdoc)
   * @see Zend_Auth_Adapter_Interface::authenticate()
   */
public function authenticate()
 {
     $userObj = \Extended\users::get(['email_id'=>$this->email], ['limit'=>1, 'offset'=>0], ['order'=>'DESC', 'column'=>'id']);
     if (!$userObj) {
        $result = new \Zend_Auth_Result ( \Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID,
             null,
             array ("Oops! The e-mail/password is incorrect.") );            }
     //CHECKING USER STATUS BEFORE PROCEEDING
     else if ( $userObj[0]->getStatus() == false )
     {
         $result = new \Zend_Auth_Result ( \Zend_Auth_Result::FAILURE,
             $userObj[0]->getId(),
             array ("Login failed. Your account has been disabled.") );
     }       else if ( $userObj[0]->getPwd() == md5( $this->password ) )
     {
         $result = new \Zend_Auth_Result(
             \Zend_Auth_Result::SUCCESS,
             $userObj[0]->getId(),
             array( 'logged in for the user : ' .$userObj[0]->getEmailId() ));
     }
   
     else       {
         $result = new \Zend_Auth_Result(
             \Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID,
             $userObj[0]->getId(),
             array( 'Password Invalid.' ));
     }
     return $result;   }
  /**
   * Checks identity.
   *
   * @author jsingh7
   * @version 1.0
   */
  public static function hasIdentity()
  {
      $sess= new \Zend_Auth_Storage_Session('frontend_user');
      if ($sess->read())
      {
          $U = \Extended\users::get(['id'=>$sess->read()], ['limit'=>1, 'offset'=>0], ['order'=>'DESC', 'column'=>'id']);
          if ($U[0])
          {
              return true;
          }
          return false;
      }
      return false;
  }    /**
   * Get identity.
   *
   * @author jsingh7
   * @version 1.0
   */
  public static function getIdentity()
  {
      $sess= new Zend_Auth_Storage_Session('frontend_user');
      if ($sess->read())
      {
          $U = \Extended\users::get(['id'=>$sess->read()], ['limit'=>1, 'offset'=>0], ['order'=>'DESC', 'column'=>'id']);
          if ($U[0])
          {
              return $U[0];
          }
          return false;
      }
      return false;
  }    /**
   * Clear identity.
   *
   * @author jsingh7
   * @version 1.0
   */
  public static function clearIdentity()
  {
      $sess= new Zend_Auth_Storage_Session('frontend_user');
      return $sess->clear();
  }
}
goyalraghav
4:21 PM $this->_helper->layout()->disableLayout();
       $this->_helper->viewRenderer->setNoRender(true);
       $sess= new \Zend_Auth_Storage_Session('frontend_user');
       $id= $sess->read();
       // echo $id; die;
       $target_dir = "images/";
       //$target_file = $target_dir . basename($_FILES["photo"]["name"]);
       $data=$this->getRequest()->getPost();
       //echo $target_file; die;
       //$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
       // Check if image file is a actual image or fake image
       //echo $target_file; die;
       
       $data= $this->getRequest()->getPost();
       $file= $_FILES['photo'];
       $filename= $file['name'];
       $tmp_name=$file['tmp_name'];
       $ext=pathinfo($filename,PATHINFO_EXTENSION);
       $newName=md5(date('Y-m-d H:i:s').":".microtime());
       $image=$newName.'.'.$ext;
       $status = move_uploaded_file($tmp_name, $target_dir.$image);
       $result= \Extended\profile::insert($data,$image,$id);
       $this->_helper->redirector('index', 'index');
4:22 $this->_helper->layout()->disableLayout();
       $this->_helper->viewRenderer->setNoRender(true);
       $target_dir = "images/";
       $data=$this->getRequest()->getPost();
       $file= $_FILES['photo'];
       $filename= $file['name'];
       $ext=pathinfo($filename,PATHINFO_EXTENSION);
       // echo $ext; die;
       $newName=md5(date('Y-m-d H:i:s').":".microtime());
       $image=$newName.'.'.$ext;
       $status = move_uploaded_file($tmp_name, $target_dir.$image);
       // echo $image; die;
       $result = \Extended\profile::edit($data,$image);
rawatabhishek
10:46 AM <?php
namespace Extended;class friendRequest extends \Entities\friendRequest
{
    public static function add($id,$recId)
    {
        $em = \Zend_Registry::get('em');
        $user = \Extended\users::get(['id'=>$id], []);
       // echo "<pre>";
       // \Doctrine\Common\Util\Debug::dump($userObj); die;
        $ruser= \Extended\users::get(['id'=>$recId],[]);
       $request= new \Entities\friendRequest();
       $request->setStatus(0);
       $request->setFriendRequestSender($user[0]);
       $request->setFriendRequestReceiver($ruser[0]);
       $sql=$em->getQuery()->getSQL();
       echo $sql; die;
       $em->persist($request);
       $em->flush();
       // return "Friend request sent";
    }    public static function get(array $whereConditions = [],
    array $limitAndOffset = [] ,
    array $order = [])
    {
        $em     = \Zend_Registry::get('em');
        $qb_1   = $em->createQueryBuilder();
        $alias  = 'request';
        $q_1    = $qb_1->select($alias)        ->from('\Entities\friendRequest', $alias);        //Creating where conditions of query.
        if ($whereConditions)
        {
            $counter = 1;
            foreach ($whereConditions as $key=>$whereCondition)
        {
            $q_1->andWhere($alias.'.'.$key."=?$counter");
            $q_1->setParameter("$counter", "$whereCondition");
            $counter++;
        }
        }        //Sorting
        if($order)
        {
            $q_1->orderBy(  $alias.'.'.$order['column'], $order['order'] );
        }        //List length
        if($limitAndOffset)
        {
            $q_1->setFirstResult( $limitAndOffset['offset'] )
            ->setMaxResults( $limitAndOffset['limit'] );
        }               return $q_1->getQuery()->getResult();
    }

 public function ajaxAction()
   {
       // $params=$this->getRequest()->getParams('data');
       $patt=$_POST['pattren'];
       // echo $params; die;
       // echo "<pre>";
       // print_r($params);
       $id=array();
       $this->_helper->layout()->disableLayout();
       $this->_helper->viewRenderer->setNoRender(true);
       // $patt="san";        $data= \Extended\users::search($patt);
       for($i=0;$i<count($data);$i++)
       {
           $id[]=$data[$i]['id'];
       }
       $img= \Extended\profile::select($id);
       if(count($data)==count($img))
       {
           for($i=0;$i<count($img);$i++)
           {
               $data[$i]["photo"]=$img[$i]["photo"];        
           }
       }
       
       echo json_encode($data);
       // return $jsonData;
   }    public function friendsAction()
   {
       $patt=$this->getRequest()->getPost('search');
       $id=array();
       $data= \Extended\users::search($patt);
       // for($i=0;$i<count($data);$i++)
       // {
       //     $id[]=$data[$i]['id'];
       // }
       // $img= \Extended\profile::select($id);
       // if(count($data)==count($img))
       // {
       //     for($i=0;$i<count($img);$i++)
       //     {
       //         $data[$i]["photo"]=$img[$i]["photo"];        
       //     }
       // }
       // echo "<pre>";
       // print_r($data); die;
       $this->view->data=$data;
       // Doctrine\Common\Util\Debug::Dump();
   }
}