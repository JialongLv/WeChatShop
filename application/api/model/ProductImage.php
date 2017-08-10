<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/10
 * Time: 16:05
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
    protected $hidden = ['img_id', 'delete_time', 'product_id'];
    public function imgUrl()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }

}