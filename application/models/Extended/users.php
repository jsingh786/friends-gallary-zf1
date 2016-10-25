<?php
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
        $user->setpwd(md5($data['password']));
        $user->setStatus($data['status']);
        $em->persist($user);
        $em->flush();
       //return $user->getId();
    }

    /**
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
                ->from('\Entities\users', $alias);
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
            $q_1->orderBy(     $alias.'.'.$order['column'], $order['order'] );
        }
        //List length
        if($limitAndOffset)
        {
            $q_1->setFirstResult( $limitAndOffset['offset'] )
                ->setMaxResults( $limitAndOffset['limit'] );
        }
        return $q_1->getQuery()->getResult();
    }
    public static function search($name,$sid)
    {
        
        $em = \Zend_Registry::get('em');
        
        $qb = $em->createQueryBuilder();
        $query = $qb->select('u')
        ->from('\Entities\users','u');
        $query->where('u.fname LIKE :fname');
        $query->andWhere('u.id != :identifier');
        $query->setParameter('fname', $name.'%');
        $query->setParameter('identifier', $sid);
        $data= $query->getQuery()->getArrayResult();
        return $data; 
    }
    
}
