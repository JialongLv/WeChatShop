<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/6
 * Time: 16:14
 */

namespace app\api\model;


class BannerItem extends BaseModel
{
    protected $hidden=['id','img_id','banner_id','delete_time','update_time'];
    public function img(){
        return $this->belongsTo('Image','img_id','id');
    }

}