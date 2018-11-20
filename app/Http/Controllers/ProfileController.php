<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Profile;


class ProfileController extends Controller
{
    public function fetch(Profile $profile)
    {
        return response()->json($profile->get(), 200);
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
