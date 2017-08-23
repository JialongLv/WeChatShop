import { Base } from '../../utils/base.js';

/*
* 购物车数据存放在本地，
* 当用户选中某些商品下单购买时，会从缓存中删除该数据，更新缓存
* 当用用户全部购买时，直接删除整个缓存
*
*/

class Cart extends Base{
    constructor() {
        super();
        this._storageKeyName = 'cart';

}


    /*
    * 加入到购物车
    * 如果之前没有样的商品，则直接添加一条新的记录，             数量   为 counts
    * 如果有，则只将相应数量 + counts
    * @params:
    * item - {obj} 商品对象,
    * counts - {int} 商品数目,
    * */
    add(item, counts){
        var cartData = this.getCartDataFromLocal();
        
        var isHadInfo = this._isHasThatOne(item.id, cartData);
        //新商品
        if (isHadInfo.index == -1) {
            item.counts = counts;
            item.selectStatus = true;  //默认在购物车中为选中状态
            cartData.push(item);
        }
        //已有商品
        else {
            cartData[isHadInfo.index].counts += counts;
        }
        wx.setStorageSync(this._storageKeyName,cartData);  //更新本地缓存
        

    }

    /*
    * 从缓存获取购物车
    * param
    * flag - {bool} 是否过滤掉不下单的商品
    */
    getCartDataFromLocal(flag) {
        var res = wx.getStorageSync(this._storageKeyName);
        if (!res) {
            res = [];
        }
        //在下单的时候过滤不下单的商品，
        if (flag) {
            var newRes = [];
            for (let i = 0; i < res.length; i++) {
                if (res[i].selectStatus) {
                    newRes.push(res[i]);
                }
            }
            res = newRes;
        }
        

        return res;
    };


getCartTotalCounts(flag){
    var data = this.getCartDataFromLocal();
    var counts = 0;

    for (let i = 0; i< data.length; i++){
        if(flag){
            if (data[i].selectStatus){
                counts += data[i].counts;
            }
        }
        else{
            counts += data[i].counts;
        }
       
    }
    return counts;
}

/*
 * 修改商品数目
 * params:
 * id - {int} 商品id
 * counts -{int} 数目
 * */
_changeCounts(id, counts) {
    var cartData = this.getCartDataFromLocal(),
        hasInfo = this._isHasThatOne(id, cartData);
    if (hasInfo.index != -1) {
        if (hasInfo.data.counts > 1) {
            cartData[hasInfo.index].counts += counts;
        }
    }
    wx.setStorageSync(this._storageKeyName, cartData);  //更新本地缓存
};

/*
* 增加商品数目
* */
addCounts(id) {
    this._changeCounts(id, 1);
};

/*
* 购物车减
* */
cutCounts(id) {
    this._changeCounts(id, -1);
};


/*
    * 删除某些商品
    */
delete(ids) {
    if (!(ids instanceof Array)) {
        ids = [ids];
    }
    var cartData = this.getCartDataFromLocal();
    for (let i = 0; i < ids.length; i++) {
        var hasInfo = this._isHasThatOne(ids[i], cartData);
        if (hasInfo.index != -1) {
            cartData.splice(hasInfo.index, 1);  //删除数组某一项
        }
    }
    wx.setStorageSync(this._storageKeyName, cartData); 
}


    /*购物车中是否已经存在该商品*/
    _isHasThatOne(id, arr) {
        var item,
            result = { index: -1 };
        for (let i = 0; i < arr.length; i++) {
            item = arr[i];
            if (item.id == id) {
                result = {
                    index: i,
                    data: item
                };
                break;
            }
        }
        return result;
    }


}

export { Cart };
