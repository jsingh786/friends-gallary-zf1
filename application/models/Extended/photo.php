<?php
namespace Extended;

class photo extends \Entities\photo
{
    public static function insert($img,$description,$id)
    {
        // echo "<pre>";
        // print_r($description); die;
        $em = \Zend_Registry::get('em');
        $photoObj= new \Entities\photo();
        $num=count($img);
        $no=1;
        $result = \Extended\album::get(['id'=> $id],[]);
        // echo "<pre>";
        // \Doctrine\Common\Util\Debug::dump($result);
        // die;       
        for($i=0;$i<$num;$i++)
        {
            $photoObj->setName($img[$i]);
            $em->persist($photoObj);
            $photoObj->setDescription($description[$i]);
            $photoObj->setAlbum($result[0]);
            $em->persist($photoObj);
            if ($i % $no == 0) {
            $em->flush();
            $em->clear();
           }  
        }

    }

}
