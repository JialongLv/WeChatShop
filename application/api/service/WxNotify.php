<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/16
 * Time: 19:02
 */

namespace app\api\service;

use app\api\model\Product;
use app\api\service\Order as OrderService;
use app\api\model\Order as OrderModel;
use app\lib\enum\OrderStatusEnum;
use think\Db;
use think\Exception;
use think\Loader;
use think\Log;

Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');

class WxNotify extends \WxPayNotify
{
    public function NotifyProcess($data, &$msg)
    {
        if ($data['result_code'] == 'SUCCESS'){
            $orderNo = $data['out_trade_no'];
            Db::startTrans();
            try{
                $order = OrderModel::where('order_no','=',$orderNo)->find();
                if ($order->status == 1){
                    $service = new OrderService();
                    $stockStatus=$service->checkOrderStock($order->id);
                    if ($stockStatus['pass']){
                        $this->updateOrderStatus();
                        $this->reduceStock();
                    }
                    Db::commit();
                    return true;

                }
            }
            catch (Exception $ex){
                Db::rollback();
                Log::error();
                return false;
            }
        }else{
            return true;
        }
    }

    private function reuceStock($stockStatus){
        foreach ($stockStatus['pStatusArray'] as $singlePStatus){
            Product::where('id','=',$singlePStatus['id'])->setDec('stock',$singlePStatus['count']);
        }

    }

    private function updateOrderStatus($orderID,$success){
        $status = $success?
            OrderStatusEnum::PAID:
            OrderStatusEnum::PAID_BUT_OUT_OF;
        OrderModel::where('id','=',$orderID)->update(['status'=>$status]);
    }

}