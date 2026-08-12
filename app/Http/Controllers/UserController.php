<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with(['profile','vendor','rider'])->get();
        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validation
        $validate = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'userPhone' => 'required|string|max:20',
            'role' => 'required|string|in:customer,vendor,rider', // Added 'in' rule
            'status' => 'required|boolean', // Changed to boolean
            // Add specific validation rules for profile, vendor, rider based on role
        ]);

        if($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'userPhone' => $request->userPhone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => (bool) $request->status, // Cast to boolean
            'email_verified_at' => (bool) $request->email_verified ? now() : null,
        ]);

        // Role-based insert
        if($user->role === 'customer'){
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
        } elseif($user->role === 'vendor'){
            $logoPath = null;

            if($request->hasFile('logo')){
                $logo = $request->file('logo')->store('image/','public');
                $logoPath = $logo;
            }

            $user->vendor()->create([
                'store_name' => $request->store_name,
                'store_slug' => $request->store_slug,
                'logo' => $logoPath,
                'license'=>$request->license,
                'register'=>$request->register,
                'address' => $request->address,
                'vendor_city' => $request->vendor_city,
                'vendor_country' => $request->vendor_country,
                'commission_rate' => $request->commission_rate,
                'is_active' => (bool) $request->is_active,
            ]);
        } elseif($user->role === 'rider'){
            $user->rider()->create([
                'vehicle_type' => $request->vehicle_type,
                'vehicle_number' => $request->vehicle_number,
                'license_number' => $request->license_number,
                'is_available' => $request->is_available ?? 0,
                'is_verified' => $request->is_verified ?? 0,
            ]);
        }

        return redirect()->route('user.index');
    }

    public function edit(int $id): View
    {
        $user = User::with(['profile','vendor','rider'])->findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request): RedirectResponse
    {
        $user = User::findOrFail($request->id); // Use findOrFail

        // Only update password if a new one is provided
        $userData = $request->only(['name', 'email', 'userPhone', 'role']);
        $userData['status'] = (bool) $request->status;
        $userData['email_verified_at'] = (bool) $request->email_verified ? now() : null;

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update([
            ...$userData,
        ]);

        if($user->role === 'customer' && $user->profile){
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
            ]); // Removed extra closing brace
        }

        // VENDOR UPDATE
        if($user->role === 'vendor' && $user->vendor){
            $logo = $user->vendor->logo;

            if($request->hasFile('logo')){
                // Delete old logo if it exists
                if ($logo && \Storage::disk('public')->exists($logo)) {
                    \Storage::disk('public')->delete($logo);
                }
                $logo = $request->file('logo')->store('vendor','public');
            }

            $user->vendor->update([
                'store_name' => $request->store_name,
                'store_slug' => $request->store_slug,
                'logo' => $logo,
                'register'=>$request->register,
                'license'=>$request->license,
                'address' => $request->address,
                'vendor_city' => $request->vendor_city,
                'vendor_country' => $request->vendor_country,
                'commission_rate' => $request->commission_rate,
                'is_active' => (bool) $request->is_active,
            ]);
        } elseif($user->role === 'rider'){
            $user->rider()->update([
                'vehicle_type' => $request->vehicle_type,
                'vehicle_number' => $request->vehicle_number,
                'license_number' => $request->license_number,
                'is_available' => $request->is_available ?? 0,
                'is_verified' => $request->is_verified ?? 0,
            ]);
        }   

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function destroy(int $delete_id): RedirectResponse
    {
        User::destroy($delete_id); // More idiomatic Laravel for deleting by ID
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }

    public function loginUser(): View
    {
        return view('welcome');
    }

    public function loginCheck(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('user.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
