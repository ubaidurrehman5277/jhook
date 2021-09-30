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
use App\Models\gradient;
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
      if (request()->has('id')) {
        $data = gradient::find(request('id'));
        $old_detail = json_decode($data->detail , true);
      }else{
        $data = new gradient;
        $old_detail = [];
      }
      $new_detail = ['This item is added on '.date('d/m/Y').' qty = '.request('qty').' price = '.request('price')];
      $data->name = request('name');
      $data->kg = request('qty');
      $data->price = request('price');
      $data->date = date('Y-m-d');
      $data->detail = json_encode(array_merge($old_detail,$new_detail));
      $data->created_at = date('Y-m-d H:i:s');
      $data->save();
      return back()->with('success','Data has been added successfully');
    }elseif(request()->has('id')){
      $data = gradient::find(request('id'));
      return view('superadmin.add-product',compact('data'));
    }
    return view('superadmin.add-product');
  }

  function gradient_list()
  {
    $record = gradient::all();
    return view('superadmin.product-list',compact('record'));
  }
}
