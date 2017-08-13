<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/13
 * Time: 10:33
 */

namespace app\api\service;

use app\api\model\Order as OrderModel;
use app\api\service\Order as OrderService;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;
use think\Exception;

class Pay
{
    private $orderID;
    private $orderNo;

    function __construct($orderID)
    {
        if (!$orderID){
            throw new Exception('订单号不允许为空');
        }
        $this->orderID= $orderID;
    }

    public function pay(){
        //订单号根本不存在
        //订单号存在，但是，订单号和当前用户不匹配
        //订单可能已经被支付过了
        //进行库存量检测
        $this->checkOrderValid();
        $orderService = new OrderService();
        $status = $orderService->checkOrderStock($this->orderID);
        if (!$status['pass']){
            return $status;
        }
    }
        private  function makeWxPreOrder(){
            //openid

        }

        private function checkOrderValid(){
        $order = OrderModel::where('id','=',$this->orderID)->find();

        if (!$order){
            throw new OrderException();
        }
        if (!Token::isValidOperate($order->user_id)){
            throw new TokenException([
               'msg' =>'订单与用户不匹配',
               'errorCode' =>10003
            ]);
        }
        if ($order->status != OrderStatusEnum::UNPAID){
            throw new OrderException([
               'msg' =>'订单已经支付过了',
               'errorCode' => 80003,
                'code' =>400
            ]);
        }

        $this->orderNo = $order->order_no;
        return true;


    }
}