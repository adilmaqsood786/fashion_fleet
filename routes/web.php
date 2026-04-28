<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductRatingController;
use App\Http\Controllers\OrderController;











Route::get('/', function () {
    return view('welcome');
});



//order curd route
Route::get('all-order',[OrderController::class,'index'])->name('orderIndex');
Route::get('create-order',[OrderController::class,'create'])->name('orderCreate');
Route::get('edit-order/{edit_id}',[OrderController::class,'edit'])->name('orderEdit');
Route::post('store-order',[OrderController::class,'store'])->name('orderStore');
Route::post('update-order/{update_id}',[OrderController::class,'update'])->name('orderUpdate');
Route::get('delete-order/{delete_id}',[OrderController::class,'destroy'])->name('orderDelete');


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
route::get('all-category',[CategoryProductController::class,'index'])->name('categoryIndex');
route::get('create-category',[CategoryProductController::class,'create'])->name('categoryCreate');
route::get('edit-category/{edit_id}',[CategoryProductController::class,'edit'])->name('categoryEdit');
route::post('store-category',[CategoryProductController::class,'store'])->name('categoryStore');
route::post('update-category/{update_id}',[CategoryProductController::class,'update'])->name('categoryUpdate');
route::get('delete-category/{delete_id}',[CategoryProductController::class,'destroy'])->name('categoryDelete');



//  Product route crud

   Route::get('all-product',[ProductController::class,'index'])->name('productIndex');
   Route::get('create-product',[ProductController::class,'create'])->name('productCreate');
   Route::get('edit-product/{edit_id}',[ProductController::class,'edit'])->name('productEdit');
   Route::post('store-product',[ProductController::class,'store'])->name('productStore');
   Route::post('update-product/{update_id}',[ProductController::class,'update'])->name('productUpdate');
   Route::get('delete-product/{delete_id}',[ProductController::class,'destroy'])->name('productDelete');


   //productImage crud route
   Route::get('all-image',[ProductImageController::class,'index'])->name('imageIndex');
   Route::get('create-image',[ProductImageController::class,'create'])->name('imageCreate');
   Route::get('edit-image/{edit_id}',[ProductImageController::class,'edit'])->name('imageEdit');
   Route::post('store-image',[ProductImageController::class,'store'])->name('imageStore');
   Route::post('update-image/{update_id}',[ProductImageController::class,'update'])->name('imageUpdate');
   Route::get('delete-image/{delete_id}',[ProductImageController::class,'destroy'])->name('imageDelete');

//Product Rating curd 
Route::get('all-rating',[ProductRatingController::class,'index'])->name('ratingIndex');
Route::get('create-rating',[ProductRatingController::class,'create'])->name('ratingCreate');
Route::get('edit-rating/{edit_id}',[ProductRatingController::class,'edit'])->name('ratingEdit');
Route::post('store-rating',[ProductRatingController::class,'store'])->name('ratingStore');
Route::post('update-rating/{update_id}',[ProductRatingController::class,'update'])->name('ratingUpdate');
Route::get('delete-rating/{delete_id}',[ProductRatingController::class,'destroy'])->name('ratingDelete');
