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

    public function userlogin(){

    	return $this->hasOne('App\Model\Home\Userlogin','user_id');
    }

    public function useraddress(){

    	return $this->hasMany('App\Model\Home\Address','user_id');
    }

    public function shop(){
        return $this->hasMany('App\Model\Home\Shopping','user_id');
    }
}
