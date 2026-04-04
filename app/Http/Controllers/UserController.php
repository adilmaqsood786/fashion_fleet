<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['profile','vendor','rider'])->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // dd($request->user->role->rider()->all());
        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make('123456'),
            'role' => $request->role,
            'status' => $request->status == 'active' ? 1 : 0,
        ]); 

        // Role-based insert

       if($request->role == 'customer'){
    // $request->validate([
    //     'label' => 'required',
    //     'full_name' => 'required',
    //     'profile_phone' => 'required',
    //     'address_line_1' => 'required',
    //     'city' => 'required',
    //     'country' => 'required',
    // ]);

    $user->profile()->create([
        'label' => $request->label,
        'full_name' => $request->full_name,
        'phone' => $request->phone,
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

        elseif($request->role == 'vendor'){
            $logo = null;

            if($request->hasFile('logo')){
                $logo = $request->file('logo')->store('vendor','public');
            }

            $user->vendor()->create([
                'store_name' => $request->store_name,
                'store_slug' => $request->store_slug,
                'logo' => $logo,
                'description' => $request->description,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'commission_rate' => 10,
                'is_approved' => 1,
                'is_active' => 1,
            ]);
        }

        elseif($request->role == 'rider'){
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

    public function edit($id)
    {
        $user = User::with(['profile','vendor','rider'])->findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::where('id',$request->id)->first();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if($user->role == 'customer' && $user->profile){
            $user->profile->update([
                'full_name' => $request->full_name,
                'city' => $request->city,
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
            'city' => $request->city,
            'country' => $request->country,
            'commission_rate' => $request->commission_rate,
            'is_approved' => $request->is_approved,
            'is_active' => $request->is_active ?? 0,
        ]); 
    }


        return redirect()->route('user.index');
    }

    public function destroy($delete_id)
    {
        User::where('id',$delete_id)->first()->delete();
        return redirect()->route('user.index');
    }
}   