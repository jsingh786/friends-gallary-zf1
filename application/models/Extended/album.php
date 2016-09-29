<?php
namespace Extended;

class album extends \Entities\album
{
    public function create($data)
    {
        //$userObj = \Extended\users::get(['id'=>1], ['limit'=>9, 'offset'=>1]);
        $em = \Zend_Registry::get('em');
        $album= new \Entities\album();       
        $album->setName($data['name']);
        $album->setLocation($data['location']);
        $album->setDescription($data['description']);
        $album->setUsers($userObj[0]);
        $em->persist($album);
        $em->flush();
        $id=$album->getId();
        return $id;
    }

    /**
     * Returns album data
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
        return $q_1->getQuery()->getArrayResult();
    }

}
