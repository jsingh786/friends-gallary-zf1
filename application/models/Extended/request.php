<?php
namespace Extended;
class request extends Zend_db_Table
{     
	public static function select()
	{
		$em= \Zend_Registry::get('em');
        $qb= $em->createQueryBuilder();
        $select = $qb->select();
		$select->from( 'users',  array('fname', 'lname', 'email'))
       			// ->join(array('pa' => 'Person_Address'), 'pa.person_id = p.person_id', array())
       			->joinFull('profile','profile.id = users.id',array('description', 'hobbies', 'location'));
       			 $select->execute();
	}
}

