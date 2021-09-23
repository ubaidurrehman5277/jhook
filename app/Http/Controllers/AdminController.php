<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\LoginUser;
use App\Models\table;
use App\Models\Product;
use App\Models\Menu;

class AdminController extends Controller
{
    //
    function login(Request $request){
    if (request()->isMethod('post')) {
      $username = request('email');
      $password = request('password');
      if (Auth::guard('admin')->attempt(['email' => $username, 'password' => $password])) {
        return redirect(route('dashboard'));
      }else{
        return back()->with('error','Invalid Attempts');
      }
    }
    return view('admin.login');
  }

  function dashboard(Request $req){
    return view('admin.dashboard');
  }

  function add_user(Request $req){
     $users   = LoginUser::orderby('id')->get();
        if (request()->isMethod('post')) {
            // dd($req->all());
            request()->validate([
                'email'       => 'required',
                'password'          => 'required',
                
            ]);
            $add_user = new LoginUser;
            $add_user->email       = $req->email; 
            $add_user->password             = md5($req->password);
            $message = ['success' => 'User Added successfully'];         
            $add_user->save();
            return back()->with($message);
        }
    return view('admin.add-user',compact('users'));
  }

  function user_list(Request $req){
     $users   = LoginUser::orderby('id')->get();
    return view('admin.users', compact('users'));
  }

  function add_table(Request $req){
     $tables   = table::orderby('id')->get();
        if (request()->isMethod('post')) {
            // dd($req->all());
            request()->validate([
                'table_no'       => 'required',
                'capacity'          => 'required',
                
            ]);
            $add_table = new table;
            $add_table->table_no       = $req->table_no; 
            $add_table->capacity             = $req->capacity;
            $message = ['success' => 'Table Added successfully'];         
            $add_table->save();
            return back()->with($message);
        }
    return view('admin.add-table', compact('tables'));
  }  

  function tables(Request $req){
     $tables   = table::orderby('id')->get();
    return view('admin.tables', compact('tables'));
  }

   function add_product(Request $req){
     $products   = Product::orderby('id')->get();
        if (request()->isMethod('post')) {
            // dd($req->all());
            request()->validate([
                'product_name'       => 'required',
                'quantity'          => 'required',
                
            ]);
            $add_product = new Product;
            $add_product->product_name       = $req->product_name; 
            $add_product->quantity             = $req->quantity;
            $message = ['success' => 'Product Added successfully'];         
            $add_product->save();
            return back()->with($message);
        }
    return view('admin.add-product', compact('products'));
  }

  function product_list(Request $req){
     $products   = Product::orderby('id')->get();
    return view('admin.product-list', compact('products'));
  }

  function add_menu(Request $req){
     $menus   = Menu::whereNull('main_menu')->orderby('id')->get();
     $items   = Menu::orderby('id')->get();
        if (request()->isMethod('post')) {
            // dd($req->all());
            request()->validate([
                'menu_name'          => 'required',
            ]);
            $add_menu = new Menu;
            $add_menu->name       = $req->menu_name; 
            $add_menu->price      = $req->price;
            $add_menu->main_menu  = $req->main_menu;
            $message = ['success' => 'Menu Added successfully'];         
            $add_menu->save();
            return back()->with($message);
        }
    return view('admin.add-menu',  compact('menus','items'));
  }

}
