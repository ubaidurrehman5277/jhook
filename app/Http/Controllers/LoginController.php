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

class LoginController extends Controller
{
  function login(Request $request){
    if (request()->isMethod('post')) {
      $username = request('email');
      $password = request('password');
      if (Auth::guard('login')->attempt(['email' => $username, 'password' => $password])) {
        return redirect(route('sales'));
      }else{
        return back()->with('error','Invalid Attempts');
      }
    }
    return view('user.login');
  }
  function sales(Request $request)
  {
    $all_menus = Menu::all();
    $menus = Menu::whereNotNull('main_menu')->orderby('id','desc')->get();
    $tables = table::orderby('id','desc')->get();
    if (request()->isMethod('post')) {
      request()->validate([
        'menu' => 'required|numeric|min:1',
        'qty' => 'required|numeric|min:1',
        'total_price' => 'nullable|numeric|min:1',
      ],[
        'menu.required' => 'Menu name field is required',
        'qty.required' => 'Item/Kg field is required',
        'menu.numeric' => 'Please choose value from dropdown',
        'qty.numeric' => 'Item/Kg must be a numeric value',
        'total_price.numeric' => 'Price must be a number',
        'total_price.min' => 'Price must be greater than zero',
      ]);
      $old_detail = array();
      if (request()->has('orderId') and is_numeric(request('orderId'))) {
        $order = Sale::find(request('orderId'));
        $old_detail = json_decode($order->order_detail,true);
        $message = ['success','Order has been updated successfully'];
      }else{
        request()->validate([
          'table' => 'required|numeric|min:1',
        ],[
          'table.required' => 'Table field is required',
          'table.numeric' => 'Please choose value from dropdown',
        ]);
        $order = new Sale;
        $order->date = date('Y-m-d');
        $order->created_at = date('Y-m-d H:i:s');
        $order->table_no = request('table');
        $message = ['success','Order has been placed successfully'];
      }
      $mm = $menus->where('id',request('menu'))->first();
      $price = request('total_price');
      $as_price = ($mm) ? $mm->asuming_price : 0;
      $name = ($mm) ? $mm->name : "";
      $qty = request('qty');
      $new_detail = ['name' => $name,'qty' => request('qty'),'price' => $price*$qty];
      if ($old_detail) {
        $old_detail[] = $new_detail;
        $order_detail = $old_detail;
      }else{
        $order_detail[] = $new_detail;
      }
      $order->cat_id = request('menu');
      $order->total_price = $price;
      $order->ass_price = $as_price;
      $order->qty = request('qty');
      $order->order_detail = json_encode($order_detail);
      $order->save();
      return redirect(route('sales')."?orderId=".$order->id)->with($message);
    }else if(request()->has('orderId') and is_numeric(request('orderId')))
    {
      $data = Sale::find(request('orderId'));
      $order_detail = json_decode($data->order_detail , true);
      // dd($order_detail);
      return view('user.sales',compact('menus','tables','all_menus','data'));
    }
    return view('user.sales',compact('menus','tables','all_menus'));
  }

  function sales_list(Request $request)
  {
    $record = Sale::orderby('id','desc')->get();
    $all_menus = Menu::all();
    return view('user.sales-list', compact('record','all_menus'));
  }

  function order_status()
  {
    if (request()->has('paid') and is_numeric(request('paid'))) {
      $order = Sale::find(request('paid'));
      if ($order) {
        $order->status = 'paid';
        $order->save();
        $order_detail = json_decode($order->order_detail,true);
        session(['paid'=>$order_detail]);
        return back()->with('success','Order has been paid successfully');
      }else{
        return abort('404');
      } 
    }elseif (request()->has('cancel') and is_numeric(request('cancel'))) {
      $order = Sale::find(request('cancel'));
      if ($order) {
        $order->status = 'cancel';
        $order->save();
        return back()->with('success','Order has been cancelled successfully');
      }else{
        return abort('404');
      } 
    }
  }
}
