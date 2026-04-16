<?php

namespace App\Http\Controllers;
use  App\Models\UserProfile;
use  App\Models\User;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(){ 
    $users = UserProfile::with(['user'])->get();     
    return view('user_profile.index',compact('users'));
    }
      
public function create()

{
    $users = User::all();
    return view('user_profile.create',compact('users'));
}

public function store(Request $request)
{
    $validate = Validator::make($request->all(),[
        'user_id'=>'required',
        'label'=>'required',
        'full_name'=>'required',
        'phone'=>'required',
        'address_line_1'=>'required',
        'address_line_2'=>'required',
        'city'=>'required',
        'state'=>'required',
        'postal_code'=>'required',
        'country'=>'required',
        'latitude'=>'required',
        'longitude'=>'required',
        'is_default'=>'required',

    ]);

    if($validate->fails())
        {
            return back()->withErrors($validate)->withInput();
        }

        UserProfile::create([
             'user_id'=>$request->user_id,
        'label'=>$request->label,
        'full_name'=>$request->full_name,
        'phone'=>$request->phone,
        'address_line_1'=>$request->address_line_1,
        'address_line_2'=>$request->address_line_2,
        'city'=>$request->city,
        'state'=>$request->state,
        'postal_code'=>$request->postal_code,
        'country'=>$request->country,
        'latitude'=>$request->latitude,
        'longitude'=>$request->longitude,
        'is_default'=>$request->is_default,
        ]);
 $users = UserProfile::all();
return \redirect()->route('profileIndex',);
}


//Edit user_profile

 public function edit($edit_id)
 {
    $userProfile = UserProfile::where('id',$edit_id)->first();
    return view('user_profile.edit',compact('userProfile'));
 } 

//update user_profile
public function update(Request $request)
{
      $profile =  UserProfile::where('id',$request->update_id)->first();
      $profileUpdate = $profile->update([
         'user_id'=>$request->user_id,
        'label'=>$request->label,
        'full_name'=>$request->full_name,
        'phone'=>$request->phone,
        'address_line_1'=>$request->address_line_1,
        'address_line_2'=>$request->address_line_2,
        'city'=>$request->city,
        'state'=>$request->state,
        'postal_code'=>$request->postal_code,
        'country'=>$request->country,
        'latitude'=>$request->latitude,
        'longitude'=>$request->longitude,
        'is_default'=>$request->is_default,
      ]);

      return \redirect()->route('profileIndex');
}

// delete user_profile

                   public function destroy($delete_id)
                   {
                    UserProfile::where('id',$delete_id)->first()->delete();
                    return \redirect()->route('profileIndex');
                   }







    }
