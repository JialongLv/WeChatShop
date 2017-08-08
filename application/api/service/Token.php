<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/8
 * Time: 17:17
 */

namespace app\api\service;


class Token
{
    public static function generateToken(){
        //随机生成32位字符串
        $randChars = getRandChar(32);
//        用三组字符串，进行md5加密
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
//        salt 盐
        $salt = config('secure.token_salt');
        return md5($randChars.$timestamp.$salt);
    }
}