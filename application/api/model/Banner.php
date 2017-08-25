<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/5
 * Time: 17:08
 */

namespace app\api\model;


class Banner extends BaseModel
{
    //php think optimize:schema
    protected $hidden=['delete_time','update_time'];


    public function items(){
        return $this->hasMany('BannerItem','banner_id','id');
    }

    public static function getBannerByID($id){
        $banner = self::with(['items','items.img'])->find($id);
        return $banner;
    }

}