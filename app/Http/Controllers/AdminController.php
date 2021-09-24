<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
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
    // $users   = User::orderby('id')->get();
    $data   = User::where('id', request('id'))->first();
        if (request()->isMethod('post')) {
            // dd($req->all());
            request()->validate([
                'email'       => 'required',
                'password'          => 'required',
                
            ]);
            
            if (request()->has('id')) {
            $add_user = User::find(request('id'));
            $message = ['success' => 'User has been updated successfully'];
            }else{
              $add_user = new User;
              $message = ['success' => 'User Added successfully'];
            }   
            $add_user->email       = $req->email; 
            $add_user->password             = md5($req->password);          
            $add_user->save();
            return back()->with($message);
          }
      return view('admin.add-user',compact('data'));
  }

  function user_list(Request $req){
     if (request()->has('id')) {
            if (is_numeric(request('id'))) {
                $users = User::
                    where('id', request('id'))
                    ->delete();
                return back()->with('success', 'User has been deleted successfully');
            } else {
                return back();
            }

        }else{
          $users   = User::orderby('id','desc')->get();
        }
    return view('admin.users', compact('users'));
  }

  function add_table(Request $req){
     // $tables   = table::orderby('id')->get();
    $data   = table::where('id', request('id'))->first();
        if (request()->isMethod('post')) {
            // dd($req->all());
            request()->validate([
                'table_no'       => 'required',
                'capacity'          => 'required',
                
            ]);
            
            if (request()->has('id')) {
            $add_table = table::find(request('id'));
            $message = ['success' => 'Table has been updated successfully'];
            }else{
              $add_table = new table;
              $message = ['success' => 'Table Added successfully'];
            }   
            $add_table->table_no       = $req->table_no; 
            $add_table->capacity        = $req->capacity;          
            $add_table->save();
            return back()->with($message);
          }
      return view('admin.add-table',compact('data'));
  }  

  function tables(Request $req){
    if (request()->has('id')) {
            if (is_numeric(request('id'))) {
                $tables = table::
                    where('id', request('id'))
                    ->delete();
                return back()->with('success', 'Table has been deleted successfully');
            } else {
                return back();
            }

        }else{
          $tables   = table::orderby('id','desc')->get();
        }
    return view('admin.tables', compact('tables'));
  }

   function add_product(Request $req){
     // $products   = Product::orderby('id')->get();
    $data   = Product::where('id', request('id'))->first();
        if (request()->isMethod('post')) {
            // dd($req->all());
            request()->validate([
                'product_name'       => 'required',
                'quantity'          => 'required',
                
            ]);
            if (request()->has('id')) {
            $add_product = Product::find(request('id'));
            $message = ['success' => 'Product has been updated successfully'];
            }else{
              $add_product = new Product;
              $message = ['success' => 'Product Added successfully']; 
            }
            $add_product->product_name       = $req->product_name; 
            $add_product->quantity             = $req->quantity;        
            $add_product->save();
            return back()->with($message);
        }
    return view('admin.add-product', compact('data'));
  }

  function product_list(Request $req){
     if (request()->has('id')) {
            if (is_numeric(request('id'))) {
                $products = Product::
                    where('id', request('id'))
                    ->delete();
                return back()->with('success', 'Product has been deleted successfully');
            } else {
                return back();
            }

        }else{
          $products   = Product::orderby('id')->get();
        }
    return view('admin.product-list', compact('products'));
  }

  function add_menu(Request $req){
    $menus   = Menu::whereNull('main_menu')->orderby('id','desc')->get();
    $items   = Menu::orderby('id','desc')->get();
    if (request()->isMethod('post')) {
        request()->validate([
            'menu_name'          => 'required',
        ]);
        if (request()->has('id')) {
            $add_menu = Menu::find(request('id'));
            $message = ['success' => 'Menu has been updated successfully'];
        }else{
            $add_menu = new Menu;
            $add_menu->created_at = date('Y-m-d H:i:s');
            $message = ['success' => 'Menu has been added successfully'];
        }
        $add_menu->name       = $req->menu_name;
        $add_menu->price      = $req->price;
        $add_menu->main_menu  = $req->main_menu;
        $add_menu->save();
        return back()->with($message);
    }elseif(request()->has('id') and is_numeric(request('id'))){
        $data = Menu::find(request('id'));
        return view('admin.add-menu', compact('menus','items','data'));
    }
    return view('admin.add-menu',  compact('menus','items'));
  }

}
