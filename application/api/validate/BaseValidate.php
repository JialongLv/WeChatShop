<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/5
 * Time: 16:47
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck(){
        //获取http
        $request = Request::instance();
        $params = $request->param();

        $result = $this->batch()->check($params);
        if (!$result){
            $e = new  ParameterException(
                [
                    'msg' =>$this->error,
                ]
            );
//            $e->msg = $this->error;
            throw $e;
        }else{
            return true;
        }
    }

    protected function isPositiveInteger($value,$rule = '',
                                         $data = '', $field = ''){

        if (is_numeric($value) && is_int($value + 0) && ($value + 0)>0){
            return true;
        }else{
            return false;
        }
    }

    protected function isNotEmpty($value,$rule = '', $data = '', $field = '')
    {
        if (empty($value)){
            return false;
        }else{
            return true;
        }
    }

}