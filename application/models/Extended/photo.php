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
      public static function insert($img,$description,$id)
    {
        // echo $id; die;

        $em = \Zend_Registry::get('em');
        // echo "<pre>";
        // print_r($description); die;
        $num=count($img);
        $no=1;
         $result=\Extended\album::get(['id'=> $id],[]);
        // echo "<pre>";
        // \Doctrine\Common\Util\Debug::dump($result);
        // die;        
            for($i=0;$i<$num;$i++)
            {
                $photoObj= new \Entities\photo();
                $photoObj->setPhoto($img[$i]);
                $photoObj->setDescription($description[$i]);
                $photoObj->setAlbum($result[0]);
                $em->persist($photoObj);
            }
            $em->flush();
            $em->clear();

        }


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

}











    






    



       