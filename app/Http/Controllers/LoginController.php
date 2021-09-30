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
use App\Models\SSale;

class LoginController extends Controller
{
  function login(Request $request){
    if (request()->isMethod('post')) {
      $username = request('email');
      $password = request('password');
      if (Auth::guard('login')->attempt(['email' => $username, 'password' => $password])) {
        if (auth('login')->user()->type == 'cashier') {
          return redirect(route('sales'));
        }else{
          return redirect(route('shop-sale'));
        }
      }else{
        return back()->with('error','Invalid Attempts');
      }
    }
    return view('user.login');
  }
  function sales(Request $request)
  {
    // dd(auth('login')->user()->type);
    if (auth('login')->user()->type == 'shop') {
      return redirect(route('shop-sale'));
    }
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
        $old_qty = $order->qty;
        $old_price = $order->total_price;
        $old_asprice = $order->ass_price;
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
      $qty = request('qty');
      $mm = $menus->where('id',request('menu'))->first();
      $price = request('total_price');
      $as_price = (!empty($old_asprice)) ? $old_asprice + ($mm->asuming_price * request('qty')) : $mm->asuming_price * request('qty');
      $name = ($mm) ? $mm->name : "";
      $qty = (!empty($old_qty)) ? $old_qty + $qty : $qty;
      $new_detail = ['name' => $name,'qty' => request('qty'),'price' => $price];
      $price = (!empty($old_price)) ? $old_price + $price : $price;
      if ($old_detail) {
        $old_detail[] = $new_detail;
        $order_detail = $old_detail;
      }else{
        $order_detail[] = $new_detail;
      }
      $order->cat_id = request('menu');
      $order->total_price = $price;
      $order->ass_price = $as_price;
      $order->qty = $qty;
      $order->order_detail = json_encode($order_detail);
      $order->save();
      return redirect(route('sales')."?orderId=".$order->id)->with($message);
    }else if(request()->has('orderId') and is_numeric(request('orderId')))
    {
      $data = Sale::find(request('orderId'));
      if($data){
        $order_detail = json_decode($data->order_detail , true);
        // dd($order_detail);
        return view('user.sales',compact('menus','tables','all_menus','data'));
      }else{
        return abort(404);
      }
    }
    return view('user.sales',compact('menus','tables','all_menus'));
  }

  function sales_list(Request $request)
  {
    if (auth('login')->user()->type == 'cashier') {
      
      $record = Sale::orderby('id','desc')->get();
      $all_menus = Menu::all();
      return view('user.sales-list', compact('record','all_menus'));
    }else{
      $record = SSale::orderby('id','desc')->get();
      $all_menus = Product::all();
      return view('shop.sales-list', compact('record','all_menus'));
    }
  }

  function shop(Request $request){
    $products = Product::where('quantity','>','0')->get();
    $order_detail = array();
    if (request()->isMethod('post')) {
      request()->validate([
        'pname' => 'required',
        'available_quantity' => 'required|numeric|min:1',
        'qty' => 'required|numeric|min:1',   
        'total_price' => 'nullable|numeric|min:1',
      ],[
        'pname.required' => 'Product name field is required',
        'qty.required' => 'Item/Kg field is required',
        'menu.numeric' => 'Please choose value from dropdown',
        'qty.numeric' => 'Item/Kg must be a numeric value',
        'total_price.numeric' => 'Price must be a number',
        'total_price.min' => 'Price must be greater than zero',
      ]);
      if (request()->has('orderid')) {
        $shop_sale = SSale::find(request('orderid'));
        $old_price = $shop_sale->price;
        $old_qty = $shop_sale->quantity;
        $old_product = $shop_sale->product_name;
        $old_order_detail = json_decode($shop_sale->order_detail , true);
      }else{
        $shop_sale = new SSale;
        $old_order_detail = [];
        $old_price = 0;
        $old_qty   = 0;
        $old_product = "";
      }
      // dd(request()->all());
      // $product = explode(',',$old_product);
      $data = Product::where('id',request('pname'))->first();
       $quantity = $data->quantity - $request->qty;
      $shop_sale->product_name = (!empty($old_product))?implode(',', [$old_product,$request->pname]):$request->pname;
      $shop_sale->quantity = $old_qty + $request->qty;
      $shop_sale->price = $old_price + $request->total_price;
      $array = ['product_name' => request('pname'),'qty' => request('qty'),'price' => request('total_price')];
      array_push($old_order_detail, $array);
      $shop_sale->order_detail  = json_encode($old_order_detail);
      $shop_sale->save();
      $data = Product::where('id',request('pname'))->first();
      if ($data) {
        $data->quantity = $data->quantity - $request->qty;
        // dd($data->quantity);
        $data->save();
      }
      // $products = Product::where('id','$shop_sale->product_name')->get();
      return redirect(route('shop-sale')."?orderid=".$shop_sale->id)->with('success','Order has been placed successfully');
    }else if(request()->has('orderid')){
      $data = SSale::find(request('orderid'));
      $order_detail = json_decode($data->order_detail , true);
      return view('shop.sales',compact('products','data','order_detail'));
    }
    return view('shop.sales',compact('products','order_detail'));
  }


  function shop_sales_list(Request $request)
  {
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
    }elseif (request()->has('shoppaid') and is_numeric(request('shoppaid'))) {
      $order = SSale::find(request('shoppaid'));
      if ($order) {
        $order->status = 'paid';
        $order->save();
        $order_detail = json_decode($order->order_detail,true);
        session(['paid'=>$order_detail]);
        return back()->with('success','Order has been paid successfully');
      }else{
        return abort('404');
      } 
    }elseif (request()->has('shopcancel') and is_numeric(request('shopcancel'))) {
      $order = SSale::find(request('shopcancel'));
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
