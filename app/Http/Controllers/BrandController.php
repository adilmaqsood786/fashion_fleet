<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{









  public function upload(Request $request){
         $path = $request->file('file')->store('image','public');
         $pathArray = explode('/',$path);
          $imgPath = $pathArray[1];
      
      $image = new Brand();
      $image->logo=$imgPath;
    return  $image->save();
          }






    // // Show all brands
    // public function index()
    // {
    //     $brands = Brand::latest()->get();
    //     return view('brands.index', compact('brands'));
    // }

    // // Show create form
    // public function create()
    // {
    //     return view('brands.create');
    // }

    // // Store data
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|min:3',
    //         'logo' => 'required|image|mimes:jpg,png,jpeg|max:2048'
    //     ]);

    //     $logoPath = $request->file('logo')->store('brands', 'public');

    //     Brand::create([
    //         'name' => $request->name,
    //         'logo' => $logoPath
    //     ]);

    //     return redirect()->route('brands.index')->with('success', 'Brand added successfully');
    // }

    // // Edit form
    // public function edit(Brand $brand)
    // {
    //     return view('brands.edit', compact('brand'));
    // }

    // // Update data
    // public function update(Request $request, Brand $brand)
    // {
    //     $request->validate([
    //         'name' => 'required|min:3',
    //         'logo' => 'image|mimes:jpg,png,jpeg|max:2048'
    //     ]);

    //     if ($request->hasFile('logo')) {
    //         $logoPath = $request->file('logo')->store('brands', 'public');
    //         $brand->logo = $logoPath;
    //     }

    //     $brand->name = $request->name;
    //     $brand->save();

    //     return redirect()->route('brands.index')->with('success', 'Brand updated');
    // }

    // // Delete data
    // public function destroy(Brand $brand)
    // {
    //     $brand->delete();
    //     return back()->with('success', 'Brand deleted');
    // }
}