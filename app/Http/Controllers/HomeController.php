<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    function index(Request $request) {

        if($request->input('mode') != "admin_tsch") {

          if(strpos($_SERVER['HTTP_USER_AGENT'], "Line") !== false) {
              $products = Product::get_products();
              return view('welcome', compact('products'));
          } else {
            return redirect()->to('https://www.chapayom.com/');
          }
        }

        $products = Product::get_products();
        return view('welcome', compact('products'));
    }
}
