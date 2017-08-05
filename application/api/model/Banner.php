<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/5
 * Time: 17:08
 */

namespace app\api\model;


use think\Db;
use think\Exception;

class Banner
{
    public static function getBannerByID($id){
//        $result=Db::query('select * from banner_item WHERE banner_id=?',[$id]);
//        return $result;
        $result = Db::table('banner_item')->where('banner_id','=',$id)->select();
        return $result;
    }
}