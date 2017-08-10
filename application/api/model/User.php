<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/7
 * Time: 21:19
 */

namespace app\api\model;


class User extends BaseModel
{
    public function address(){
        return $this->hasOne('UserAddress','user_id','id');
    }

    public static function getByOpenID($openid){
        $user = self::where('openid','=',$openid)->find();
        return $user;
    }



}