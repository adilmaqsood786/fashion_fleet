<?php

namespace App\Http\Controllers\api;
use App\Models\User;
use App\Models\Vendor;
use App\Models\UserProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

//    index method
public function index()
    {
        $users = User::with(['profile','vendor','rider'])->get();
         return \response()->json([
            "message"=>"success",
            "data"=>$users
         ]);
        }


// store method

//     public function store(Request $request)

// {

//         // Create User
//         $user = User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'userPhone' => $request->userPhone,
//             'password' => Hash::make($request->password),
//             'role' => $request->role,
//             'status' => $request->status == 'active' ? 1 : 0,

//        'email_verified_at' =>
//         $request->email_verified == 1 ? now() : null,
//         ]);

//         // Role-based insert

//        if($request->role == 'customer'){


//        //        $validate = Validator::$user->profile()->make($request->all(),[




//     $user->profile()->create([
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
//     ]);
// }

//         elseif($request->role == 'vendor'){
//             $logo = null;

//             if($request->hasFile('logo')){
//                 $logo = $request->file('logo')->store('image/','public');
//             }

//             $user->vendor()->create([
//                 'store_name' => $request->store_name,
//                 'store_slug' => $request->store_slug,
//                 'logo' => $logo,
//                 'description' => $request->description,
//                 'address' => $request->address,
//                 'city' => $request->city,
//                 'country' => $request->country,
//                 'commission_rate' =>$request->commission_rate,
//                 'is_approved' => 1,
//                 'is_active' => 1,
//             ]);
//         }

//         elseif($request->role == 'rider'){
//             $user->rider()->create([
//                 'vehicle_type' => $request->vehicle_type,
//                 'vehicle_number' => $request->vehicle_number,
//                 'license_number' => $request->license_number,
//                 'is_available' => $request->is_available ?? 0,
//                 'is_verified' => $request->is_verified ??  0,
//             ]);
//         }

//  return \response()->json([
//             "message"=>"success",
//             "data"=>$user
//          ]);
//         }

    public function store(Request $request)
{
//     return response()->json(["data",$request->all()]);
$logo = null;

            if($request->hasFile('logo')){
                $logo = $request->file('logo')->store('image/','public');
            }

//     $user = User::findOrFail($request->user_id);

        $user = User::where("email",$request->email)->first();

$vendor = $user->vendor()->create([
    'store_name' => $request->store_name,
    'store_slug' => $request->store_slug,
    'logo' => $logo,
     'license'=>$request->license,
     'register'=>$request->register,
    'description' => $request->description,
    'address' => $request->address,
    'vendor_city' => $request->vendor_city,
    'vendor_country' => $request->vendor_country,
    'commission_rate' => 10,
    'is_approved' => 1,
    'is_active' => 1,
]);
    return \response()->json([
            "message"=>"success",
            "data"=>$vendor
         ]);
}


   //edit method
    public function edit($id)
    {
        $user = User::with(['profile','vendor','rider'])->findOrFail($id);
          return \response()->json([
            "message"=>"success",
            "data"=>$user
         ]);
    }

        // update method
         public function update(Request $request)
    {
        $user = User::where('id',$request->id)->first();

     $userUpdate =   $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'userPhone' => $request->userPhone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status == 'active' ? 1 : 0,
        ]);

           if($user->role == 'customer' && $user->profile){
        $user->profile->update([
        'full_name' => $request->full_name,
        'profilePhone' => $request->profilePhone,
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


        // VENDOR UPDATE
    if($user->role == 'vendor' && $user->vendor){

        $logo = $user->vendor->logo;

        if($request->hasFile('logo')){
            $logo = $request->file('logo')->store('vendor','public');
        }

        $user->vendor->update([
            'store_name' => $request->store_name,
            'store_slug' => $request->store_slug,
            'logo' => $logo,
            'description' => $request->description,
            'address' => $request->address,
            'vendor_city' => $request->vendor_city,
            'vendor_country' => $request->vendor_country,
            'commission_rate' => $request->commission_rate,
            'is_approved' => $request->is_approved,
            'is_active' => $request->is_active ?? 0,
        ]);
    }


 return \response()->json([
            "message"=>"success",
            "data"=>$$userUpdate
         ]);    }


// delete method
public function destroy($delete_id)
    {
       $user = User::where('id',$delete_id)->first()->delete();
       return \response()->json([
            "message"=>"success",
            "data"=>$user
         ]);

       }


// Auth security
    public function login(Request $request){
        //  $login  = $request->all();
        $user = User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password))
            {
                   return \response()->json([
                 'data'=> "User Not Found",
                  "Success" => 'fales'
                ]);

            }

     $user['token'] = $user->createToken('MyApp')->plainTextToken;
        if ($user['role']=="vendor"){
            $user['vendor'] =  $user->vendor;
        }else if ($user['role']=="customer"){
            $user['customer'] =  $user->profile;
        }
//        $user['name'] =$user->name;


        return response()->json([
             'success'=>'ture',
            'data'=>$user
            ]);
         }

    public function signup(Request $request)
    {
        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $user['name'] =$user->name;
       // $msg = "signup function";

        return response()->json([
             'success'=>'ture',
            'data'=>$success
        ]);
    }
    public function showProfile(int $id)
    {
        $userProfile = UserProfile::where('user_id',$id)->first();

        if (!$userProfile) {
            return response()->json([
                'success' => false,
                'message' => 'User profile not found',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $userProfile,
        ]);
    }
}
 