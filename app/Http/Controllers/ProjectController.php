<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Project;
use App\Users;


class ProjectController extends Controller
{
    protected $actions = ["framework", "skill", "type", "stage", "language"]; // map to method in model

    public function create(Request $request)
    {
//        Project::store($request->all(), Auth::id());

        return response()->json(Project::store($request->all(), Auth::id()), 201);// return a 201 when a new item is created
    }

    public function index(Request $request)
    {
        if($request->id){
            return response()->json(Project::getByKey($request->id), 200);
        } else {
            return response()->json(DB::table('projects')->get(), 200);
        }
    }

    public function search(Request $request)
    {// Test
        $data = Project::getBySearch($request->action, $request->id);
        return response()->json($data, 200);
    }

    public function test()
    {
//        $project = new Project();
//        return response()->json(Project::getWithUser(), 200);
//        dd(Project::with('users')->get());
//        return response()->json(Project::with('users')->get(), 200);
//        return response()->json(Project::with('users')->get(), 200);
        return response()->json(Project::with('users')->get(), 200);

//        $projects = Users::find(1)->projects()->orderBy('name')->get();
//        return response()->json($projects, 200);

    }
}
