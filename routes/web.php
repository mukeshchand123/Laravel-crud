<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;
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



 
Route::middleware(['LoggedIn'])->group(function () {

    Route::get('/', function () {
        return view('register');
    });
    Route::get('/register', function () {
        return view('register');
    });
    Route::get('/loginpage', function () {
        return view('loginpage');
    });

    Route::any('/login',[UserController::class,'login']);
    Route::any('/store',[UserController::class,'store']);
    
   
});
Route::middleware(['isLoggedIn'])->group(function () {
    
  
  //register
    Route::get('/logout',[UserController::class,'logout']);
    Route::get('/welcome',[UserController::class,'welcome']);
    Route::post('/password',[UserController::class,'changePassword']);
    
    Route::get('category/fetch',[CategoryController::class,'fetch']);
    Route::get('category/add', function () {
        return view("category.add");
    });
    Route::post('/add-category',[CategoryController::class,'add']);
    Route::get('category/update/{id}',[CategoryController::class,'edit'])->where('id', '[0-9]+');
    Route::post('update/{id}',[CategoryController::class,'update'])->where('id', '[0-9]+');
    Route::get('category/deleted',[CategoryController::class,'deleted'])->where('id', '[0-9]+');
    Route::get('category/restore/{id}',[CategoryController::class,'restore'])->where('id', '[0-9]+');
    Route::get('category/delete/{id}',[CategoryController::class,'destroy'])->where('id', '[0-9]+');
    

    Route::get('product/fetch',[ProductController::class,'fetch']);
    Route::get('product/deleted',[ProductController::class,'deleted']);
    Route::get('product/restore/{id}',[ProductController::class,'restore']);
  
  
    Route::get('product/image/fetch/{id}',[ImageController::class,'fetch']);
    Route::get('product/image/delete/{id}',[ImageController::class,'delete']);
    Route::get('product/image/deleted',[ImageController::class,'deleted']);
    Route::get('product/image/restore/{id}',[ImageController::class,'restore']);
  
    Route::get('product/add', [ProductController::class,'add']);
    Route::post('/add-product', [ProductController::class,'add_product']);
    Route::post('product/searchCategory', [ProductController::class,'searchCategory']);
    Route::post('product/search', [ProductController::class,'search']);
    Route::get('product/delete/{id}',[ProductController::class,'destroy'])->where('id', '[0-9]+');
    Route::get('product/update/{id}',[ProductController::class,'edit'])->where('id', '[0-9]+');
    Route::post('update/{id}',[ProductController::class,'update']);

    Route::get('/settings', function () {
        return view('settigs');
    });
    Route::get('/user/password', function () {
        return view("user.password");
    });
    Route::get('/user/userdetails',[UserController::class,'userDetails']);
    Route::get('/user/user_update/{data}',[UserController::class,'userEdit']);
    Route::post('user/update',[UserController::class,'userUpdate']);
    Route::get('user/delete',[UserController::class,'destroy']);
    
    
});