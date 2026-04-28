<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ProductController;


route::get('product',[ProductController::class,'index']);



Route::get('all-customers', [ CustomerController::class,'index']);
Route::post('create-customer',[CustomerController::class,'store']);
Route::get('edit-customer/{edit_id}',[CustomerController::class,'edit']);
Route::post('update-customer',[CustomerController::class,'update']);
Route::get('delete-customer/{delete_id}',[CustomerController::class,'destroy']);

Route::post('signup',[UserController::class,'signup']);
Route::post('login',[UserController::class,'login']);
