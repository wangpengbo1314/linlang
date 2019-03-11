<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
	//商品和商品详情
    public function goodsinfo(){

    	 return $this->hasOne('App\Model\Admin\Goodsinfo','goods_id');
    }
    //商品和评论
    public function goodscomment1(){

    	 return $this->hasMany('App\Model\Admin\Goodscomment','goods_id');
    }
    //商品和订单
    public function goodsorder(){
    	 return $this->belongsTo('App\Model\Admin\Order','order_id');
    }
   
    
       
}
