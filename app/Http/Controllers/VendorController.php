<?php


namespace App\Http\Controllers;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class VendorController extends Controller
{
      public function index()
      {
        $vendors = vendor::all();
        return view('Vendors.index',compact('vendors'));
      }

      public function create()
      {
        return view('Vendors.create');
      }


      public function store(Request $request)
{
    $validate = Validator::make($request->all(),[
        'company_name'=>'required',
        'slug'=>'required',
        'description'=>'required',
        'logo'=>'required|image|mimes:jpg,png,jpeg|max:2048',
        'contact_number'=>'required',
        'licenses'=>'required',
        'account_number'=>'required',
        'account_title'=>'required',
        'iban'=>'required',
        'payment_method'=>'required',
        'status'=>'required',
        'is_verified'=>'required',

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

    Vendor::create([
        'company_name' => $request->company_name,
        'slug'=>$request->slug,
        'description' => $request->description,
        'logo' => $imgPath, // 
        'contact_number' => $request->contact_number,
        'licenses' => $request->licenses,
        'address' => $request->address,
        'bank_name' => $request->bank_name,
        'account_number' => $request->account_number,
        'account_title' => $request->account_title,
        'iban' => $request->iban,
        'payment_method' => $request->payment_method,
        'status' => $request->status,
        'is_verified' => $request->is_verified,

    ]);

    return redirect()->route('vendorIndex');
}
  
       
      public function edit($edit_id)
      {
        $brandRecord = Vendor::where('id',$edit_id)->first();
        return view('Vendors.edit',compact('brandRecord'));
      }


      public function update(Request $request)
      {
            
        $brandRecord = Vendor::where('id',$request->update_id)->first();

         //  Default: old image
            $imgPath = $brandRecord->logo;

    // If new image uploaded
    if ($request->hasFile('logo')) {
        $path = $request->file('logo')->store('/image', 'public');
        $imgPath = $path;
    }

        $brandUpdate =  $brandRecord->update(
            [
          'company_name' => $request->company_name,
        'slug' => $request->slug,
        'description' => $request->description,
        'logo' => $imgPath, // 
        'contact_number' => $request->contact_number,
        'licenses' => $request->licenses,
        'address' => $request->address,
        'bank_name' => $request->bank_name,
        'account_number' => $request->account_number,
        'account_title' => $request->account_title,
        'iban' => $request->iban,
        'payment_method' => $request->payment_method,
        'status' => $request->status,
        'is_verified' => $request->is_verified,
            ]
        );
         return redirect()->route('vendorIndex')->with('success','Brand updated successfully');
      }
   

      public function destroy($delete_id)
      {
        Vendor::where('id',$delete_id)->first()->delete();
        return \redirect()->route('vendorIndex')->with('success','Brand deleted successfully');
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
