<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CustomerController;

Route::get('all-customers', [ CustomerController::class,'index']);
Route::post('create-customer',[CustomerController::class,'store']);
Route::get('edit-customer/{edit_id}',[CustomerController::class,'edit']);
Route::post('update-customer',[CustomerController::class,'update']);
Route::get('delete-customer/{delete_id}',[CustomerController::class,'destroy']);