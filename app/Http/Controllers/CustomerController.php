<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //index method
    public function index()
    {
        $users = Customer::all();
        return view('customers.index',compact('users'));
    }
  
    //Create method 
     public function create()
     {
        return view('customers.create');
     }


     //store method 
     public function store(Request $request)
     {
        $validate =  Validator::make($request->all(),
        [
            'first_name'=>'required',
            'last_name'=>'required',
            'father_name'=>'required',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|unique:customers,phone',
            'address'=>'required',

        ]);
        if($validate->fails())
            {
                return back()->withErrors($validate)->withInput();
            }
   
             Customer::create(
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


        return redirect()->route('customerIndex');

     }


     //edit method
     public function edit($edit_id)
     {
        $userRecord = Customer::where('id',$edit_id)->first();
        return view('customers.edit',compact('userRecord'));
     }



     //update method
     public function update(Request $request)
     {
         $userRecord = Customer::where('id',$request->update_id)->first();
         $userUpdate = $userRecord->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'father_name'=>$request->father_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
         ]);
         return redirect()->route('customerIndex')->with('success','User updated successfully');
     }

     

     //Delete method
      public function destroy($delete_id)
      {
           Customer::where('id',$delete_id)->first()->delete();
           return redirect()->route('customerIndex')->with('success','User Delete successfully');
      }
}
