// product.js
import { Product } from 'product-model.js';
import { Cart } from '../cart/cart-model.js';

var product = new Product();  //实例化 商品详情 对象
var cart = new Cart();

Page({

  /**
   * 页面的初始数据
   */
  data: {
     id:null,
     countsArray: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
     productCount: 1,
     currentTabsIndex:0,
    
  
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (option) {
      var id = option.id;
      this.data.id = id;
      this._loadData();
  },

  _loadData: function(){
    
    product.getDetailInfo(this.data.id,(data)=>
    {
        this.setData({
            cartTotalCounts: cart.getCartTotalCounts(),
            product:data
        });
    });
  },

  
  bindPickerChange: function (event) {
      var index = event.detail.value;
      var selectedCount = this.data.countsArray[index]

      this.setData({
          productCount: selectedCount
      });
  },

      //切换详情面板
  onTabsItemTap: function (event) {
      var index = product.getDataSet(event, 'index');
      this.setData({
          currentTabsIndex: index
      });
  },

  /*跳转到购物车*/
  onCartTap: function () {
      wx.switchTab({
          url: '/pages/cart/cart'
      });
  },


  /*添加到购物车*/
  onAddingToCartTap: function (event) {
     
      this.addToCart();
      var counts = this.data.cartTotaCount + this.data.productCount;
      this.setData({
          cartTotalCounts:cart.getCartTotalCounts()
      });
  },

  /*将商品数据添加到内存中*/
  addToCart: function () {
      var tempObj = {},
     keys = ['id', 'name', 'main_img_url', 'price'];
      for (var key in this.data.product) {
          if (keys.indexOf(key) >= 0) {
              tempObj[key] = this.data.product[key];
          }
      }

      cart.add(tempObj, this.data.productCount);
  },

})