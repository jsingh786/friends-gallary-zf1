<?php
/**
 * Created by PhpStorm.
 * User: jsingh7
 * Date: 9/8/2016
 * Time: 12:12 PM
 */

namespace Service;

class Authentication implements \Zend_Auth_Adapter_Interface
{
    protected $email = "";
    protected $password = "";

    public function __construct( $email, $password )
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
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
       
       // echo "<pre>";
       // echo $userOjb[0]->getId(); die;

       // \Doctrine\Common\Util\Debug::dump($userObj); die; 
       if (!$userObj)
       {
          $result = new \Zend_Auth_Result ( \Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID,
          null, array ("Oops! The e-mail/password is incorrect.") );
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

   }
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
    }

    /**
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
    }

    /**
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