<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

class CategoryProductController extends Controller
{
    // Show All
    public function index()
    {
        $categories = CategoryProduct::all();

        return response()->json([
            "status" => true,
            "message" => "success",
            "data" => $categories
        ]);
    }

    // Store
    public function store(Request $request)
    {
       
        $imagePath = null;

        if ($request->hasFile('image')) {

            $path = $request->file('image')->store('image', 'public');
            $imagePath = $path;
        }

        $category = CategoryProduct::create([

            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $imagePath,
            'parent_id' => $request->parent_id,
            'is_active' => $request->is_active,

        ]);

        return response()->json([
            "status" => true,
            "message" => "Category Created",
            "data" => $category
        ]);
    }

    // Edit
    public function edit($id)
    {
        $category = CategoryProduct::find($id);

        if (!$category) {

            return response()->json([
                "message" => "Record not found"
            ], 404);
        }

        return response()->json([
            "status" => true,
            "data" => $category
        ]);
    }

    // Update
    public function update(Request $request, $id)
    {
        $category = CategoryProduct::find($id);

        if (!$category) {

            return response()->json([
                "message" => "Record not found"
            ], 404);
        }

       
        $imagePath = $category->image;

        if ($request->hasFile('image')) {

            $path = $request->file('image')->store('image', 'public');
            $imagePath = $path;
        }

        $category->update([

            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $imagePath, 
            'parent_id' => $request->parent_id,
            'is_active' => $request->is_active,

        ]);

        return response()->json([
            "status" => true,
            "message" => "Updated Successfully",
            "data" => $category
        ]);
    }

    // Delete
    public function destroy($id)
    {
        $category = CategoryProduct::find($id);

        if (!$category) {

            return response()->json([
                "message" => "Record not found"    
                ], 404);
        }

        $category->delete();

        return response()->json([
            "status" => true,
            "message" => "Deleted Successfully"
        ]);
    }
}