<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;



Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/create', [ProductController::class, 'create']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{id}', [ProductController::class, 'edit']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);





















// route::get('product',[ProductController::class,'index']);
// route::post('store-product',[ProductController::class,'store']);
// Route::get('edit-product/{edit_id}',[ProductController::class,'edit']);
// Route::post('update-product',[ProductController::class,'update']);




Route::get('all-customers', [ CustomerController::class,'index']);
Route::post('create-customer',[CustomerController::class,'store']);
Route::get('edit-customer/{edit_id}',[CustomerController::class,'edit']);
Route::post('update-customer',[CustomerController::class,'update']);
Route::get('delete-customer/{delete_id}',[CustomerController::class,'destroy']);

Route::post('signup',[UserController::class,'signup']);
Route::post('login',[UserController::class,'login']);
