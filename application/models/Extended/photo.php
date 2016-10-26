<?php
namespace Extended;
/**
 * Created by PhpStorm.
 * User: jsingh7
 * Date: 9/7/2016
 * Time: 6:36 PM
 */
class photo extends \Entities\photo

{
 /**
    * @param Insert photo data into database.
    * @param Using loop set value in array.
    * @param Created by Sublime text 2.
    * @param Date: 6/10/2016
    * @param Time: 4:46 PM    
    * @version 1.1
    * @author PathakAshish
    */
      public static function insert($img,$description,$id)
    {
       
        $em = \Zend_Registry::get('em');
        $num=count($img);
        $result=\Extended\album::get(['id'=> $id],[]);            
            for($i=0;$i<$num;$i++)
            {
                $photoObj= new \Entities\photo();
                $photoObj->setName($img[$i]);
                $photoObj->setDescription($description[$i]);
                $photoObj->setAlbum($result[0]);
                $em->persist($photoObj);
            }
            $em->flush();
            $em->clear();

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
        $alias  = 'photo';
        $q_1    = $qb_1->select($alias)
                ->from('\Entities\photo', $alias);

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
    public static function select($id)
    {
        $em    = \Zend_Registry::get('em');
        $qb    = $em->createQueryBuilder();
        $query = $qb->select('p')
                ->from('\Entities\photo','p');
        $query->where('p.album IN (:id)');
        $query->setParameter('id',$id);
        // echo $query->getQuery()->getSQL();
        // die;
        $data  = $query->getQuery()->getArrayResult();
        //  echo "<pre>";
        // print_r($data);
        // die;
        return $data; 
    }
}