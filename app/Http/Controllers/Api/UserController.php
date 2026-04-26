<?php

namespace App\Http\Controllers\api;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function login(Request $request){
        //  $login  = $request->all();
        $user = User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password))
            { 
                   return \response()->json([
                 'data'=> "User Not Found",
                  "Success" => 'fales'
                ]);

            }
     $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $user['name'] =$user->name; 

        return response()->json([
             'success'=>'ture',
            'data'=>$success

            ]);
         }
 
    public function signup(Request $request)
    {
        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $user['name'] =$user->name; 
       // $msg = "signup function";

        return response()->json([
             'success'=>'ture',
            'data'=>$success
        ]);
    }
}
