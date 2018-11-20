<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Project;

class ProjectController extends Controller
{
    public function create(Request $request)
    {
        Project::store($request->all());

        return;
    }

    public function fetch()
    {
        return response()->json(DB::table('projects')->get(), 200);
    }
}
