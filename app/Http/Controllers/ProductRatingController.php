<?php

namespace App\Http\Controllers;
use App\Models\ProductRating;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;


class ProductRatingController extends Controller
{
    public function index()
    {
        $rating = ProductRating::with(['product','user','order'])->get();
        return view('productRating.index',compact('rating'));
    }


    public function create()
    {
        $users =  User::all();
        $products =  Product::all();
        $orders =  Order::all();


        return view('productRating.create',compact('users','products','orders'));
    }

    public function store(Request $request)
    {
        $validate =  Validator::make($request->all(),[
        'product_id' => 'required|exists:products,id',
        'user_id' => 'required|exists:users,id',
        'order_id' => 'required|exists:orders,id',
        'rating' => 'required|numeric|min:1|max:5',
        'title' => 'required|nullable|string',
        'review' => 'required|nullable|string',
        'is_approved' => 'required|boolean',

        ]);
        // dd($validate);   

        if($validate->fails())
               {
               return back()->withErrors($validate)->withInput();
               } 
            ProductRating::create([
                 'product_id'=>$request->product_id,
                  'user_id'=>$request->user_id,
                  'order_id'=>$request->order_id,
                  'rating'=>$request->rating ,
                  'title'=>$request->title,
                  'review'=>$request->review,
                  'is_approved'=>$request->is_approved,
            ]);

            return \redirect()->route('ratingIndex');
        
    }


      public function edit($edit_id)
      {
        $ratingRecord = ProductRating::where('id',$edit_id)->first();
        $users =  User::all();
        $products =  Product::all();
        $orders =  Order::all();
      return view('productRating.edit',compact('ratingRecord','users','products','orders'));
        }

       public function update(Request $request)
       {
         $ratingRecord = ProductRating::where('id',$request->update_id)->first();
         $ratingUpdate  = $ratingRecord->update([
             'product_id'=>$request->product_id,
                  'user_id'=>$request->user_id,
                  'order_id'=>$request->order_id,
                  'rating'=>$request->rating ,
                  'title'=>$request->title,
                  'review'=>$request->review,
                  'is_approved'=>$request->is_approved,
         ]);
         return redirect()->route('ratingIndex');
       }

        public function destroy($delete_id)
        {
            ProductRating::where('id',$delete_id)->first()->delete();
            return \redirect()->route('ratingIndex');
        }
    }
