<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //商品和订单
    public function ordergoods(){
    	return $this->hasMany('App\Model\Admin\Goods','order_id');
    }
    //用户和订单
    public function orderuser(){
    	 return $this->belongsTo('App\Model\Admin\User','order_id');
    }


    
}
