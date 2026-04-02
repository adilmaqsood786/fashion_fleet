<?php
namespace App\Http\Controllers;
use App\Models\Rider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class RiderController extends Controller
{    

    public function index()
    {
        $riders = Rider::with(['user'])->get();
        return view('riders.index',compact('riders'));
    }
      

    //create method 
    public function create()
    {
        return view('riders.create');
    }
    

    //store data 

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
           'user_id'=>'required',
           'vehicle_type'=>'required',
           'vehicle_number'=>'required',
           'license_number'=>'required',
           'is_available'=>'required',
           'is_verified'=>'required',

        ]);

        if($validate->fails())
             {
              return back()->withErrors($validate)->withInput();
             } 
 
       //rider data create 

        $rider =  Rider::create([
           'user_id'=>$request->user_id,
           'vehicle_type'=>$request->vehicle_type,
           'vehicle_number'=>$request->vehicle_number,
           'license_number'=>$request->license_number,
           'is_available'=>$request->is_available,
           'is_verified'=>$request->is_verified,
         ]);
     //user data create
          $rider->user()->create([
             'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make('123456'),
            'role' => $request->role,
            'status' => $request->status == 'active' ? 1 : 0,
          ]); 
         return redirect()->route('riderIndex');

    }
   


    //Edit Record 
    public function edit($edit_id)
    {
      $riderRecord = Rider::with(['user'])->where('id',$edit_id)->first();
       return view('riders.edit',compact('riderRecord'));
    }

  //update Record

    public function update(Request $request)
    {
       $rider = Rider::where('id',$request->update_id)->first();
       $riderUpdate = $rider->update([
         'user_id'=>$request->user_id,
           'vehicle_type'=>$request->vehicle_type,
           'vehicle_number'=>$request->vehicle_number,
           'license_number'=>$request->license_number,
           'is_available'=>$request->is_available,
           'is_verified'=>$request->is_verified,

       ]);
       if($rider->user){
       $rider->user->update([
         'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make('123456'),
            'role' => $request->role,
            'status' => $request->status == 'active' ? 1 : 0,
       ]);
       }


       return \redirect()->route('riderIndex');
    } 

   //Delete record

      public function destroy($delete_id){
       Rider::where('id',$delete_id)->first()->delete();
       return \redirect()->route('riderIndex');

 }

    }

