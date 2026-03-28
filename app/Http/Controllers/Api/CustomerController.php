<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{
    public function index(){
     $users = User::all();
         return response()->json([
            'message'=>'success',
            'data'=>$users

         ]);
         }

         
     //store method 
     public function store(Request $request)
     {
        $validate =  Validator::make($request->all(),
        [
            'first_name'=>'required',
            'last_name'=>'required',
            'father_name'=>'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'address'=>'required',

        ]);
        if($validate->fails())
            {
                return back()->withErrors($validate)->withInput();
            }
   
         $customer =   User::create(
                [
            // 'id'=>$request->id,        
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'father_name'=>$request->father_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
                ]
             );


        return response()->json([ 
               'message'=>'user created successfully',
               'data'=>$customer
               ]);
             
     }


      //edit method
     public function edit($edit_id)
     {
        $userRecord = User::where('id',$edit_id)->first();
        return response()->json([
            'message'=>'get data successfully',
            'data'=>$userRecord
        ]);
     }

     //update method
     public function update(Request $request)
     {
       
         $userRecord = User::where('id',$request->update_id)->first();

         $userUpdate = $userRecord->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'father_name'=>$request->father_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
         ]);
         $userUpdate = User::where('id',$request->update_id)->first();

   return   response()->json([
    'message'=>"Update Customer Successfully",
    'data'=>$userUpdate
   ]);
         }

//Delete method
      public function destroy($delete_id)
      {
         $delete =  User::where('id',$delete_id)->first()->delete();
        return response()->json([
        'message'=>'Delete customer successfully',
        'data'=>$delete
        ]);
           }
}
