<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //Register function to take care of user registration from api
    public function register(Request $request){

        //validate user creation details
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['response_code'=>'401','message'=>'user details validation failed']);
        }else{
            return response()->json(['response_code'=>'200','message'=>'user created successfully']);
        }
    }
}
