<?php

use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductRatingController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\RiderOrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/storage/{path}', function ($path) {
    $file = storage_path('app/public/'.$path);

    abort_unless(file_exists($file), 404);

    return Response::file($file, [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET',
        'Access-Control-Allow-Headers' => '*',
    ]);
})->where('path', '.*');

// Route::get('/storage/{path}', function ($path) {
//     $fullPath = storage_path('app/public/' . $path);

//     if (!file_exists($fullPath)) {
//         abort(404);
//     }

//     return response()->file($fullPath, [
//         'Access-Control-Allow-Origin' => '*',
//     ]);
// })->where('path', '.*'

Route::get('login', [UserController::class, 'loginUser'])->name('loginUser');
Route::post('login-user', [UserController::class, 'loginCheck'])->name('loginCheck');

Route::middleware(['auth'])->group(function () {

    // order curd route
    Route::get('all-order', [OrderController::class, 'index'])->middleware('role:admin')->name('orderIndex');
    Route::get('create-order', [OrderController::class, 'create'])->middleware('role:admin')->name('orderCreate');
    Route::get('edit-order/{edit_id}', [OrderController::class, 'edit'])->middleware('role:admin')->name('orderEdit');
    Route::post('store-order', [OrderController::class, 'store'])->middleware('role:admin')->name('orderStore');
    Route::post('update-order/{update_id}', [OrderController::class, 'update'])->middleware('role:admin')->name('orderUpdate');
    Route::post('orders/{order}/assign-rider', [OrderController::class, 'assignRider'])->middleware('role:admin')->name('orderAssignRider');
    Route::get('delete-order/{delete_id}', [OrderController::class, 'destroy'])->middleware('role:admin')->name('orderDelete');

    // user curd route
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/{delete_id}', [UserController::class, 'destroy'])->name('user.delete');

    // user_address curd route
    Route::get('all-profile', [UserProfileController::class, 'index'])->name('profileIndex');
    Route::get('create-profile', [UserProfileController::class, 'create'])->name('profileCreate');
    Route::get('edit-profile/{edit_id}', [UserProfileController::class, 'edit'])->name('profileEdit');
    Route::post('store-profile', [UserProfileController::class, 'store'])->name('profileStore');
    Route::post('update-profile/{update_id}', [UserProfileController::class, 'update'])->name('profileUpdate');
    Route::get('delete-profile/{delete_id}', [UserProfileController::class, 'destroy'])->name('profileDelete');

    // Rider route curd
    Route::get('all-rider', [RiderController::class, 'index'])->middleware('role:admin')->name('riderIndex');
    Route::get('create-rider', [RiderController::class, 'create'])->middleware('role:admin')->name('riderCreate');
    Route::get('edit-rider/{edit_id}', [RiderController::class, 'edit'])->middleware('role:admin')->name('riderEdit');
    Route::post('store-rider', [RiderController::class, 'store'])->middleware('role:admin')->name('riderStore');
    Route::post('update-rider/{update_id}', [RiderController::class, 'update'])->middleware('role:admin')->name('riderUpdate');
    Route::get('delete-rider/{delete_id}', [RiderController::class, 'destroy'])->middleware('role:admin')->name('riderDelete');

    // Vendor curd route
    Route::get('all-vendor', [VendorController::class, 'index'])->name('vendorIndex');
    Route::get('create-vendor', [VendorController::class, 'create'])->name('vendorCreate');
    Route::get('edit-vendor/{edit_id}', [VendorController::class, 'edit'])->name('vendorEdit');
    Route::post('store-vendor', [VendorController::class, 'store'])->name('vendorStore');
    Route::post('update-vendor/{update_id}', [VendorController::class, 'update'])->name('vendorUpdate');
    Route::get('delete-vendor/{delete_id}', [VendorController::class, 'destroy'])->name('vendorDelete');

    // category curd route
    Route::get('all-category', [CategoryProductController::class, 'index'])->name('categoryIndex');
    Route::get('create-category', [CategoryProductController::class, 'create'])->name('categoryCreate');
    Route::get('edit-category/{edit_id}', [CategoryProductController::class, 'edit'])->name('categoryEdit');
    Route::post('store-category', [CategoryProductController::class, 'store'])->name('categoryStore');
    Route::post('update-category/{update_id}', [CategoryProductController::class, 'update'])->name('categoryUpdate');
    Route::get('delete-category/{delete_id}', [CategoryProductController::class, 'destroy'])->name('categoryDelete');

    //  Product route crud

    Route::get('all-product', [ProductController::class, 'index'])->name('productIndex');
    Route::get('create-product', [ProductController::class, 'create'])->name('productCreate');
    Route::get('edit-product/{edit_id}', [ProductController::class, 'edit'])->name('productEdit');
    Route::post('store-product', [ProductController::class, 'store'])->name('productStore');
    Route::post('update-product/{update_id}', [ProductController::class, 'update'])->name('productUpdate');
    Route::get('delete-product/{delete_id}', [ProductController::class, 'destroy'])->name('productDelete');

    // productImage crud route
    Route::get('all-image', [ProductImageController::class, 'index'])->name('imageIndex');
    Route::get('create-image', [ProductImageController::class, 'create'])->name('imageCreate');
    Route::get('edit-image/{edit_id}', [ProductImageController::class, 'edit'])->name('imageEdit');
    Route::post('store-image', [ProductImageController::class, 'store'])->name('imageStore');
    Route::post('update-image/{update_id}', [ProductImageController::class, 'update'])->name('imageUpdate');
    Route::get('delete-image/{delete_id}', [ProductImageController::class, 'destroy'])->name('imageDelete');

    // Product Rating curd
    Route::get('all-rating', [ProductRatingController::class, 'index'])->name('ratingIndex');
    Route::get('create-rating', [ProductRatingController::class, 'create'])->name('ratingCreate');
    Route::get('edit-rating/{edit_id}', [ProductRatingController::class, 'edit'])->name('ratingEdit');
    Route::post('store-rating', [ProductRatingController::class, 'store'])->name('ratingStore');
    Route::post('update-rating/{update_id}', [ProductRatingController::class, 'update'])->name('ratingUpdate');
    Route::get('delete-rating/{delete_id}', [ProductRatingController::class, 'destroy'])->name('ratingDelete');
});

Route::middleware(['auth', 'role:rider'])->group(function () {
    Route::get('my-orders', [RiderOrderController::class, 'index'])->name('riderOrders.index');
    Route::post('my-orders/{order}/delivery-status', [RiderOrderController::class, 'updateDeliveryStatus'])->name('riderOrders.updateDeliveryStatus');
});


Route::get('/rating-approval/{id}/{status}', 
    [ProductRatingController::class, 'ratingApproval']
)->name('ratingApproval');

