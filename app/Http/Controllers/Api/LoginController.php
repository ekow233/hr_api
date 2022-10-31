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

            //if the account is authenticated check to see if the account is
            //inactive log the user out
            if(Auth::user()->status == 0){
                //get the user token
                $user = Auth::user()->token();

                //if user has not logged in before return response
                if($user == null){
                    return response()->json(['response_code'=>'401','message'=>'User has been deactivated']);
                }

                //if user has logged in before revoke the token and return response
                $user->revoke();
                return response()->json(['response_code'=>'401','message'=>'User has been deactivated']);
            }

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
