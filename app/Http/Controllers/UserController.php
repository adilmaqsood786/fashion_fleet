<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //index method
    public function index()
    {
        $users = User::all();
        return view('users.index',compact('users'));
    }
  
    //Create method 
     public function create()
     {
        return view('users.create');
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
   
             User::create(
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


        return redirect()->route('userIndex');

     }


     //edit method
     public function edit($edit_id)
     {
        $userRecord = User::where('id',$edit_id)->first();
        return view('users.edit',compact('userRecord'));
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
         return redirect()->route('userIndex')->with('success','User updated successfully');
     }

     

     //Delete method
      public function destroy($delete_id)
      {
           User::where('id',$delete_id)->first()->delete();
           return redirect()->route('userIndex')->with('success','User Delete successfully');
      }
}
