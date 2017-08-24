<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/24
 * Time: 23:03
 */

namespace app\api\model;


class ThirdApp extends BaseModel
{
    public static function check($ac, $se)
    {
        $app = self::where('app_id','=',$ac)
            ->where('app_secret', '=',$se)
            ->find();
        return $app;

    }

}