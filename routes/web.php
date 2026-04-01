<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController; 
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User_addressController;
use App\Http\Controllers\RiderController;





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
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('/user/{delete_id}', [UserController::class, 'destroy'])->name('user.delete');

// //user curd route
// route::get('all-user',[UserController::class,'index'])->name('userIndex');
// route::get('create-user',[UserController::class,'create'])->name('userCreate');



//user_address curd route
route::get('all-address',[User_addressController::class,'index'])->name('addressIndex');
route::get('create-address',[User_addressController::class,'create'])->name('addressCreate');


//Rider route curd 
route::get('all-rider',[RiderController::class,'index'])->name('riderIndex');
route::get('create-rider',[RiderController::class,'create'])->name('riderCreate');
route::get('edit-rider/{edit_id}',[RiderController::class,'edit'])->name('riderEdit');
route::post('store-rider',[RiderController::class,'store'])->name('riderStore');
route::post('update-rider/{update_id}',[RiderController::class,'update'])->name('riderUpdate');
route::get('delete-rider/{delete_id}',[RiderController::class,'destroy'])->name('riderDelete');


//category curd route
route::get('/all-customer',[CustomerController::class,'index'])->name('customerIndex');
route::get('/create-customer',[CustomerController::class,'create'])->name('customerCreate');
route::get('/edit-customer/{edit_id}',[CustomerController::class,'edit'])->name('customerEdit');
route::post('/store-customer',[CustomerController::class,'store'])->name('customerStore');
route::post('/update-customer/{update_id}',[CustomerController::class,'update'])->name('customerUpdate');
route::get('/delete-customer/{delete_id}',[CustomerController::class,'destroy'])->name('customerDelete');


//Vendor curd route 
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

