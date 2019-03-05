<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Goodsinfo extends Model
{
    //

    public $table = 'goods_info';

    public function shopping(){
    	return $this->hasOne('App\Model\Home\Shopping','info_id');
    }
}
