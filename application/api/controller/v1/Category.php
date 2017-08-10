<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/6
 * Time: 16:10
 */

namespace app\api\controller\v1;
use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;

class Category
{
    /**
     * 获取全部类目列表，但不包含类目下的商品
     * Request 演示依赖注入Request对象
     * @url /category/all
     * @return array of Categories
     * @throws MissException
     */
    public function getAllCategories(){
        $categories =CategoryModel::all([],'img');
        if ($categories->isEmpty()){
            throw new CategoryException();
        }
        return $categories;
    }

}