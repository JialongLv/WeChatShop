<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/11
 * Time: 18:14
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '权限不够';
    public $errorCode = 10001;

}