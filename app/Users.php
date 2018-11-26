<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = "users";

    public function projects() // Add Resources - Maybe that's why it's not returning data
    {
        return $this->hasMany('App\Project', 'id');

    }

//    public function users() // display the user
//    {
//        return $this->hasMany('App\Project', 'id');
//    }
}
