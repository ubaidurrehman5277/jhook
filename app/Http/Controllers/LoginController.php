<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\table;
use App\Models\Product;
use App\Models\Menu;

class LoginController extends Controller
{
  function login(Request $request){
    if (request()->isMethod('post')) {
      $username = request('email');
      $password = request('password');
      if (Auth::guard('admin')->attempt(['email' => $username, 'password' => $password])) {
        return redirect(route('sales'));
      }else{
        return back()->with('error','Invalid Attempts');
      }
    }
    return view('user.login');
  }
}
