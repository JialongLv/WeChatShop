<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/5
 * Time: 20:32
 */

namespace app\lib\exception;


class CategoryException extends BaseException
{
    public $code = 404;
    public $msg = '指定类目不存在，；检查参数';
    public $errorCode = 50000;

}