<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    public $table = 'goods_collection';

    public function collectionuser(){
    	return $this->belongsTo('App\Model\Admin\User','collection_id');
    	
    }
}
