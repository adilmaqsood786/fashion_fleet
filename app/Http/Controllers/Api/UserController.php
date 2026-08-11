<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // GET /api/users
    public function index()
    {
        $users = User::with(['profile', 'vendor', 'rider'])->get();

        return response()->json([
            'status' => true,
            'message' => 'Users fetched successfully',
            'data' => $users
        ], 200);
    }


    // GET /api/users/{id}
    public function show($id)
    {
        $user = User::with(['profile', 'vendor', 'rider'])
            ->find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'User fetched successfully',
            'data' => $user
        ], 200);
    }


    // POST /api/users
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [

        //     'name' => 'required|string|max:255',

        //     'email' => 'required|email|unique:users,email',

        //     'password' => 'required|min:6',

        //     'userPhone' => 'required',

        //     'role' => 'required|in:customer,vendor,rider',

        //     'status' => 'required',

        // ]);

        // if ($validator->fails()) {

        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Validation failed',
        //         'errors' => $validator->errors()
        //     ], 422);
        // }


        // Create User
        $user = User::create([

            'name' => $request->name,

            'email' => $request->email,

            'userPhone' => $request->userPhone,

            'password' => Hash::make($request->password),

            'role' => $request->role,

            'status' => $request->status ? 1 : 0,

            'email_verified_at' =>
                $request->email_verified == 1
                    ? now()
                    : null,
        ]);


        // CUSTOMER
        if ($request->role == 'customer') {

            $user->profile()->create([

                'full_name' => $request->full_name,

                'address_line_1' => $request->address_line_1,

                'address_line_2' => $request->address_line_2,

                'city' => $request->city,

                'state' => $request->state,

                'postal_code' => $request->postal_code,

                'country' => $request->country,

                'latitude' => $request->latitude ?? 0,

                'longitude' => $request->longitude ?? 0,

                'is_default' => $request->is_default ?? 0,

            ]);
        }


        // VENDOR
        elseif ($request->role == 'vendor') {

            $logoPath = null;

            if ($request->hasFile('logo')) {

                $logoPath =
                    $request->file('logo')
                        ->store('vendor', 'public');
            }

            $user->vendor()->create([

                'store_name' => $request->store_name,

                'store_slug' => $request->store_slug,

                'logo' => $logoPath,

                'license' => $request->license,

                'register' => $request->register,

                'address' => $request->address,

                'vendor_city' => $request->vendor_city,

                'vendor_country' => $request->vendor_country,

                'commission_rate' => $request->commission_rate,

                'is_active' =>
                    $request->is_active ? 1 : 0,

            ]);
        }


        // RIDER
        elseif ($request->role == 'rider') {

            $user->rider()->create([

                'vehicle_type' => $request->vehicle_type,

                'vehicle_number' => $request->vehicle_number,

                'license_number' => $request->license_number,

                'is_available' =>
                    $request->is_available ?? 0,

                'is_verified' =>
                    $request->is_verified ?? 0,

            ]);
        }


        $user->load([
            'profile',
            'vendor',
            'rider'
        ]);


        return response()->json([

            'status' => true,

            'message' => 'User created successfully',

            'data' => $user

        ], 201);
    }


    // PUT /api/users/{id}
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {

            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }


        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',

            'email' =>
                'required|email|unique:users,email,' . $id,

            'userPhone' => 'required',

            'role' =>
                'required|in:customer,vendor,rider',

        ]);


        if ($validator->fails()) {

            return response()->json([

                'status' => false,

                'message' => 'Validation failed',

                'errors' => $validator->errors()

            ], 422);
        }


        $data = [

            'name' => $request->name,

            'email' => $request->email,

            'userPhone' => $request->userPhone,

            'role' => $request->role,

            'status' =>
                $request->status ? 1 : 0,

            'email_verified_at' =>
                $request->email_verified == 1
                    ? now()
                    : null,
        ];


        // Password only update if provided
        if ($request->filled('password')) {

            $data['password'] =
                Hash::make($request->password);
        }


        $user->update($data);


        // CUSTOMER
        if ($user->role == 'customer') {

            if ($user->profile) {

                $user->profile->update([

                    'full_name' =>
                        $request->full_name,

                    'address_line_1' =>
                        $request->address_line_1,

                    'address_line_2' =>
                        $request->address_line_2,

                    'city' =>
                        $request->city,

                    'state' =>
                        $request->state,

                    'postal_code' =>
                        $request->postal_code,

                    'country' =>
                        $request->country,

                    'latitude' =>
                        $request->latitude ?? 0,

                    'longitude' =>
                        $request->longitude ?? 0,

                    'is_default' =>
                        $request->is_default ?? 0,
                ]);
            }
        }


        // VENDOR
        elseif ($user->role == 'vendor') {

            if ($user->vendor) {

                $logo = $user->vendor->logo;

                if ($request->hasFile('logo')) {

                    $logo =
                        $request->file('logo')
                            ->store('vendor', 'public');
                }


                $user->vendor->update([

                    'store_name' =>
                        $request->store_name,

                    'store_slug' =>
                        $request->store_slug,

                    'logo' => $logo,

                    'register' =>
                        $request->register,

                    'license' =>
                        $request->license,

                    'address' =>
                        $request->address,

                    'vendor_city' =>
                        $request->vendor_city,

                    'vendor_country' =>
                        $request->vendor_country,

                    'commission_rate' =>
                        $request->commission_rate,

                    'is_active' =>
                        $request->is_active ? 1 : 0,
                ]);
            }
        }


        // RIDER
        elseif ($user->role == 'rider') {

            if ($user->rider) {

                $user->rider->update([

                    'vehicle_type' =>
                        $request->vehicle_type,

                    'vehicle_number' =>
                        $request->vehicle_number,

                    'license_number' =>
                        $request->license_number,

                    'is_available' =>
                        $request->is_available ?? 0,

                    'is_verified' =>
                        $request->is_verified ?? 0,
                ]);
            }
        }


        $user->load([
            'profile',
            'vendor',
            'rider'
        ]);


        return response()->json([

            'status' => true,

            'message' => 'User updated successfully',

            'data' => $user

        ], 200);
    }


    // DELETE /api/users/{id}
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {

            return response()->json([

                'status' => false,

                'message' => 'User not found'

            ], 404);
        }


        $user->delete();


        return response()->json([

            'status' => true,

            'message' => 'User deleted successfully'

        ], 200);
    }


    // POST /api/login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',

            'password' => 'required',

        ]);


        if ($validator->fails()) {

            return response()->json([

                'status' => false,

                'message' => 'Validation failed',

                'errors' => $validator->errors()

            ], 422);
        }


        if (!Auth::attempt([

            'email' => $request->email,

            'password' => $request->password

        ])) {

            return response()->json([

                'status' => false,

                'message' => 'Invalid email or password'

            ], 401);
        }


        $user = Auth::user();


        return response()->json([

            'status' => true,

            'message' => 'Login successful',

            'data' => $user

        ], 200);
    }
}










