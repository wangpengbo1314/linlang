<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    public $table = 'user_register';

    public function userinfo(){

    	return $this->hasOne('App\Model\Home\Userinfo','user_id');
    }
}
