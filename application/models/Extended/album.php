<?php
namespace Extended;

class album extends \Entities\album
{
        public function create($data)
    {
        $sess= new \Zend_Auth_Storage_Session('Frontend users');
        $id = $sess->read();
        $userObj = \Extended\users::get(['id'=>$id], ['limit'=>1, 'offset'=>0]);
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
    }


    public static function get(array $whereConditions = [],
                               array $limitAndOffset = [] ,
                               array $order = [])
    {
        $em     = \Zend_Registry::get('em');
        $qb_1   = $em->createQueryBuilder();
        $alias  = 'album';
        $q_1    = $qb_1->select($alias)
                ->from('\Entities\album', $alias);

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

    public static function select()
    {
        $em = \Zend_Registry::get('em');
        $qb = $em->createQueryBuilder();
        $alias = 'album';
        $query = $qb->select($alias)
        ->from('\Entities\album', $alias);
        
        return $query->getQuery()->getResult();
    }

}
