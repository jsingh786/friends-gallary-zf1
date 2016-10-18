<?php
namespace Extended;
class friendRequest extends \Entities\friendRequest 
{ 
 /**
     * To Insert users data into database.
     *
     * @param array $data (key value pair, where 'key' is column)
     * @return integer ID
     * @version 1.0
     * @author singhSandeep
     * Date: 5/10/2016
     * Time: 2:13 PM
     */    
    public static function insert($id,$recId)
    {
        $em     = \Zend_Registry::get('em');
        $suser  = \Extended\users::get(['id'=>$id]);
        $ruser  = \Extended\users::get(['id'=>$recId]);
        $request= new \Entities\friendRequest();
        $request->setStatus(0);
        $request->setFriendRequestSender($suser[0]);
        $request->setFriendRequestReceiver($ruser[0]);
        $em->persist($request);
        $em->flush();
        return $request->getId();
    }

    public static function get(array $whereConditions = [],
    array $limitAndOffset = [] ,
    array $order = [])
    {
        $em     = \Zend_Registry::get('em');
        $qb_1   = $em->createQueryBuilder();

        $alias  = 'usrs';

        $alias  = 'friendrequest';

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
        return $q_1->getQuery()->getResult();
    }
    
    /**
     * To update friend request table status into 0 to 1 data into database.
     * @param array $data (key value pair, where 'key' is column)
     * @version 1.0
     * @author singhSandeep
     * Date: 6/10/2016
     * Time: 3:13 PM
     */
    public static function update($sid,$rid)
    {
      
        $qb = \Zend_Registry::get('em')->createQueryBuilder();
        $q  = $qb->update('\Entities\friendRequest', 'f')
        ->set('f.status', $qb->expr()->literal(1))
        ->where('f.friendRequestSender = ?1')
        ->andWhere('f.friendRequestReceiver = ?2')
        ->setParameter(1, $sid)
        ->setParameter(2, $rid)
        ->getQuery();
        $p = $q->execute();
    }
    /**
     * To Chanje  friend request table status into 0 to 2 data into database.
     * @param array $data (key value pair, where 'key' is column)
     * @version 1.0
     * @author singhSandeep
     * Date: 10/10/2016
     * Time: 3:13 PM
     */
    public static function delete($sid,$rid)
    {
        $qb = \Zend_Registry::get('em')->createQueryBuilder();
        $q = $qb->update('\Entities\friendRequest', 'f')
        ->set('f.status', $qb->expr()->literal(2))
        ->where('f.friendRequestSender = ?1')
        ->andWhere('f.friendRequestReceiver = ?2')
        ->setParameter(1, $sid)
        ->setParameter(2, $rid)
        ->getQuery();
        $p = $q->execute();
    }
     /**
     * To Serch new friend in search bar for making new friends.
     * @param array $data (key value pair, where 'key' is column)
     * @version 1.0
     * @author singhSandeep
     * Date: 10/10/2016
     * Time: 6:13 PM
     */
    public static function select($id)
    {
       $em    = \Zend_Registry::get('em');
       $qb    = $em->createQueryBuilder();
       $query = $qb->select('p')
       ->from('\Entities\users','p');
       $query->where('p.id IN (:validated)');
       $query->setParameter('validated', $id);
       $data  = $query->getQuery()->getResult();
       return $data;
    }

    public static function dispfriend($id)
    {
        // echo $id; die; 
        $em    = \Zend_Registry::get('em');
        $qb    = $em->createQueryBuilder();
        $query = $qb->select('f')
        ->from('\Entities\friendRequest','f');
        $query->where('f.friendRequestSender :id');
        // $query->orwhere('f.friendRequestReceiver :rid');
        // $query->andWhere('f.status : status');
        $query->setParameter("id" ,$id);
        // $query->setParameter('rid', $id);
        // $query->setParameter('status','1');
        // echo $query->getSQL()->getQuery();
        // die;
        $data =$query->getQuery()->getResult();
       // \Doctrine\Common\Util\Debug::dump($data); die;
       // echo $data; die;
       return $data;

    }
}

