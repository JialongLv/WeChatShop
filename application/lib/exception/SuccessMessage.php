<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/10
 * Time: 22:19
 */

namespace app\lib\exception;


class SuccessMessage extends BaseException
{
    public $code = 201;
    public $msg = 'ok';
    public $errorCode = 0;

}