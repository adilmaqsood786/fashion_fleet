<?php

namespace App\Http\Controllers;
use  App\Models\User_address;
use Illuminate\Http\Request;

class User_addressController extends Controller
{
    public function index(){ 
    $users = User_address::all();     
    return view('user_address.index',compact('users'));
    }
      
public function create()
{
    return view('user_address.create');
}








    }
