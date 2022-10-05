<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //this function handles all logins from the api
    public function login(Request $request){

        //validate the credential passed by the user
        $login = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //if login attempt is successful
        if(Auth::attempt($login)){
            //return user type
            $token = Auth::user()->createToken('AuthToken')->accessToken;
            if (auth()->user()->hasRole('Admin')) {
                return response()->json(['user' => Auth::user(), 'token' => $token, 'response_code'=>'200','message'=>'redirect to Admin screen']);
            } else if (auth()->user()->hasRole('Manager')) {
                return response()->json(['user' => Auth::user(), 'token' => $token, 'response_code'=>'200','message'=>'redirect to Manager screen']);
            } else if (auth()->user()->hasRole('Employee')) {
                return response()->json(['user' => Auth::user(), 'token' => $token, 'response_code'=>'200','message'=>'redirect to Employee screen']);
            }else{
                //if user has no role then return with no token
                return response()->json(['user' => Auth::user(), 'response_code'=>'200','message'=>'User has no role']);
            } 
                  
        }else{
            return response()->json(['response_code'=>'401','message'=>'unauthorized user']);
        }

    }
}
