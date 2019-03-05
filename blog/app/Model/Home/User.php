<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    public $table = 'user_register';

    public function userinfo(){

    	return $this->hasMany('App\Model\Home\Userinfo','user_id');
    }

    public function userlogin(){

    	return $this->hasMany('App\Model\Home\Userlogin','user_id');
    }

    public function useraddress(){

    	return $this->hasMany('App\Model\Home\Address','user_id');
    }
}
