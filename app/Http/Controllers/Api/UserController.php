<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // GET /api/user
    public function index()
    {
        $users = User::with(['profile', 'vendor', 'rider'])->get();

        return response()->json([
            'status' => true,
            'message' => 'Users fetched successfully',
            'data' => $users,
        ], 200);
    }

    // GET /api/edit-user/{edit_id}
    public function edit($id)
    {
        $user = User::with(['profile', 'vendor', 'rider'])->find($id);

        if (! $user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'User fetched successfully',
            'data' => $user,
        ], 200);
    }

    // POST /api/store-user
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'userPhone' => 'required',
            'role' => 'required|in:customer,vendor,rider,admin',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'userPhone' => $request->userPhone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status ? 1 : 0,
            'email_verified_at' => $request->email_verified == 1 ? now() : null,
        ]);

        $this->syncRoleProfile($user, $request);

        $user->load(['profile', 'vendor', 'rider']);

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'data' => $user,
        ], 201);
    }

    // POST /api/upuser/{update_id}
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (! $user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'userPhone' => 'required',
            'role' => 'required|in:customer,vendor,rider,admin',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'userPhone' => $request->userPhone,
            'role' => $request->role,
            'status' => $request->status ? 1 : 0,
            'email_verified_at' => $request->email_verified == 1 ? now() : null,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        $this->syncRoleProfile($user, $request, forUpdate: true);

        $user->load(['profile', 'vendor', 'rider']);

        return response()->json([
            'status' => true,
            'message' => 'User updated successfully',
            'data' => $user,
        ], 200);
    }

    // GET /api/delete-user/{delete_id}
    public function destroy($id)
    {
        $user = User::find($id);

        if (! $user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully',
        ], 200);
    }

    // POST /api/signup
    public function signup(Request $request)
    {
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
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'userPhone' => $request->userPhone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 1,
            'email_verified_at' => now(),
        ]);

        $token = $user->createToken('MyApp')->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $token,
                'user' => $user,
            ],
        ], 201);
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
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password',
            ], 401);
        }

        $user->load(['profile', 'vendor', 'rider']);
        $token = $user->createToken('MyApp')->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $token,
                'user' => $user,
            ],
        ], 200);
    }

    // GET /api/user-profiles/{id}
    public function showProfile(int $id)
    {
        $userProfile = UserProfile::where('user_id', $id)->first();

        if (! $userProfile) {
            return response()->json([
                'success' => false,
                'message' => 'User profile not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $userProfile,
        ]);
    }

    /**
     * Create or update the role-specific related record (profile/vendor/rider)
     * for a user, based on the submitted request payload.
     */
    private function syncRoleProfile(User $user, Request $request, bool $forUpdate = false): void
    {
        if ($user->role === 'customer') {
            $data = [
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
            ];

            $forUpdate && $user->profile
                ? $user->profile->update($data)
                : $user->profile()->create($data);

            return;
        }

        if ($user->role === 'vendor') {
            $logo = $forUpdate ? $user->vendor?->logo : null;

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo')->store('vendor', 'public');
            }

            $data = [
                'store_name' => $request->store_name,
                'store_slug' => $request->store_slug,
                'logo' => $logo,
                'license' => $request->license,
                'register' => $request->register,
                'address' => $request->address,
                'vendor_city' => $request->vendor_city,
                'vendor_country' => $request->vendor_country,
                'commission_rate' => $request->commission_rate ?? 10,
                'is_active' => $request->is_active ? 1 : 0,
            ];

            $forUpdate && $user->vendor
                ? $user->vendor->update($data)
                : $user->vendor()->create($data);

            return;
        }

        if ($user->role === 'rider') {
            $data = [
                'vehicle_type' => $request->vehicle_type,
                'vehicle_number' => $request->vehicle_number,
                'license_number' => $request->license_number,
                'is_available' => $request->is_available ?? 0,
                'is_verified' => $request->is_verified ?? 0,
            ];

            $forUpdate && $user->rider
                ? $user->rider->update($data)
                : $user->rider()->create($data);
        }
    }
}
