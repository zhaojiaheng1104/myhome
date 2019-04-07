<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
     public $table = 'users';

    public function usersinfo(){
    	return $this->hasOne('App\Models\Admin\Usersinfo','user_id');
    }
}
