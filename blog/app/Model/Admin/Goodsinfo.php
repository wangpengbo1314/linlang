<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Goodsinfo extends Model
{
    public $table = 'goods_info';

   

	//商品详情和评论
     public function goodscomment(){
    	return $this->hasMany('App\Model\Admin\Goodscomment','cargo_id'); //cargo_id存的是商品详情的id
    }

    //商品和收藏
    public function goodscollection(){
        return $this->hasOne('App\Model\Admin\Collection','cargo_id');
    }
    
}
