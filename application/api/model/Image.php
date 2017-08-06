<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/6
 * Time: 16:18
 */

namespace app\api\model;


class Image extends BaseModel
{

    protected $hidden = ['id','from','delete_time','update_time'];

    public function getUrlAttr($value,$data){
        return $this->prefixImgUrl($value,$data);
    }


}