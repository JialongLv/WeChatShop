<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/6
 * Time: 16:19
 */

namespace app\api\model;


use think\Model;

class BaseModel  extends Model
{
    protected function prefixImgUrl($value,$data){
        $finalUrl = $value;
        if($data['from'] == 1){
            $finalUrl = config('setting.img_prefix').$finalUrl;
        }
        return $finalUrl;
    }
}