<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // GET ALL PRODUCTS
    public function index()
    {
        $products = Product::with(['vendor'])->get();

        return response()->json([
            'status' => true,
            'message' => 'Product list fetched successfully',
            'data' => $products
        ]);
    }



    // STORE PRODUCT
    public function store(Request $request)
    {


        // IMAGE UPLOAD
        $main = null;
        if ($request->hasFile('main_image')) {
            $main = $request->file('main_image')->store('/product', 'public');
        }
//    return response()->json(["data"=>$request->all()]);
        $product = Product::create([
            'vendor_id' => $request->vendor_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'sku' => $request->sku,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'main_image' => $main,
            'is_active' => 1,
            'is_featured' => 0,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ]);
    }

    // EDIT / SHOW SINGLE PRODUCT
    public function edit($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $product
        ]);
    }

    // UPDATE PRODUCT
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $main = $product->main_image;

        if ($request->hasFile('main_image')) {
            $main = $request->file('main_image')->store('/product', 'public');
        }

        $product->update([
            // 'vendor_id' => $request->vendor_id,
            // 'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'sku' => $request->sku,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'main_image' => $main,
            'is_active' => $request->is_active,
            'is_featured' => $request->is_featured,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Product updated successfully',
            'data' => $product
        ]);
    }

    // DELETE PRODUCT
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully'
        ]);
    }

   //Single image Api

    public function productSingle($id)
    {
        $single = Product::where('id',$id)->get();

        return response()->json([
            "message"=> "Success Single Product",
             "data"=> $single
        ]);
    }



//Product vendor

    public function productVendor($id)
    {
        $products = Product::with("vendor")
        ->where("vendor_id",$id)
        ->get();

        return  response()->json([
             "status"=>true,
             "message"=>"Vendor Products",
             "data"=>$products
        ]);
        }

    public function getStoreByUserId($userId)
    {
        $vendor = Vendor::where('user_id', $userId)->first();

        if (!$vendor) {
            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'No vendor store found for this user.',
            ], 200);
        }

        $storeData = [
            "vendor_id" =>$vendor->id,
            'store_name'      => $vendor->store_name,
            'store_slug'      => $vendor->store_slug,
            'logo'            => $vendor->logo,
            'license'         => $vendor->license,
            'register'        => $vendor->register,
            'description'     => $vendor->description,
            'address'         => $vendor->address,
            'vendor_city'     => $vendor->vendor_city,
            'vendor_country'  => $vendor->vendor_country,
            'commission_rate' => $vendor->commission_rate,
            'is_approved'     => $vendor->is_approved,
            'is_active'       => $vendor->is_active,
        ];

        return response()->json([
            'success' => true,
            'data' => $storeData,
            'message' => 'Vendor store details retrieved successfully.',
        ], 200);
    }



}











































































// namespace App\Http\Controllers\Api;
// use App\Models\Product;
// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

// class ProductController extends Controller
// {
//     // public function index()
//     // {
//     //     $products = Product::select(['name'])->get();
//     //     return \response()->json([
//     //         'message'=>'product list',
//     //         'data'=>$products
//     //     ]);
//     // }
// //     public function index()
// // {
// //     $products = Product::pluck('name');

// //     return response()->json([
// //         'message' => 'product list',
// //         'data' => $products
// //     ]);
// // }


// // index method
// public function index()
// {
//     $products = Product::select('main_image','name','sku','price')->get();

//     return response()->json([
//         'message' => 'product list',
//         'data' => $products
//     ]);
// }


// // store method
// //  public function store(Request $request)
// //   {
// //     // dd($request->all());
// //     $validate = Validator::make($request->all(),[
// //         'vendor_id'=>'required',
// //         'category_id'=>'required',
// //         'name'=>'required',
// //         'slug'=>'required|nullable',
// //         'short_description'=>'required',
// //         'description'=>'required',
// //         'sku'=>'required',
// //         'price'=>'required',
// //         'sale_price'=>'required',
// //         'stock'=>'required',
// //         'main_image'=>'required|image|mimes:png,jpg,jpeg|max:2048',
// //         'is_active'=>'required',
// //         'is_featured'=>'required',

