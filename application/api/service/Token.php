<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/8
 * Time: 17:17
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

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

    public static function getCurrentTokenVar($key){
        $token = Request::instance()->header('token');

        $vars = Cache::get($token);
       if(!$vars){
            throw new TokenException();
       }else
           {if (!is_array($vars)){
               $vars = json_decode($vars,true);
           }
            if (array_key_exists($key,$vars)){
               return $vars[$key];
            }
            else{
                throw new Exception('尝试获取的Token变量不存在');
            }
       }
    }

    public static function getCurrentUid(){
        //token
        $uid = self::getCurrentTokenVar('uid');
        return $uid;

    }
}