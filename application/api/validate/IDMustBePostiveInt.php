<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/5
 * Time: 16:28
 */

namespace app\api\validate;



class IDMustBePostiveInt extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger',
        'num'=>'in:1,2,3'
    ];
    protected $message=[
        'id' => 'id必须是正整数'
    ];

    protected function isPositiveInteger($value,$rule = '',
                                         $data = '', $field = ''){

        if (is_numeric($value) && is_int($value + 0) && ($value + 0)>0){
            return true;
        }else{
            return $field.'必须是正整数';
        }
    }


}