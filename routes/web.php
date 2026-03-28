<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\VendorController;

Route::get('/', function () {
    return view('welcome');
});

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
route::get('/all-user',[UserController::class,'index'])->name('userIndex');
route::get('/create-user',[UserController::class,'create'])->name('userCreate');
route::get('/edit-user/{edit_id}',[UserController::class,'edit'])->name('userEdit');
route::post('/store-user',[UserController::class,'store'])->name('userStore');
route::post('/update-user/{update_id}',[UserController::class,'update'])->name('userUpdate');
route::get('/delete-user/{delete_id}',[UserController::class,'destroy'])->name('userDelete');


//brand curd route 
route::get('all-vendor',[VendorController::class,'index'])->name('vendorIndex');
route::get('create-vendor',[VendorController::class,'create'])->name('vendorCreate');
route::get('edit-vendor/{edit_id}',[VendorController::class,'edit'])->name('vendorEdit');
route::post('store-vendor',[VendorController::class,'store'])->name('vendorStore');
route::post('update-vendor/{update_id}',[VendorController::class,'update'])->name('vendorUpdate');
route::get('delete-vendor/{delete_id}',[VendorController::class,'destroy'])->name('vendorDelete');


//image upload
use App\Http\Controllers\BrandController;

// Route::resource('brands', BrandController::class);
route::get('uploads',function ()
{
    return view('brands.index');
});
route::post('upload',[BrandController::class,'upload']);