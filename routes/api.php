<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductImageController;
use App\Http\Controllers\Api\ProductRatingController;

//user


Route::get('user',[UserController::class,"index"]);
Route::post('store-user',[UserController::class,"store"]);
Route::get('edit-user/{edit_id}',[UserController::class,"edit"]);
Route::post('upuser/{update_id}',[UserController::class,"update"]);
Route::get('delete-user/{delete_id}',[UserController::class,"destroy"]);




Route::post('signup',[UserController::class,'signup']);
Route::post('login',[UserController::class,'login']);

//Product Rating
Route::get('Rating',[ProductRatingController::class,"index"]);
Route::post('store-Rating',[ProductRatingController::class,"store"]);
Route::get('edit-Rating/{edit_id}',[ProductRatingController::class,"edit"]);
Route::post('update-Rating/{update_id}',[ProductRatingController::class,"update"]);
Route::get('delete-Rating/{delete_id}',[ProductRatingController::class,"destroy"]);




//Product image
Route::get('image',[ProductImageController::class,"index"]);
Route::post('store-image',[ProductImageController::class,"store"]);
Route::get('edit-image/{edit_id}',[ProductImageController::class,"edit"]);
Route::post('update-image/{update_id}',[ProductImageController::class,"update"]);
Route::get('delete-image/{delete_id}',[ProductImageController::class,"destroy"]);



//CategoryProductContoller
Route::get('category',[CategoryProductController::class,"index"]);
Route::post('store-category',[CategoryProductController::class,"store"]);
Route::get('edit-category/{edit_id}',[CategoryProductController::class,"edit"]);
Route::post('update-category/{update_id}',[CategoryProductController::class,"update"]);
Route::get('delete-category/{delete_id}',[CategoryProductController::class,"destroy"]);


//Order
Route::get('order',[OrderController::class,"index"]);
Route::post('store-order',[OrderController::class,"store"]);
Route::get('edit-order/{edit_id}',[OrderController::class,"edit"]);
Route::post('update-order/{update_id}',[OrderController::class,"update"]);
Route::get('delete-order/{delete_id}',[OrderController::class,"destroy"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('customer/orders', [OrderController::class, 'customerOrders']);
    Route::post('customer/store-order', [OrderController::class, 'store']);
});





//product
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products-store', [ProductController::class, 'store']);
Route::get('/products-edit/{id}', [ProductController::class, 'edit']);
Route::post('/products-update/{id}', [ProductController::class, 'update']);
Route::get('/products-delete/{id}', [ProductController::class, 'destroy']);
Route::get('/products-single/{id}', [ProductController::class, 'productSingle']);
Route::get('products-vendor/{id}', [ProductController::class,'ProductVendor']);

Route::get('/vendor/{userId}/store', [ProductController::class, 'getStoreByUserId']);


// route::get('product',[ProductController::class,'index']);
// route::post('store-product',[ProductController::class,'store']);
// Route::get('edit-product/{edit_id}',[ProductController::class,'edit']);
// Route::post('update-product',[ProductController::class,'update']);




// Route::get('all-customers', [ CustomerController::class,'index']);
// Route::post('create-customer',[CustomerController::class,'store']);
// Route::get('edit-customer/{edit_id}',[CustomerController::class,'edit']);
// Route::post('update-customer',[CustomerController::class,'update']);
// Route::get('delete-customer/{delete_id}',[CustomerController::class,'destroy']);


