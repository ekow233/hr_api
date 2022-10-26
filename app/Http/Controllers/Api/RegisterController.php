<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{


    //Register function to take care of user registration from api
    public function register(Request $request){

        //check if the user has permission to create users
        $userPerm = AppHelper::instance()->checkCreateUserPerm($request->posted_by);

        //if user does not have the permission {CREATE USERS} return 401
        if(!$userPerm){
            return response()->json(['response_code'=>'401','message'=>'user does not have the required permission']);
        }

        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'employee' => 'required|unique:users,employee',
            'role_id' => 'required'
        ]);

        //if input data fails return error message to the user
        if($validator->fails()){
            $error_msg = $validator->messages();
            return response()->json(['response_code'=>'401','message'=>'user details validation failed '.$error_msg]);
        }else{

            //get all request
            $input = $request->all();

            //decrypt the password
            $input['password'] = bcrypt($input['password']);

            //now create the user
            $user = User::create($input);

            //assign role to user
            // $admin = Role::create(['name' => 'Admin3']);
            $role = Role::find($request->role_id);
            $user->assignRole([$role]);

            return response()->json(['response_code'=>'200','message'=>'user created successfully']);
        }
    }


}
