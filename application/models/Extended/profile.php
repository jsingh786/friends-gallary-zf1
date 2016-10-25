<?php
namespace Extended;

class profile extends \Entities\profile
{   
    /**
    * @param Insert users data into database.
    * @param array $data (key value pair, where 'key' is column) 
    * @param Created by Sublime text 2.
    * @param Date: 9/9/2016
    * @param Time: 4:46 PM    
    * @version 1.1
    * @author goyalraghav
    */
    public static function insert($data,$image,$id)
    {
        $em         = \Zend_Registry::get('em'); 
        $profileObj = new \Entities\profile();
        $result     =\Extended\users::get(['id'=>$id],[]);
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
    }

    /**
    * Edit users data into database.
    * @param array $data (key value pair, where 'key' is column) 
    * @version 1.1
    * @author goyalraghav
    */
    public static function edit($data,$image)
    {
        $sess  = new \Zend_Auth_Storage_Session('frontend_user');
        $id    = $sess->read();
        $em    = \Zend_Registry::get('em');
        $qb    = $em->createQueryBuilder();
        $query = $qb->update('\Entities\profile', 'p')
        ->set('p.photo', '?2')
        ->set('p.hobbies', '?3')
        ->set('p.education','?4')
        ->set('p.experience','?5')
        ->set('p.contact_no','?6')
        ->set('p.location', '?7')
        ->set('p.description','?8')
        ->where('p.users = ?1')
        ->setParameter(1, $id)
        ->setParameter(2, $image)
        ->setParameter(3, $data['hobbies'])
        ->setParameter(4, $data['education'])
        ->setParameter(5, $data['experience'])
        ->setParameter(6, $data['contact_no'])
        ->setParameter(7, $data['location'])
        ->setParameter(8, $data['description'])
        ->getQuery();
        $query->execute();
    }

    /**
    * Returns users data
    * on the basis of arguments passed.
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
                ->from('\Entities\profile', $alias);

        //Creating where conditions of query.
                if ($whereConditions)
        {
            $counter = 1;
            foreach ($whereConditions as $key=>$whereCondition)
            {
                $q_1->andWhere($alias.'.'.$key."=?$counter");
                $q_1->setParameter("$counter", "$whereCondition");
                $counter++;
            }
        }
        //Sorting
        if($order)
        {
            $q_1->orderBy(  $alias.'.'.$order['column'], $order['order'] );
        }
        //List length
        if($limitAndOffset)
        {
            $q_1->setFirstResult( $limitAndOffset['offset'] )
                ->setMaxResults( $limitAndOffset['limit'] );
        }
        //Debugging by getting SQL
        //echo '<pre>';
        //echo $q_1->getQuery()->getSQL(); 
        //die;
        return $q_1->getQuery()->getResult();
    }

    /**
    * Return profile data on the basis of id.
    * @param $id is an array of id's corresponding to which we function will fetch the details
    * Created by Sublime text 2.  
    * @version 1.0
    * @author goyalraghav
    */
    public static function select($id)
    {
        $em    = \Zend_Registry::get('em');
        $qb    = $em->createQueryBuilder();
        $query = $qb->select('p')
              ->from('\Entities\profile','p');
        $query->where('p.users IN (:id)');
        $query->setParameter('id', $id);
        $data  = $query->getQuery()->getArrayResult();
        return $data; 
    }

}

