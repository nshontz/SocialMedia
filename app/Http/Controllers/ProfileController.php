<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Profile;
use App\Users;

class ProfileController extends Controller
{
    public function fetch()
    {
//        return response()->json(Profile::get(Auth::id()), 200);
//        User::find(Auth::id())->with('project');
        $data = Users::find(Auth::user()->users_id)->projects;
//        $data = Users::with('projects')->get();
        return response()->json($data, 200);

    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'string',
            'lastName' => 'string',
            'headline' => 'string',
            'city' => 'string',
            'state' => 'string|max:2',
            'zipcode' => 'nullable|string',
            'bio' => 'string|max:150',
            'avatar' => ''
        ]);

        Profile::store($request->all());

        if($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('images', 'public');
            Profile::storeImage($path);

            return response()->json($path, 200);
        }

        response()->json(['success' => 'success'], 200);
    }
}

//return response()->json(Users::with('projects')->get(), 200); Users model w/ projects

