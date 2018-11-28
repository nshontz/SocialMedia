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
            'id' => $ary['user_id'],
            'first_name' => $ary['first_name']
        ]);
    }

    public static function get($id)
    {
        return DB::table('profiles')->where('id', '=', $id)->first();

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
            'bio' => $data["bio"],
            'updated_at'=> date("Y-m-d H:i:s")
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
