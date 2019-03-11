<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $table = 'user_register';

    // public function usergoods(){
    // 	 return $this->hasMany('App\Model\Admin\Goods','user_id');
    // }
    public function userorder(){
    	return $this->hasMany('App\Model\Admin\Order','user_id');
    }

    public function usercomment(){
    	return $this->hasMany('App\Model\Admin\Goodscomment','user_id');
    }
    //用户和收藏
    public function usercollection(){
        return $this->hasMany('App\Model\Admin\Collection','user_id');
    }
}
