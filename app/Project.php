<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public static function store($data)
    {
        self::insert([
            'id' => '123456',
            'user_name' => 'Tianni',
            'name' => $data['project_name'],
            'description' => $data["description"],
            'skill' => $data["skill"],
            'type' => $data["type"],
            'stage' => $data["stage"],
            'repository' => $data["repository"],
            'created_at' => 'Nov 20'
        ]);
    }
}
