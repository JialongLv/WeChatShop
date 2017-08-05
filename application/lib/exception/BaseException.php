<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/5
 * Time: 20:30
 */

namespace app\lib\exception;


class BaseException
{
    public $code  = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;

}