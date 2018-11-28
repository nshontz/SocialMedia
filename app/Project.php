<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Users;

class Project extends Model
{
    protected $table = "projects";
    protected $primaryKey = 'project_id';

    public static function store($data, $auth)
    {
        self::insert([
            'id' => '123456',
            'user_id' => '5bf157234187e',
            'name' => $data['project_name'],
            'description' => $data["description"],
            'skill' => $data["skill"],
            'type' => $data["type"],
            'stage' => $data["stage"],
            'repository' => $data["repository"],
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }


    public static function getBySearch($action, $value)
    {
        return self::where($action, '=', $value)->get();
    }

    public static function getByKey($key)
    {
        return DB::table('projects')->where('project_key', '=', $key)->first();
    }

//    public function users() // display the user
//    {
//        return $this->hasMany('App\Users', 'id');
//    }

//    public function users() // display the user
//    {
//        return $this->hasOne('App\Users', 'user_id');
//    }


//    public function users() // Add Resources - Maybe that's why it's not returning data
//    {
//        return $this->hasMany('App\Users');
////        return $this->hasMany('App\Users', 'id');
//
//
//    }

    public function users()
    {
        return $this->belongsTo('App\Users','users_id');
//        return $this->hasMany('App\Users');

    }

//
    public static function getWithUser() {
        return DB::raw("SELECT * from projects INNER JOIN users ON projects.users_id = users.id " );
    }

}
