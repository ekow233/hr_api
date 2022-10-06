<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    //log the user out
    public function logout(){
        if(Auth::check()){
            Auth::user()->token()->revoke();
            return response()->json(['response_code'=>'200','message'=>'User Logged out']);
        }
        // $user = Auth::user()->token();
    }
}
