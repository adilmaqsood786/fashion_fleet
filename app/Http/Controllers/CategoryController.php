<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
       public function index()
       {
        $categories = Category::all();
        return view('categories.index',compact('categories'));
       }  

       public function create()
       {
        return view('categories.create');
       } 

       public function store(Request $request)
       {
         $validate =  Validator::make($request->all(),[
            'name'=>'required',
            'parent_id'=>'required',
            'status'=>'required',

         ]); 

         if($validate->fails())
            {
               return back()->withErrors($validate)->withInput();
            }

            Category::create([
                'name'=>$request->name,
                'parent_id'=>$request->parent_id,
                'status'=>$request->status,

            ]);
            return redirect()->route('categoryIndex');
       }

        //edit method
     public function edit($edit_id)
     {
        $categoryRecord = Category::where('id',$edit_id)->first();
        return view('categories.edit',compact('categoryRecord'));
     }


     
     //update method
     public function update(Request $request)
     {
         $categoryRecord = Category::where('id',$request->update_id)->first();
         $categoryUpdate = $categoryRecord->update([
            'name'=>$request->name,
                'parent_id'=>$request->parent_id,
                'status'=>$request->status,

         ]);
         return redirect()->route('categoryIndex')->with('success','category updated successfully');
     }

     

    //  //Delete method
      public function destroy($delete_id)
      {
           Category::where('id',$delete_id)->first()->delete();
           return redirect()->route('categoryIndex')->with('success','Category Delete successfully');
      }



}
