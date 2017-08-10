<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/10
 * Time: 22:00
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code = 404;
    public $msg = '用户不存在';
    public $errorCode = 60000;

}