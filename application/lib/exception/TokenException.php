<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/8
 * Time: 17:40
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'Token已过期或无效Token';
    public $errorCode = 10001;

}