// namespace App\Http\Controllers\api;
// use App\Models\User;
// use App\Models\Vendor;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;

// class UserController extends Controller
// {

// //    index method
// public function index()
//     {
//         $users = User::with(['profile','vendor','rider'])->get();
//          return \response()->json([
//             "message"=>"success",
//             "data"=>$users
//          ]);
//         }


// // store method

// //     public function store(Request $request)

// // {

// //         // Create User
// //         $user = User::create([
// //             'name' => $request->name,
// //             'email' => $request->email,
// //             'userPhone' => $request->userPhone,
// //             'password' => Hash::make($request->password),
// //             'role' => $request->role,
// //             'status' => $request->status == 'active' ? 1 : 0,

// //        'email_verified_at' =>
// //         $request->email_verified == 1 ? now() : null,
// //         ]);

// //         // Role-based insert

// //        if($request->role == 'customer'){


// //        //        $validate = Validator::$user->profile()->make($request->all(),[




// //     $user->profile()->create([
// //         'full_name' => $request->full_name,
// //         'profilePhone' => $request->profilePhone,
// //         'address_line_1' => $request->address_line_1,
// //         'address_line_2' => $request->address_line_2,
// //         'city' => $request->city,
// //         'state' => $request->state,
// //         'postal_code' => $request->postal_code,
// //         'country' => $request->country,
// //         'latitude' => $request->latitude ?? 0,
// //         'longitude' => $request->longitude ?? 0,
// //         'is_default' => $request->is_default ?? 0,
// //     ]);
// // }

