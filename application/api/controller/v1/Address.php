<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/10
 * Time: 19:34
 */

namespace app\api\controller\v1;

use app\api\service\Token as TokenService;
use app\api\controller\BaseController;
use app\api\model\User as UserModel;
use app\api\validate\AddressNew;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;

class Address extends BaseController
{
    //前置方法
    protected $beforeActionList  = [
        'checkPrimaryScope' =>['only'=>'createOrUpdateAddress']
    ];


    public function createOrUpdateAddress(){
        $validata = new AddressNew();
        $validata->goCheck();
        //根据Token来获取uid
        //根据uid来查找用户数据查找用户数据，判断用户是否存在，如果不存在跑出异常
        //获取客户端提交来的信息
        //根据用户地址信息是否存在，从而判断是创建地址还是更新地址

        $uid = TokenService::getCurrentUid();
        $user = UserModel::get($uid);
        if (!$user){
            throw new UserException();
        }
        $dataArray = $validata->getDataByRule(input('post.'));
        $userAddress = $user->address;
        if (!$userAddress){
            $user->address()->save($dataArray);
        }else{
            $user->address->save($dataArray);
        }

        //return $user;
        return json(new SuccessMessage(),201);
    }

}