<?php
namespace Extended;

class friendRequest extends \Entities\friendRequest 
{     
	public static function insert($id,$recId)
    {
        $em      = \Zend_Registry::get('em');
        $request = new \Entities\friendRequest();
        $suser   = \Extended\users::get(['id'=>$id]);
        $ruser   = \Extended\users::get(['id'=>$recId]);        
        $request->setStatus('0');
        $request->setFriendRequestSender($suser[0]);
        $request->setFriendRequestReceiver($ruser[0]);
        $em->persist($request);
        $em->flush();
    }

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
        return $q_1->getQuery()->getResult();
    }
    public function update($id)
    {
        
    }
    
}