// //         elseif($request->role == 'vendor'){
// //             $logo = null;

// //             if($request->hasFile('logo')){
// //                 $logo = $request->file('logo')->store('image/','public');
// //             }

// //             $user->vendor()->create([
// //                 'store_name' => $request->store_name,
// //                 'store_slug' => $request->store_slug,
// //                 'logo' => $logo,
// //                 'description' => $request->description,
// //                 'address' => $request->address,
// //                 'city' => $request->city,
// //                 'country' => $request->country,
// //                 'commission_rate' =>$request->commission_rate,
// //                 'is_approved' => 1,
// //                 'is_active' => 1,
// //             ]);
// //         }

// //         elseif($request->role == 'rider'){
// //             $user->rider()->create([
// //                 'vehicle_type' => $request->vehicle_type,
// //                 'vehicle_number' => $request->vehicle_number,
// //                 'license_number' => $request->license_number,
// //                 'is_available' => $request->is_available ?? 0,
// //                 'is_verified' => $request->is_verified ??  0,
// //             ]);
// //         }

// //  return \response()->json([
// //             "message"=>"success",
// //             "data"=>$user
// //          ]);
// //         }

// //     public function store(Request $request)

// // {

// // $logo = null;

// //             if($request->hasFile('logo')){
// //                 $logo = $request->file('logo')->store('image/','public');
// //             }

// //      $user = User::findOrFail($request->user_id);

// // $vendor = $user->vendor()->create([
// //     'store_name' => $request->store_name,
// //     'store_slug' => $request->store_slug,
// //     'logo' => $logo,
// //      'license'=>$request->license,
// //      'register'=>$request->register,
// //     'description' => $request->description,
// //     'address' => $request->address,
// //     'vendor_city' => $request->vendor_city,
// //     'vendor_country' => $request->vendor_country,
// //     'commission_rate' => $request->commission_rate,
// //     'is_approved' => 1,
// //     'is_active' => 1,
// // ]);
// //     return \response()->json([
// //             "message"=>"success",
// //             "data"=>$vendor
// //          ]);


// //             $riders = $user->rider()->create([
// //                 'vehicle_type' => $request->vehicle_type,
// //                 'vehicle_number' => $request->vehicle_number,
// //                 'license_number' => $request->license_number,
// //                 'is_available' => $request->is_available ?? 0,
// //                 'is_verified' => $request->is_verified ?? 0,
// //             ]);
// //                 return \response()->json([
// //             "message"=>"success",
// //             "data"=>$riders
// //          ]);
// // }
// public function store(Request $request)
// {
//     // Common validation
//     $request->validate([
//         'user_id' => 'required|exists:users,id',
//         'type' => 'required|in:customer,vendor,rider', // frontend se ye field bhejni hogi
//     ]);

//     $user = User::findOrFail($request->user_id);

//     // ----------- VENDOR CREATE -----------
//     if ($request->type === 'vendor') {

//         $logo = null;
//         if ($request->hasFile('logo')) {
//             $logo = $request->file('logo')->store('image', 'public');
//         }

//         $vendor = $user->vendor()->create([
//             'store_name'      => $request->store_name,
//             'store_slug'      => $request->store_slug,
//             'logo'            => $logo,
//             'license'         => $request->license,
//             'register'        => $request->register,
//             'description'     => $request->description,
//             'address'         => $request->address,
//             'vendor_city'     => $request->vendor_city,
//             'vendor_country'  => $request->vendor_country,
//             'commission_rate' => $request->commission_rate,
//             'is_approved'     => 1,
//             'is_active'       => 1,
//         ]);

