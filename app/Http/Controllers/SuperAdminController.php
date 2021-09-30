<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\table;
use App\Models\Product;
use App\Models\Menu;
use App\Models\Sale;
use DB;
use Response;

class SuperAdminController extends Controller
{
  function dashboard(Request $req){
    if (auth('admin')->user()->type == 'admin') {
        return redirect(route('dashboard'));
    }
    $tuser    = User::count();
    $ttable   = table::count();
    $tmenu    = Menu::whereNull('main_menu')->count();
    $tsmenu    = Menu::whereNotNull('main_menu')->count();
    $tproduct = Product::count();
    $tpending    = Sale::where('status','pending')->count();
    // $tsale    = Sale::where('date','date("d M Y")')->count();
    $tsale = Sale::where(['date'=>date("Y-m-d"),'status'=>'paid'])->sum('total_price');
    return view('superadmin.dashboard',compact('tuser','ttable','tmenu','tsmenu','tproduct','tpending','tsale'));
  }

  function add_gradient(Request $request)
  {
    if(request()->isMethod('post')){

    }
    return view('superadmin.add-product');
  }
}
