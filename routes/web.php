<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
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

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    Session::forget('user');
    return redirect('/login');
});
 
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/', [ProductController::class, 'index']);
Route::get('/details/{id}',[ProductController::class, 'details']);
Route::post('/searchProduct',[ProductController::class, 'searchProduct']);
Route::post('/addToCart',[ProductController::class, 'addToCart']);
Route::get('/cartlist',[ProductController::class, 'cartlist']);
Route::get('/removecart/{id}',[ProductController::class, 'removeCart']);
Route::get('/ordernow',[ProductController::class, 'orderNow']);
Route::post('/orderbook',[ProductController::class, 'orderBook']);
Route::get('/myorders',[ProductController::class, 'myOrders']);
route::view('/register','register');

route::post('/payment-complete',[ProductController::class, 'paymentComplete']);
