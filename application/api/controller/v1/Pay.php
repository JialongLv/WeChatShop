<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/13
 * Time: 10:11
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\WxNotify;
use app\api\validate\IDMustBePostiveInt;
use app\api\service\Pay as PayService;

class Pay extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope' =>['only'=>'getPreOrder']
        ];
    public function getPreOrder($id=''){
        (new IDMustBePostiveInt())->goCheck();
        $pay = new PayService($id);
        return $pay->pay();
    }

    public function receiveNotify(){
        //通知频率 15/15/30/180/1800/1800/1800/3600,单位：秒
        //1.检查库存量，超卖
        //2.更新订单status状态
        //3.减库存
        //如果成功处理，我们返回微信成功处理的信息，否则，我们需要返回没有成功处理

        //特点：post：xml格式，不会携带参数
        $notify = new WxNotify();
        $notify->Handle();


    }


}