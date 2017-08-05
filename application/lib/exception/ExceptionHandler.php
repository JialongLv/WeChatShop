<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/5
 * Time: 20:29
 */

namespace app\lib\exception;

use Exception;
use think\exception\Handle;

class ExceptionHandler extends Handle
{
    public function render(Exception $ex){
        return json('_________');
    }
}