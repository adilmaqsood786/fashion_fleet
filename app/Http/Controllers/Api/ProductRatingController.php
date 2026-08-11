<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductRatingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | POST /api/products/{productId}/reviews
    | Create Product Review
    |--------------------------------------------------------------------------
    */
    public function storeProductReview(Request $request, $productId)
    {
        // Check product
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create review
        $review = ProductRating::create([
            'product_id' => $productId,
            'user_id' => $request->user_id,
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'review' => $request->review,

            // New review needs admin approval
            'is_approved' => 0,
        ]);

        // Load relationships
        $review->load([
            'product',
            'user',
            'order'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Review added successfully',
            'data' => $review
        ], 201);
    }


    /*
    |--------------------------------------------------------------------------
    | GET /api/products/{productId}/reviews
    | Get Approved Product Reviews
    |--------------------------------------------------------------------------
    */
    public function productReviews($productId)
    {
        // Check product
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }

        // Get approved reviews
        $reviews = ProductRating::with([
            'user'
        ])
            ->where('product_id', $productId)
            ->where('is_approved', 1)
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Product reviews fetched successfully',
            'product_id' => (int) $productId,
            'total_reviews' => $reviews->count(),
            'data' => $reviews
        ], 200);
    }


    /*
    |--------------------------------------------------------------------------
    | GET /api/products/{productId}/rating-summary
    | Rating Summary
    |--------------------------------------------------------------------------
    */
    public function ratingSummary($productId)
    {
        // Check product
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }

        // Approved reviews only
        $reviews = ProductRating::where('product_id', $productId)
            ->where('is_approved', 1);

        $totalReviews = $reviews->count();

        $averageRating = $reviews->avg('rating');

        // Rating distribution
        $rating5 = ProductRating::where('product_id', $productId)
            ->where('is_approved', 1)
            ->where('rating', 5)
            ->count();

        $rating4 = ProductRating::where('product_id', $productId)
            ->where('is_approved', 1)
            ->where('rating', 4)
            ->count();

        $rating3 = ProductRating::where('product_id', $productId)
            ->where('is_approved', 1)
            ->where('rating', 3)
            ->count();

        $rating2 = ProductRating::where('product_id', $productId)
            ->where('is_approved', 1)
            ->where('rating', 2)
            ->count();

        $rating1 = ProductRating::where('product_id', $productId)
            ->where('is_approved', 1)
            ->where('rating', 1)
            ->count();

        return response()->json([
            'status' => true,
            'message' => 'Rating summary fetched successfully',

            'data' => [
                'product_id' => (int) $productId,

                'total_reviews' => $totalReviews,

                'average_rating' => $averageRating
                    ? round($averageRating, 1)
                    : 0,

                'rating_distribution' => [
                    '5' => $rating5,
                    '4' => $rating4,
                    '3' => $rating3,
                    '2' => $rating2,
                    '1' => $rating1,
                ]
            ]
        ], 200);
    }


    /*
    |--------------------------------------------------------------------------
    | GET /api/my-reviews
    | Get User Reviews
    |--------------------------------------------------------------------------
    */
    public function myReviews(Request $request)
    {
        // For now user_id is coming from request
        $userId = $request->user_id;

        if (!$userId) {
            return response()->json([
                'status' => false,
                'message' => 'user_id is required'
            ], 422);
        }

        // Check user reviews
        $reviews = ProductRating::with([
            'product',
            'order'
        ])
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'My reviews fetched successfully',
            'total_reviews' => $reviews->count(),
            'data' => $reviews
        ], 200);
    }


    /*
    |--------------------------------------------------------------------------
    | PUT /api/reviews/{reviewId}
    | Update Review
    |--------------------------------------------------------------------------
    */
    public function updateReview(Request $request, $reviewId)
    {
        $review = ProductRating::find($reviewId);

        if (!$review) {
            return response()->json([
                'status' => false,
                'message' => 'Review not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $review->update([
            'rating' => $request->rating,
            'review' => $request->review,

            // Updated review requires approval again
            'is_approved' => 0,
        ]);

        $review->load([
            'product',
            'user',
            'order'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Review updated successfully',
            'data' => $review
        ], 200);
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE /api/reviews/{reviewId}
    | Delete Review
    |--------------------------------------------------------------------------
    */
    public function deleteReview($reviewId)
    {
        $review = ProductRating::find($reviewId);

        if (!$review) {
            return response()->json([
                'status' => false,
                'message' => 'Review not found'
            ], 404);
        }

        $review->delete();

        return response()->json([
            'status' => true,
            'message' => 'Review deleted successfully'
        ], 200);
    }
}
// namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
// use App\Models\Product;
// use App\Models\ProductRating;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

// class ProductRatingController extends Controller
// {
//     // =========================================================
//     // GET ALL RATINGS
//     // GET /api/ratings
//     // =========================================================
//     public function index()
//     {
//         $rating = ProductRating::with([
//             'product',
//             'user',
//             'order'
//         ])->get();

//         return response()->json([
//             'status' => true,
//             'message' => 'Ratings fetched successfully',
//             'data' => $rating
//         ], 200);
//     }


//     // =========================================================
//     // CREATE RATING
//     // POST /api/ratings
//     // =========================================================
//     public function store(Request $request)
//     {
//         $validator = Validator::make($request->all(), [

//             'product_id' => 'required|exists:products,id',

//             'user_id' => 'required|exists:users,id',

//             'order_id' => 'required|exists:orders,id',

//             'rating' => 'required|numeric|min:1|max:5',

//             'review' => 'required|string',

//             'is_approved' => 'nullable|boolean',

//         ]);


//         if ($validator->fails()) {

//             return response()->json([
//                 'status' => false,
//                 'message' => 'Validation failed',
//                 'errors' => $validator->errors()
//             ], 422);
//         }


//         $rating = ProductRating::create([

//             'product_id' => $request->product_id,

//             'user_id' => $request->user_id,

//             'order_id' => $request->order_id,

//             'rating' => $request->rating,

//             'review' => $request->review,

//             'is_approved' => $request->is_approved ?? 0,

//         ]);


//         $rating->load([
//             'product',
//             'user',
//             'order'
//         ]);


//         return response()->json([
//             'status' => true,
//             'message' => 'Rating created successfully',
//             'data' => $rating
//         ], 201);
//     }


//     // =========================================================
//     // GET SINGLE RATING
//     // GET /api/ratings/{id}
//     // =========================================================
//     public function edit($edit_id)
//     {
//         $ratingRecord = ProductRating::with([
//             'product',
//             'user',
//             'order'
//         ])->find($edit_id);


//         if (!$ratingRecord) {

//             return response()->json([
//                 'status' => false,
//                 'message' => 'Rating not found'
//             ], 404);
//         }


//         return response()->json([
//             'status' => true,
//             'message' => 'Rating fetched successfully',
//             'data' => $ratingRecord
//         ], 200);
//     }


//     // =========================================================
//     // UPDATE RATING
//     // PUT /api/ratings/{id}
//     // =========================================================
//     public function update(Request $request)
//     {
//         $ratingRecord = ProductRating::find($request->update_id);


//         if (!$ratingRecord) {

//             return response()->json([
//                 'status' => false,
//                 'message' => 'Rating not found'
//             ], 404);
//         }


//         $validator = Validator::make($request->all(), [

//             'product_id' => 'required|exists:products,id',

//             'user_id' => 'required|exists:users,id',

//             'order_id' => 'required|exists:orders,id',

//             'rating' => 'required|numeric|min:1|max:5',

//             'review' => 'required|string',

//             'is_approved' => 'nullable|boolean',

//         ]);


//         if ($validator->fails()) {

//             return response()->json([
//                 'status' => false,
//                 'message' => 'Validation failed',
//                 'errors' => $validator->errors()
//             ], 422);
//         }


//         $ratingRecord->update([

//             'product_id' => $request->product_id,

//             'user_id' => $request->user_id,

//             'order_id' => $request->order_id,

//             'rating' => $request->rating,

//             'review' => $request->review,

//             'is_approved' => $request->is_approved ?? 0,

//         ]);


//         $ratingRecord->load([
//             'product',
//             'user',
//             'order'
//         ]);


//         return response()->json([
//             'status' => true,
//             'message' => 'Rating updated successfully',
//             'data' => $ratingRecord
//         ], 200);
//     }


//     // =========================================================
//     // DELETE RATING
//     // DELETE /api/ratings/{id}
//     // =========================================================
//     public function destroy($delete_id)
//     {
//         $rating = ProductRating::find($delete_id);


//         if (!$rating) {

//             return response()->json([
//                 'status' => false,
//                 'message' => 'Rating not found'
//             ], 404);
//         }


//         $rating->delete();


//         return response()->json([
//             'status' => true,
//             'message' => 'Rating deleted successfully'
//         ], 200);
//     }


//     // =========================================================
//     // POST PRODUCT REVIEW
//     // POST /api/products/{productId}/reviews
//     // =========================================================
//     public function storeProductReview(Request $request, $productId)
//     {
//         // Check product
//         $product = Product::find($productId);


//         if (!$product) {

//             return response()->json([
//                 'status' => false,
//                 'message' => 'Product not found'
//             ], 404);
//         }


//         // Validation
//         $validator = Validator::make($request->all(), [

//             'user_id' => 'required|exists:users,id',

//             'order_id' => 'required|exists:orders,id',

//             'rating' => 'required|numeric|min:1|max:5',

//             'review' => 'required|string',

//         ]);


//         if ($validator->fails()) {

//             return response()->json([
//                 'status' => false,
//                 'message' => 'Validation failed',
//                 'errors' => $validator->errors()
//             ], 422);
//         }


//         // Create review
//         $review = ProductRating::create([

//             'product_id' => $productId,

//             'user_id' => $request->user_id,

//             'order_id' => $request->order_id,

//             'rating' => $request->rating,

//             'review' => $request->review,

//             // New review pending approval
//             'is_approved' => 0,

//         ]);


//         $review->load([
//             'product',
//             'user',
//             'order'
//         ]);


//         return response()->json([
//             'status' => true,
//             'message' => 'Review added successfully',
//             'data' => $review
//         ], 201);
//     }


//     // =========================================================
//     // GET PRODUCT REVIEWS
//     // GET /api/products/{productId}/reviews
//     // =========================================================
//     public function productReviews($productId)
//     {
//         // Check product
//         $product = Product::find($productId);


//         if (!$product) {

//             return response()->json([
//                 'status' => false,
//                 'message' => 'Product not found'
//             ], 404);
//         }


//         // Get only approved reviews
//         $reviews = ProductRating::with([
//             'user'
//         ])
//         ->where('product_id', $productId)
//         ->where('is_approved', 1)
//         ->latest()
//         ->get();


//         return response()->json([
//             'status' => true,
//             'message' => 'Product reviews fetched successfully',
//             'product_id' => (int) $productId,
//             'total_reviews' => $reviews->count(),
//             'data' => $reviews
//         ], 200);
//     }
// }

// namespace App\Http\Controllers\Api;
// use App\Models\ProductRating;
// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

// class ProductRatingController extends Controller
// {
//     //index method
//      public function index()
//     {
//         $rating = ProductRating::with(['product','user','order'])->get();
//         return response()->json([
//             "message"=>"success",
//             "data"=>$rating 
//         ]);
//     }


//     //store method
    
//     public function store(Request $request)
//     {
        
//          $rating   =    ProductRating::create([
//                  'product_id'=>$request->product_id,
//                   'user_id'=>$request->user_id,
//                   'order_id'=>$request->order_id,
//                   'rating'=>$request->rating ,
//                   'review'=>$request->review,
//                   'is_approved'=>$request->is_approved,
//             ]);
// return response()->json([
//      "message"=>"success",
//      "data"=>$rating 
// ]);
        
//     }


// //edit method 
//  public function edit($edit_id)
//       {
//         $ratingRecord = ProductRating::where('id',$edit_id)->first();
//         // $users =  User::all();
//         // $products =  Product::all();
//         // $orders =  Order::all();

// return response()->json([
//      "message"=>"success",
//      "data"=>$ratingRecord
// ]);
//         }


//         //update method
//          public function update(Request $request)
//        {
//          $ratingRecord = ProductRating::where('id',$request->update_id)->first();
//          $ratingUpdate  = $ratingRecord->update([
//              'product_id'=>$request->product_id,
//                   'user_id'=>$request->user_id,
//                   'order_id'=>$request->order_id,
//                   'rating'=>$request->rating ,
//                   'review'=>$request->review,
//                   'is_approved'=>$request->is_approved,
//          ]);
 
//           return response()->json([
//      "message"=>"success",
//      "data"=>$ratingUpdate
// ]);
//          }

//          //Delete method
//           public function destroy($delete_id)
//         {
//             $delete = ProductRating::where('id',$delete_id)->first()->delete();
//            return response()->json([
//                     "message"=>"success",
//                     "data"=>$delete
//               ]);

//             }



// public function store(Request $request, $productId)
//     {
//         // Check product
//         $product = Product::find($productId);

//         if (!$product) {
//             return response()->json([
//                 'status' => false,
//                 'message' => 'Product not found'
//             ], 404);
//         }

//         // Validation
//         $validator = Validator::make($request->all(), [
//             'user_id' => 'required|exists:users,id',
//             'order_id' => 'required|exists:orders,id',
//             'rating' => 'required|numeric|min:1|max:5',
//             'review' => 'required|string',
//         ]);

//         if ($validator->fails()) {
//             return response()->json([
//                 'status' => false,
//                 'message' => 'Validation failed',
//                 'errors' => $validator->errors()
//             ], 422);
//         }

//         // Create review
//         $review = ProductRating::create([
//             'product_id' => $productId,
//             'user_id' => $request->user_id,
//             'order_id' => $request->order_id,
//             'rating' => $request->rating,
//             'review' => $request->review,

//             // New reviews are not approved by default
//             'is_approved' => 0,
//         ]);

//         // Load relationships
//         $review->load([
//             'product',
//             'user',
//             'order'
//         ]);

//         return response()->json([
//             'status' => true,
//             'message' => 'Review added successfully',
//             'data' => $review
//         ], 201);
//     }


//     /**
//      * GET /api/products/{productId}/reviews
//      */
//     public function index($productId)
//     {
//         // Check product
//         $product = Product::find($productId);

//         if (!$product) {
//             return response()->json([
//                 'status' => false,
//                 'message' => 'Product not found'
//             ], 404);
//         }

//         // Get only approved reviews
//         $reviews = ProductRating::with([
//             'user'
//         ])
//         ->where('product_id', $productId)
//         ->where('is_approved', 1)
//         ->latest()
//         ->get();

//         return response()->json([
//             'status' => true,
//             'message' => 'Product reviews fetched successfully',
//             'product_id' => (int) $productId,
//             'total_reviews' => $reviews->count(),
//             'data' => $reviews
//         ], 200);
//     }


// }
