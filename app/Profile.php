<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Profile extends Model
{

    public static function create($ary)
    {
        DB::table('profiles')->insert([
            'image_path' => null,
            'user_id' => $ary['user_id'],
            'first_name' => $ary['name']
        ]);
    }

    public function get()
    {
        return DB::table('profiles')->where('first_name', '=', 'Tianni')->first();

    }

    public static function store($data)
    {
        DB::table('profiles')->where('first_name', '=', 'Tianni')->update([
            'first_name' => $data["firstName"],
            'last_name' => $data["lastName"],
            'headline' => $data["headline"],
            'city' => $data["city"],
            'state' => $data['state'],
            'zip_code' => $data["zipcode"],
            'bio' => $data["bio"]
//            'updated_at'=> date('m-d-Y:h:i:s', time())
        ]);

    }

    public static function storeImage($path)
    {
        DB::table('profiles')->where('first_name', '=', 'Tianni')->update([
            'image_path' => $path
        ]);
    }


    public static function getImage($name)
    {
        return DB::table('profiles')->where('first_name', '=', $name)->value('image_path');
    }

}
