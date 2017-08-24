<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/24
 * Time: 22:57
 */

namespace app\api\validate;


class AppTokenGet extends BaseValidate
{
    protected $rule = [
        'ac' => 'require|isNotEmpty',
        'se' => 'require|isNotEmpty'
    ];
}