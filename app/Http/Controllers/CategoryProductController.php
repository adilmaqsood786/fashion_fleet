<?php

namespace App\Http\Controllers;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryProductController extends Controller
{
        public function index()
       {
        $categories = CategoryProduct::all();
        return view('categories.index',compact('categories'));
       }  

       public function create()
       {
        $categories = CategoryProduct::all();
        return view('categories.create',compact('categories'));
       } 
     
       public function store(Request $request)
       {
         $validate =  Validator::make($request->all(),[
            
                'name' => 'required',
                'slug' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
                'parent_id' => 'required',
                'is_active' => "required|Nullable",

         ]); 

         if($validate->fails())
            {
               //   dd($validate->errors());Q
               return back()->withErrors($validate)->withInput();
            }

           //image
           $imagePath = null;
     
         if($request->hasFile('image')) {
                $path = $request->file('image')->store('/image','public');
                $imagePath = $path; // store full path
        
    }

            CategoryProduct::create([
                'name'=>$request->name,
                'slug'=>$request->slug,
                'image'=>$imagePath,
                'parent_id'=>$request->parent_id,
                'is_active'=>$request->is_active,

            ]);

            return redirect()->route('categoryIndex');
       }

        //edit method
     public function edit($edit_id)
     {
        $categoryRecord = CategoryProduct::where('id',$edit_id)->first();
        return view('categories.edit',compact('categoryRecord'));
     }


     
     //update method
     public function update(Request $request)
     {
         $categoryRecord = CategoryProduct::where('id',$request->update_id)->first();
      
         $imagePath = $categoryRecord->image;
      
                if($request->hasFile('image')) {
                $path = $request->file('image')->store('/image','public');
                $imagePath = $path; // store full path
         
                }
         
                $categoryUpdate = $categoryRecord->update([
                'name'=>$request->name,
                'slug'=>$request->slug,
                'image'=>$imagePath,
                'parent_id'=>$request->parent_id,
                'is_active'=>$request->is_active,

         ]);
         return redirect()->route('categoryIndex')->with('success','category updated successfully');
     }

     

    //  //Delete method
      public function destroy($delete_id)
      {
           CategoryProduct::where('id',$delete_id)->first()->delete();
           return redirect()->route('categoryIndex')->with('success','Category Delete successfully');
      }



}
