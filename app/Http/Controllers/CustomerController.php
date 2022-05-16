<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

    function get(Request $request) {
        if(strpos($_SERVER['HTTP_USER_AGENT'], "Line") !== false) {
            return view('customer');
        } else {
            return redirect()->to('https://www.chapayom.com/');
        }
    }

    function post(Request $request) {
        $customers = User::get_users($request->input('user_id'));
        return $customers;
    }

    function save(Request $request) {

      $lineid = $request->input('line_id');
      $name = $request->input('username');
      $branch = $request->input('branch');
      $phone_number = $request->input('phone_number');
      $code = $request->input('code');

      $validator = Validator::make($request->all(), [
            'username' => 'required|min:2|max:64',
            'branch' => 'required|min:2|max:64',
            'phone_number' => 'required|digits:10',
      ]);

      if ($validator->fails()) {
          return response()->json('error');
      }

      if(strtolower($code) == "3525bkk" || strtolower($code) == "353535") {

      $user = User::add_users($lineid, $name, $phone_number, $branch, $code);

      $customers =  User::get_users($lineid);

      Auth::login($user);

      if($customers)
        return response()->json('success');
      else
        return response()->json('fail');
      }
      else {
        return response()->json('incorrect');
      }

    }

    function get_customer(Request $request) {
        if($request->ajax()) {
            $customers = User::get_users_data(Auth::user()->line_id);

            if (!$customers) {
                return response()->json("null");
            }
            return response()->json($customers);
        }
        return abort(404);

    }

    function disable(Request $request) {
        return abort(404);
    }

}
