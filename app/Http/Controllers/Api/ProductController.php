<?php

namespace App\Http\Controllers\Api;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // public function index()
    // {
    //     $products = Product::select(['name'])->get();
    //     return \response()->json([
    //         'message'=>'product list',
    //         'data'=>$products
    //     ]);
    // }
//     public function index()
// {
//     $products = Product::pluck('name');

//     return response()->json([
//         'message' => 'product list',
//         'data' => $products
//     ]);
// }       
public function index()
{
    $products = Product::select('main-image','name','sku','price')->get();

    return response()->json([
        'message' => 'product list',
        'data' => $products
    ]);
}
}
