<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ShopController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/invoice', function () {
    return view('invoice');
});

Route::get('/invoice2', function () {
    return view('invoice2');
});
Route::match(['get','post'],'/admin',[AdminController::class,'login'])->middleware('guest:admin')->name('admin');
Route::match(['get','post'],'/',[LoginController::class, 'login'])->middleware('guest:login')->name('login');
Route::group(['prefix'=>'/admin','middleware'=>['auth:admin']],function(){
    Route::match(['get','post'],'/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::match(['get','post'],'/super-dashboard',[SuperAdminController::class,'dashboard'])->name('super-dashboard');
    Route::match(['get','post'],'/add_user',[AdminController::class,'add_user'])->name('add-user');
    Route::match(['get','post'],'/user_list',[AdminController::class,'user_list'])->name('user-list');
    Route::match(['get','post'],'/add_table',[AdminController::class,'add_table'])->name('add-table');
    Route::match(['get','post'],'/tables',[AdminController::class,'tables'])->name('tables');
    Route::match(['get','post'],'/add_product',[AdminController::class,'add_product'])->name('add-product');
    Route::match(['get','post'],'/product_list',[AdminController::class,'product_list'])->name('product-list');
    Route::match(['get','post'],'/add_menu',[AdminController::class,'add_menu'])->name('add-menu');
    Route::match(['get','post'],'/dealers',[customerController::class,'dealers'])->name('dealers');
  Route::match(['get','post'],'/add-expense' , [ExpenseController::class , 'add_expense'])->name('add-expense');
  Route::match(['get','post'],'/net-sale' , [AdminController::class , 'net_sale'])->name('net-sale');
  Route::match(['get','post'],'/profit-loss' , [AdminController::class , 'profit_loss'])->name('profit-loss');
  Route::get('/adminlogout' , function(){
    Auth::guard('admin')->logout();
    return redirect(route('admin'));
  })->name('adminlogout');
});
Route::group(['prefix'=>'/','middleware'=>['auth:login']],function(){
    Route::match(['get','post'],'/sales',[LoginController::class,'sales'])->name('sales');
    Route::match(['get','post'],'/shop-sale',[LoginController::class,'shop'])->name('shop-sale');
    Route::match(['get','post'],'/sales-list',[LoginController::class,'sales_list'])->name('sales-list');
    Route::match(['get','post'],'/order-status',[LoginController::class,'order_status'])->name('order-status');
  Route::get('/userlogout' , function(){
    Auth::guard('login')->logout();
    return redirect(route('login'));
  })->name('userlogout');
});