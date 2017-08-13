<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/13
 * Time: 10:11
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\IDMustBePostiveInt;

class Pay extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope' =>['only'=>'getPreOrder']
        ];
    public function getPreOrder($id=''){
        (new IDMustBePostiveInt())->goCheck();
    }
}