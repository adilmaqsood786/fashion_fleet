<?php


namespace App\Http\Controllers;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class VendorController extends Controller
{
      public function index()
      {
        $vendors = vendor::with(['user'])->get();
        return view('Vendors.index',compact('vendors'));
      }

      public function create()
      {
        return view('Vendors.create');
      }


      public function store(Request $request)
{
    $validate = Validator::make($request->all(),[
        'store_name'=>'required',
        'store_slug'=>'required',
        'logo'=>'required|image|mimes:jpg,png,jpeg|max:2048',
        'description'=>'required',
        'address'=>'required',
        'city'=>'required',
        'country'=>'required',
        'commission_rate'=>'required',
        'is_approved'=>'required',
        'is_active'=>'required',

    ]); 

    if($validate->fails())
    {
        return back()->withErrors($validate)->withInput();
    }

    // Store image
    $imgPath = null;

    if($request->hasFile('logo')) {
        $path = $request->file('logo')->store('/image','public');
        $imgPath = $path; // store full path
        
    }

    $vendor =  Vendor::create([
        'user_id' => $request->user_id,
        'store_name' => $request->store_name,
        'store_slug'=>$request->store_slug,
        'logo' => $imgPath, // 
        'description' => $request->description,
        'address' => $request->address,
        'city'=>$request->city,
        'country'=>$request->country,
        'commission_rate'=>$request->commission_rate,
        'is_approved'=>$request->is_approved,
        'is_active'=>$request->is_active,

    ]);

      $vendor->user()->create([

      'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make('123456'),
            'role' => $request->role,
            'status' => $request->status == 'active' ? 1 : 0,
      ]);
    return redirect()->route('vendorIndex');
}
  
       
      public function edit($edit_id)
      {
        $vendorRecord = Vendor::with(['user'])->where('id',$edit_id)->first();
        return view('Vendors.edit',compact('vendorRecord'));
      }


      public function update(Request $request)
      {
            
        $vendorRecord = Vendor::where('id',$request->update_id)->first();

         //  Default: old image
            $imgPath = $vendorRecord->logo;

    // If new image uploaded
    if ($request->hasFile('logo')) {
        $path = $request->file('logo')->store('/image', 'public');
        $imgPath = $path;
    }

        $brandUpdate =  $vendorRecord->update(
            [
         'user_id' => $request->user_id,
        'store_name' => $request->store_name,
        'store_slug'=>$request->store_slug,
        'logo' => $imgPath, // 
        'description' => $request->description,
        'address' => $request->address,
        'city'=>$request->city,
        'country'=>$request->country,
        'commission_rate'=>$request->commission_rate,
        'is_approved'=>$request->is_approved,
        'is_active'=>$request->is_active,

            ]
        );

        //user data create
          $vendorRecord->user()->create([
             'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make('123456'),
            'role' => $request->role,
            'status' => $request->status == 'active' ? 1 : 0,
          ]); 
         return redirect()->route('vendorIndex')->with('success','vendor updated successfully');
      }
   

      public function destroy($delete_id)
      {
        Vendor::where('id',$delete_id)->first()->delete();
        return redirect()->route('vendorIndex')->with('success','vendor deleted successfully');
      }
}

























































































      // public function store(Request $request)
      // {
      //        $validate = Validator::make($request->all(),[
      //           'name'=>'required',
      //           'slug'=>'required',
      //           'description'=>'required',
      //           // 'logo'=>'required',
      //           'status'=>'required',
      //        ]); 

      //        if($validate->fails())
      //           {
      //               return back()->withErrors($validate)->withInput();
      //           }
    
      //       $path = $request->file('logo')->store('image','public');
      //       $pathArray = explode('/',$path);
      //       $imgPath = $pathArray[1];
            
        
      //       Vendor::create([
      //       'name'=>$request->name,
      //      'slug'=>$request->slug,
      //      "description"=>$request->description,
      //      'logo'=>$request->logo=$imgPath->save(),
      //      'status'=>$request->status,
      //       ]);

      //       return redirect()->route('vendorIndex');
      // }

// namespace App\Http\Controllers;
// use App\Models\Vendor;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Http\Request;

// class VendorController extends Controller
// {
//       public function index()
//       {
//         $vendors = vendor::all();
//         return view('Vendors.index',compact('vendors'));
//       }

//       public function create()
//       {
//         return view('Vendors.create');
//       }

//       // public function store(Request $request)
//       // {
//       //        $validate = Validator::make($request->all(),[
//       //           'name'=>'required',
//       //           'slug'=>'required',
//       //           'description'=>'required',
//       //           // 'logo'=>'required',
//       //           'status'=>'required',
//       //        ]); 

//       //        if($validate->fails())
//       //           {
//       //               return back()->withErrors($validate)->withInput();
//       //           }
    
//       //       $path = $request->file('logo')->store('image','public');
//       //       $pathArray = explode('/',$path);
//       //       $imgPath = $pathArray[1];
            
        
//       //       Vendor::create([
//       //       'name'=>$request->name,
//       //      'slug'=>$request->slug,
//       //      "description"=>$request->description,
//       //      'logo'=>$request->logo=$imgPath->save(),
//       //      'status'=>$request->status,
//       //       ]);

//       //       return redirect()->route('vendorIndex');
//       // }

//       public function store(Request $request)
// {
//     $validate = Validator::make($request->all(),[
//         'name'=>'required',
//         'slug'=>'required',
//         'description'=>'required',
//         'logo'=>'required|image|mimes:jpg,png,jpeg|max:2048',
//         'status'=>'required',
//     ]); 

//     if($validate->fails())
//     {
//         return back()->withErrors($validate)->withInput();
//     }

//     // Store image
//     $imgPath = null;

//     if($request->hasFile('logo')) {
//         $path = $request->file('logo')->store('/image','public');
//         $imgPath = $path; // store full path
        
//     }

//     Vendor::create([
//         'name' => $request->name,
//         'slug' => $request->slug,
//         'description' => $request->description,
//         'logo' => $imgPath, // 
//         'status' => $request->status,
//     ]);

//     return redirect()->route('vendorIndex');
// }
  
       
//       public function edit($edit_id)
//       {
//         $brandRecord = Vendor::where('id',$edit_id)->first();
//         return view('Vendors.edit',compact('brandRecord'));
//       }


//       public function update(Request $request)
//       {
//         $brandRecord = Vendor::where('id',$request->update_id)->first();
//         $brandUpdate =  $brandRecord->update(
//             [
//            'name'=>$request->name,
//            'slug'=>$request->slug,
//            "description"=>$request->description,
//            'logo'=>$request->logo,
//            'status'=>$request->status,
//             ]
//         );
//          return redirect()->route('vendorIndex')->with('success','Brand updated successfully');
//       }
   

//       public function destroy($delete_id)
//       {
//         Vendor::where('id',$delete_id)->first()->delete();
//         return \redirect()->route('vendorIndex')->with('success','Brand deleted successfully');
//       }
// }
