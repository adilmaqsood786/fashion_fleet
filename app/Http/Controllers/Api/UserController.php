<?php

<<<<<<< HEAD
namespace App\Http\Controllers\api;
use App\Models\User;
use App\Models\Vendor;
use App\Models\UserProfile;
=======
namespace App\Http\Controllers\Api;
>>>>>>> 3eae94efffc3be2c83a561ef922120c105aefa09

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // GET /api/users
    public function index()
    {
        $users = User::with([
            'profile',
            'vendor',
            'rider'
        ])->get();

        return response()->json([
            'status' => true,
            'message' => 'Users fetched successfully',
            'data' => $users
        ], 200);
    }


    // GET /api/users/{id}
    public function show($id)
    {
        $user = User::with([
            'profile',
            'vendor',
            'rider'
        ])->find($id);

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
<<<<<<< HEAD
        $user = User::with(['profile','vendor','rider'])->findOrFail($id);
          return \response()->json([
            "message"=>"success",
            "data"=>$user
         ]);
    }
=======
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'userPhone' => 'required',
            'role' => 'required|in:customer,vendor,rider',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

>>>>>>> 3eae94efffc3be2c83a561ef922120c105aefa09

        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'userPhone' => $request->userPhone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status ? 1 : 0,
            'email_verified_at' => $request->email_verified == 1
                ? now()
                : null,
        ]);


        // CUSTOMER
        if ($request->role === 'customer') {

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
        elseif ($request->role === 'vendor') {

            $logoPath = null;

            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')
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
                'is_active' => $request->is_active ? 1 : 0,
            ]);
        }


        // RIDER
        elseif ($request->role === 'rider') {

            $user->rider()->create([
                'vehicle_type' => $request->vehicle_type,
                'vehicle_number' => $request->vehicle_number,
                'license_number' => $request->license_number,
                'is_available' => $request->is_available ?? 0,
                'is_verified' => $request->is_verified ?? 0,
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
            'email' => 'required|email|unique:users,email,' . $id,
            'userPhone' => 'required',
            'role' => 'required|in:customer,vendor,rider',
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
            'status' => $request->status ? 1 : 0,
            'email_verified_at' => $request->email_verified == 1
                ? now()
                : null,
        ];


        // Update password only if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);


        // CUSTOMER
        if ($user->role === 'customer') {

            if ($user->profile) {

                $user->profile->update([
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
        }


        // VENDOR
        elseif ($user->role === 'vendor') {

            if ($user->vendor) {

                $logo = $user->vendor->logo;

                if ($request->hasFile('logo')) {
                    $logo = $request->file('logo')
                        ->store('vendor', 'public');
                }

                $user->vendor->update([
                    'store_name' => $request->store_name,
                    'store_slug' => $request->store_slug,
                    'logo' => $logo,
                    'register' => $request->register,
                    'license' => $request->license,
                    'address' => $request->address,
                    'vendor_city' => $request->vendor_city,
                    'vendor_country' => $request->vendor_country,
                    'commission_rate' => $request->commission_rate,
                    'is_active' => $request->is_active ? 1 : 0,
                ]);
            }
        }


        // RIDER
        elseif ($user->role === 'rider') {

            if ($user->rider) {

                $user->rider->update([
                    'vehicle_type' => $request->vehicle_type,
                    'vehicle_number' => $request->vehicle_number,
                    'license_number' => $request->license_number,
                    'is_available' => $request->is_available ?? 0,
                    'is_verified' => $request->is_verified ?? 0,
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
<<<<<<< HEAD
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
 
=======


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

        $user->load([
            'profile',
            'vendor',
            'rider'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'data' => $user
        ], 200);
    }
}
>>>>>>> 3eae94efffc3be2c83a561ef922120c105aefa09
