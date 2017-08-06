<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/6
 * Time: 18:38
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,30'
    ];
}