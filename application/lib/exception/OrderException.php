<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/12
 * Time: 8:46
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 404;
    public $msg = '订单不存在，请检查ID';
    public $errorCode = 80000;

}