<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    function index(Request $request) {
        if(strpos($_SERVER['HTTP_USER_AGENT'], "Line") !== false) {
            return view('profile');
        } else {
            return redirect()->to('https://www.chapayom.com/');
        }
    }

    function login(Request $request) {
        $lineid = $request->input('line_id');
        $user = User::get_users_data($lineid);
        if(!Auth::check()) {
            Auth::login($user);
            return response()->json('success');
        }
        return response()->json('log');
    }

    function edit(Request $request) {
        $name = $request->input('name');
        $branch = $request->input('branch');
        $phone_number = $request->input('phone_number');

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:35',
            'branch' => 'required|min:3|max:64',
            'phone_number' => 'required|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json('error');
        }

        $customers = User::where('line_id', Auth::user()->line_id)->first();
        $customers->name = $name;
        $customers->branch = $branch;
        $customers->phone_number = $phone_number;
        $customers->save();

        return response()->json('success');
    }

    function disable(Request $request) {
        return abort(404);
    }

}
