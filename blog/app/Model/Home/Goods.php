<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    public $table = 'goods';

    public function goodsinfo(){
    	return $this->hasOne('App\Model\Home\Goodsinfo','goods_id');
    }
}