//         return response()->json([
//             "message" => "Vendor created successfully",
//             "data"    => $vendor
//         ], 201);
//     }

//     // ----------- RIDER CREATE -----------
//     if ($request->type === 'rider') {

//         $riders = $user->rider()->create([
//             'vehicle_type'    => $request->vehicle_type,
//             'vehicle_number'  => $request->vehicle_number,
//             'license_number'  => $request->license_number,
//             'is_available'    => $request->is_available ?? 0,
//             'is_verified'     => $request->is_verified ?? 0,
//         ]);

//         return response()->json([
//             "message" => "Rider created successfully",
//             "data"    => $riders
//         ], 201);
//     }

//     return response()->json([
//         "message" => "Invalid type"
//     ], 422);
// }

//    //edit method
//     public function edit($id)
//     {
//         $user = User::with(['profile','vendor','rider'])->findOrFail($id);
//           return \response()->json([
//             "message"=>"success",
//             "data"=>$user
//          ]);
//         }


//         // update method
//          public function update(Request $request)
//     {
//         $user = User::where('id',$request->id)->first();

//      $userUpdate =   $user->update([
//             'name' => $request->name,
//             'email' => $request->email,
//             'userPhone' => $request->userPhone,
//             'password' => Hash::make($request->password),
//             'role' => $request->role,
//             'status' => $request->status == 'active' ? 1 : 0,
//         ]);

//            if($user->role == 'customer' && $user->profile){
//         $user->profile->update([
//         'full_name' => $request->full_name,
//         'profilePhone' => $request->profilePhone,
//         'address_line_1' => $request->address_line_1,
//         'address_line_2' => $request->address_line_2,
//         'city' => $request->city,
//         'state' => $request->state,
//         'postal_code' => $request->postal_code,
//         'country' => $request->country,
//         'latitude' => $request->latitude ?? 0,
//         'longitude' => $request->longitude ?? 0,
//         'is_default' => $request->is_default ?? 0,
//             ]);

//             }


//         // VENDOR UPDATE
//     if($user->role == 'vendor' && $user->vendor){

//         $logo = $user->vendor->logo;

//         if($request->hasFile('logo')){
//             $logo = $request->file('logo')->store('vendor','public');
//         }

//         $user->vendor->update([
//             'store_name' => $request->store_name,
//             'store_slug' => $request->store_slug,
//             'logo' => $logo,
//             'description' => $request->description,
//             'address' => $request->address,
//             'vendor_city' => $request->vendor_city,
//             'vendor_country' => $request->vendor_country,
//             'commission_rate' => $request->commission_rate,
//             'is_approved' => $request->is_approved,
//             'is_active' => $request->is_active ?? 0,
//         ]);
//     }


//  return \response()->json([
//             "message"=>"success",
//             "data"=>$userUpdate
//          ]);    }


// // delete method
// public function destroy($delete_id)
//     {
//        $user = User::where('id',$delete_id)->first()->delete();
//        return \response()->json([
//             "message"=>"success",
//             "data"=>$user
//          ]);

//        }


// // Auth security
//     public function login(Request $request){
//         //  $login  = $request->all();
//         $user = User::where('email',$request->email)->first();
//         if(!$user || !Hash::check($request->password,$user->password))
//             {
//                    return \response()->json([
//                  'data'=> "User Not Found",
//                   "Success" => 'fales'
//                 ]);

//             }

//      $user['token'] = $user->createToken('MyApp')->plainTextToken;
// //        $user['name'] =$user->name;


//         return response()->json([
//              'success'=>'ture',
//             'data'=>$user
//             ]);
//          }

//     public function signup(Request $request)
//     {
//         $input = $request->all();
//         $input["password"] = bcrypt($input["password"]);
//         $user = User::create($input);
//         $success['token'] = $user->createToken('MyApp')->plainTextToken;
//         $user['name'] =$user->name;
//        // $msg = "signup function";

//         return response()->json([
//              'success'=>'ture',
//             'data'=>$success
//         ]);
//     }
// }
