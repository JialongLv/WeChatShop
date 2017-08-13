<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/12
 * Time: 18:37
 */

namespace app\api\model;


class Order extends BaseModel
{
    protected $hidden = ['user_id', 'delete_time', 'update_time'];
    protected $autoWriteTimestamp = true;

}