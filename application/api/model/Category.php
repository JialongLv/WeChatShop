<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/6
 * Time: 16:40
 */

namespace app\api\model;


class Category extends BaseModel
{
    protected $hidden = ['delete_time','update_time','create_time'];
    public function img(){
        return $this->belongsTo('Image','topic_img_id','id');
    }
}