<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/5
 * Time: 20:33
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    public $code=404;
    public $msg = '指定的商品不存在，请检查参数';
    public $errorCode = 20000;
}