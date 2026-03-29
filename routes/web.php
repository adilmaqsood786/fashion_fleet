<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController; 
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('welcome');
});

//image upload
use App\Http\Controllers\BrandController;

// Route::resource('brands', BrandController::class);
route::get('uploads',function ()
{
    return view('brands.index');
});
route::post('upload',[BrandController::class,'upload']);

// route::get('home',function ()
// {
//     return view('admin_penal.home');
// });

// route::get('index',function (){
//     return view('users.index');   
// });

// route::get('create',function (){
//     return view('users.create');   
// });
// route::get('edit',function (){
//     return view('users.edit');   
// });


//user curd route
route::get('all-user',[UserController::class,'index'])->name('userIndex');


//category curd route
route::get('/all-customer',[CustomerController::class,'index'])->name('customerIndex');
route::get('/create-customer',[CustomerController::class,'create'])->name('customerCreate');
route::get('/edit-customer/{edit_id}',[CustomerController::class,'edit'])->name('customerEdit');
route::post('/store-customer',[CustomerController::class,'store'])->name('customerStore');
route::post('/update-customer/{update_id}',[CustomerController::class,'update'])->name('customerUpdate');
route::get('/delete-customer/{delete_id}',[CustomerController::class,'destroy'])->name('customerDelete');


//brand curd route 
route::get('all-vendor',[VendorController::class,'index'])->name('vendorIndex');
route::get('create-vendor',[VendorController::class,'create'])->name('vendorCreate');
route::get('edit-vendor/{edit_id}',[VendorController::class,'edit'])->name('vendorEdit');
route::post('store-vendor',[VendorController::class,'store'])->name('vendorStore');
route::post('update-vendor/{update_id}',[VendorController::class,'update'])->name('vendorUpdate');
route::get('delete-vendor/{delete_id}',[VendorController::class,'destroy'])->name('vendorDelete');


//Gategories route 
route::get('all-category',[CategoryController::class,'index'])->name('categoryIndex');
route::get('create-category',[CategoryController::class,'create'])->name('categoryCreate');
route::get('edit-category/{edit_id}',[CategoryController::class,'edit'])->name('categoryEdit');
route::post('store-category',[CategoryController::class,'store'])->name('categoryStore');
route::post('update-category/{update_id}',[CategoryController::class,'update'])->name('categoryUpdate');
route::get('delete-category/{delete_id}',[CategoryController::class,'destroy'])->name('categoryDelete');

//