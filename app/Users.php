<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = "users";
    protected $primaryKey= "users_id";
    public $incrementing = false;

//    public function projects() // Add Resources - Maybe that's why it's not returning data
//    {
//        return $this->belongsTo('App\Project', 'id');
////        return $this->belongsTo('App\Project', 'id');
//
//
//    }
//    public function projects()
//    {
//        return $this->belongToMany('App\Project', 'user_project', 'user_id', 'project_id');
//    }

    public function projects() // display the user
    {
        return $this->hasMany('App\Project', 'users_id');
//        return $this->belongsTo('App\Project', 'user_id');
    }
}