// //     ]);
// //     // dd($validate);
// //     if($validate->fails())
// //         {
// //                return back()->withErrors($validate)->withInput();
// //         }

// // //image
// //      $main = null;
// //      if($request->hasfile('main_image'))
// //         {
// //              $path = $request->file('main_image')->store('/product','public');
// //              $main = $path;
// //         }


// //   $product =  Product::create([

// //         'vendor_id'=>$request->vendor_id,
// //         'category_id'=>$request->category_id,
// //         'name'=>$request->name,
// //         'slug'=>$request->slug,
// //         'short_description'=>$request->short_description,
// //         'description'=>$request->description,
// //         'sku'=>$request->sku,
// //         'price'=>$request->price,
// //         'sale_price'=>$request->sale_price,
// //         'stock'=>$request->stock,
// //         'main_image'=>$main,
// //         'is_active'=>$request->is_active,
// //         'is_featured'=>$request->is_featured,
// //  ]);


// //      return  response()->json([
// //         'message'=>'Product Successfully Store',
// //         'data'=>$product
// //      ]);
// //   }
// public function store(Request $request)
// {
//     $validate = Validator::make($request->all(), [
//         'vendor_id' => 'required|exists:vendors,id',
//         'category_id' => 'required|exists:categories,id',
//         'name' => 'required',
//         'slug' => 'nullable',
//         'short_description' => 'required',
//         'description' => 'required',
//         'sku' => 'required',
//         'price' => 'required|numeric',
//         'sale_price' => 'required|numeric',
//         'stock' => 'required|integer',
//         'main_image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
//         'is_active' => 'required|boolean',
//         'is_featured' => 'required|boolean',
//     ]);

//     if ($validate->fails()) {
//         return response()->json([
//             'errors' => $validate->errors()
//         ]);
//     }

//     $main = null;
//     if ($request->hasFile('main_image')) {
//         $main = $request->file('main_image')->store('products', 'public');
//     }

//     $product = Product::create([
//         'vendor_id' => $request->vendor_id,
//         'category_id' => $request->category_id,
//         'name' => $request->name,
//         'slug' => $request->slug,
//         'short_description' => $request->short_description,
//         'description' => $request->description,
//         'sku' => $request->sku,
//         'price' => $request->price,
//         'sale_price' => $request->sale_price,
//         'stock' => $request->stock,
//         'main_image' => $main,
//         'is_active' => $request->is_active,
//         'is_featured' => $request->is_featured,
//     ]);

//     return response()->json([
//         'message' => 'Product Successfully Stored',
//         'data' => $product
//     ]);
// }

// //Edit product

// public function edit($edit_id)
//   {
//      $productRecord = Product::where('id',$edit_id)->first();
//        return response()->json([
//         'data' => $productRecord
//     ]);
//   }

//   public function update(Request $request)
//   {

//       $productRecord = Product::where('id',$request->update_id)->first();

//       //image
//      $main = $productRecord->image;
//      if($request->hasfile('main_image'))
//         {
//              $path = $request->file('main_image')->store('/product','public');
//              $main = $path;
//         }

//       $porductUpdate = $productRecord->update([

//          'vendor_id'=>$request->vendor_id,
//         'category_id'=>$request->category_id,
//         'name'=>$request->name,
//         'slug'=>$request->slug,
//         'short_description'=>$request->short_description,
//         'description'=>$request->description,
//         'sku'=>$request->sku,
//         'price'=>$request->price,
//         'sale_price'=>$request->sale_price,
//         'stock'=>$request->stock,
//         'main_image'=>$main,
//         'is_active'=>$request->is_active,
//         'is_featured'=>$request->is_featured,

//       ]);

//       return response()->json([
//         'message' => 'Product Successfully Update',
//         'data' => $porductUpdate
//     ]);
//   }




// }
