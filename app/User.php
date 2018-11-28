<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Project;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id','name', 'email', 'password',
    ];

    public $primaryKey = 'users_id';
    public $incrementing = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    use HasApiTokens, Notifiable;

//    public function projects() // display the user
//    {
////        return $this->belongsToMany('App\Project', 'user_project');
//        return $this->hasMany('App\Project');
////        return $this->belongsTo('App\User');
//    }
}
