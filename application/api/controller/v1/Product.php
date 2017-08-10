<?php
/**
 * Created by PhpStorm.
 * User: 87204
 * Date: 2017/8/6
 * Time: 16:45
 */

namespace app\api\controller\v1;

use app\api\model\Product as ProductModel;
use app\api\validate\Count;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\ProductException;


class Product
{
    /**
     * 根据类目ID获取该类目下所有商品(分页）
     * @url /product?id=:category_id&page=:page&size=:page_size
     * @param int $id 商品id
     * @param int $page 分页页数（可选)
     * @param int $size 每页数目(可选)
     * @return array of Product
     * @throws ParameterException
     */
    public function getRecent($count=15){
        (new Count())->goCheck();
        $products = ProductModel::getMostRecent($count);
        if ($products->isEmpty()){
            throw new ProductException();
        }

        $products = $products->hidden(['summary']);
        return $products;
    }


    /**
     * 获取指定数量的最近商品
     * @url /product/recent?count=:count
     * @param int $count
     * @return mixed
     * @throws ParameterException
     */
    public function getAllInCategory($id){
        (new IDMustBePostiveInt())->goCheck();
        $products =ProductModel::getProductsByCategoryID($id);
        if ($products->isEmpty()){
            throw new ProductException();
        }
        $products = $products->hidden(['summary']);
        return $products;
    }

    /**
     * 获取商品详情
     * 如果商品详情信息很多，需要考虑分多个接口分布加载
     * @url /product/:id
     * @param int $id 商品id号
     * @return Product
     * @throws ProductException
     */
    public function getOne($id){
        (new IDMustBePostiveInt())->goCheck();
        $product = ProductModel::getProductDetail($id);
        if (!$product){
            throw new ProductException();
        }
        return $product;
    }

}