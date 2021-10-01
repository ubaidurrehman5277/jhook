<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\table;
use App\Models\Product;
use App\Models\Menu;
use App\Models\Sale;
use DB;
use Response;

class AdminController extends Controller
{
    //
    function login(Request $request){
    if (request()->isMethod('post')) {
      $username = request('email');
      $password = request('password');
      if (Auth::guard('admin')->attempt(['email' => $username, 'password' => $password])) {
        if (auth('admin')->user()->type == 'superadmin') {
            return redirect(route('super-dashboard'));
        }else{
            return redirect(route('dashboard'));
        }
      }else{
        return back()->with('error','Invalid Attempts');
      }
    }
    return view('admin.login');
  }

  function dashboard(Request $req){
    if (auth('admin')->user()->type == 'superadmin') {
        return redirect(route('super-dashboard'));
    }
    $tuser    = User::count();
    $ttable   = table::count();
    $tmenu    = Menu::whereNull('main_menu')->count();
    $tsmenu    = Menu::whereNotNull('main_menu')->count();
    $tproduct = Product::where('quantity','>','0')->count();
    $tpending    = Sale::where('status','pending')->count();
    // $tsale    = Sale::where('date','date("d M Y")')->count();
    $tsale = Sale::where(['date'=>date("Y-m-d"),'status'=>'paid'])->sum('total_price');
    return view('admin.dashboard',compact('tuser','ttable','tmenu','tsmenu','tproduct','tpending','tsale'));
  }

  function add_user(Request $req){
    $users   = User::orderby('id','desc')->get();
    $data   = User::where('id', request('id'))->first();
    if (request()->isMethod('post')) {
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
        $add_user->type       = $req->type; 
        $add_user->password             = bcrypt($req->password);
        $add_user->save();
        return back()->with($message);
    }
    return view('admin.add-user',compact('data'));
  }

  function user_list(Request $req){
    // $users   = User::orderby('id')->get();
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
                'price'             => 'required',
                'assuming_price'    => 'required',
            ]);
            if (request()->has('id')) {
            $add_product = Product::find(request('id'));
            $message = ['success' => 'Product has been updated successfully'];
            }else{
              $add_product = new Product;
              $message = ['success' => 'Product Added successfully']; 
            }
            $add_product->product_name       = $req->product_name; 
            $add_product->quantity           = $req->quantity;
            $add_product->price              = $req->price;
            $add_product->assuming_price     = $req->assuming_price;          
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
        $add_menu->asuming_price = $req->assuming_price;
        $add_menu->main_menu  = $req->main_menu;
        $add_menu->save();
        return back()->with($message);
    }elseif(request()->has('id') and is_numeric(request('id'))){
        $data = Menu::find(request('id'));
        return view('admin.add-menu', compact('menus','items','data'));
    }
    return view('admin.add-menu',  compact('menus','items'));
  }

  function net_sale()
  {
    if (request()->has('pdf') and request('pdf') == 'true') {
        $query = "Select * from sales where status = 'paid' ";
        if (request()->has('date_from')) {
            // $date_from = implode('-',array_reverse(explode('/',request('date_from'))));
            $query .= " AND date >= '".request('date_from')."'";
        }
        if (request()->has('date_to')) {
            // $date_to = implode('-',array_reverse(explode('/',request('date_to'))));
            $query .= " AND date <= '".request('date_to')."'";
        }
        $record = DB::select($query);
        $file = 'Net Sale Report .pdf';
        pdf_generate($this->view_netsale_pdf($record),$file,true,false,'legal');
        $fileurl = public_path()."/images/".$file;
        return Response::download($fileurl, $file, array('Content-Type: application/octet-stream','Content-Length: '. filesize($fileurl)))->deleteFileAfterSend(true);
    }else{
      return abort(404);
    }
  }
  function view_netsale_pdf($record)
  {
    $menus = Menu::all();
    return view('reports.netsale_report' , compact('record','menus'));
  }

  function profit_loss()
  {
    if (request()->has('pdf') and request('pdf') == 'true') {
        $query = "Select * from sales where status = 'paid' ";
        if (request()->has('date_from')) {
            // $date_from = implode('-',array_reverse(explode('/',request('date_from'))));
            $query .= " AND date >= '".request('date_from')."'";
        }
        if (request()->has('date_to')) {
            // $date_to = implode('-',array_reverse(explode('/',request('date_to'))));
            $query .= " AND date <= '".request('date_to')."'";
        }
        // dd($query);
        $record = DB::select($query);
        $file = 'Profit Loss Report .pdf';
        pdf_generate($this->view_profitloss_pdf($record),$file,true,false,'legal');
        $fileurl = public_path()."/images/".$file;
        return Response::download($fileurl, $file, array('Content-Type: application/octet-stream','Content-Length: '. filesize($fileurl)))->deleteFileAfterSend(true);
    }else{
      return abort(404);
    }
  }
  function view_profitloss_pdf($record)
  {
    $menus = Menu::all();
    return view('reports.profit_loss' , compact('record','menus'));
  }

}
