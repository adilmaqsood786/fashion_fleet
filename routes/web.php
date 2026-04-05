<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\CategoryController;






Route::get('/', function () {
    return view('welcome');
});


//user curd route 
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('/user/{delete_id}', [UserController::class, 'destroy'])->name('user.delete');




//user_address curd route
route::get('all-profile',[UserProfileController::class,'index'])->name('profileIndex');
route::get('create-profile',[UserProfileController::class,'create'])->name('profileCreate');
route::get('edit-profile/{edit_id}',[UserProfileController::class,'edit'])->name('profileEdit');
route::post('store-profile',[UserProfileController::class,'store'])->name('profileStore');
route::post('update-profile/{update_id}',[UserProfileController::class,'update'])->name('profileUpdate');
route::get('delete-profile/{delete_id}',[UserProfileController::class,'destroy'])->name('profileDelete');


//Rider route curd 
route::get('all-rider',[RiderController::class,'index'])->name('riderIndex');
route::get('create-rider',[RiderController::class,'create'])->name('riderCreate');
route::get('edit-rider/{edit_id}',[RiderController::class,'edit'])->name('riderEdit');
route::post('store-rider',[RiderController::class,'store'])->name('riderStore');
route::post('update-rider/{update_id}',[RiderController::class,'update'])->name('riderUpdate');
route::get('delete-rider/{delete_id}',[RiderController::class,'destroy'])->name('riderDelete');




//Vendor curd route 
route::get('all-vendor',[VendorController::class,'index'])->name('vendorIndex');
route::get('create-vendor',[VendorController::class,'create'])->name('vendorCreate');
route::get('edit-vendor/{edit_id}',[VendorController::class,'edit'])->name('vendorEdit');
route::post('store-vendor',[VendorController::class,'store'])->name('vendorStore');
route::post('update-vendor/{update_id}',[VendorController::class,'update'])->name('vendorUpdate');
route::get('delete-vendor/{delete_id}',[VendorController::class,'destroy'])->name('vendorDelete');

//category curd route 
route::get('all-category',[CategoryController::class,'index'])->name('categoryIndex');
route::get('all-create',[CategoryController::class,'create'])->name('categoryCreate');
route::get('all-edit/{edit_id}',[CategoryController::class,'edit'])->name('categoryEdit');
route::post('all-store',[CategoryController::class,'store'])->name('categoryStore');
route::post('all-update/{update_id}',[CategoryController::class,'update'])->name('categoryUpdate');
route::get('all-delete/{delete_id}',[CategoryController::class,'destroy'])->name('categoryDelete');
