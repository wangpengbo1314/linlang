<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    public function user_register(){

    	return $this->hasOne('App\Model\Home\Userinfo','user_id');
    }
}
