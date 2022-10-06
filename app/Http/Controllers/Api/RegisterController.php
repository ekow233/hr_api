<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    //Register function to take care of user registration from api
    public function register(Request $request){

        // return("creating user");

        //validate user creation details
        // $validator = Validator::make($request->all(), [
        //     'username' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required',
        //     'employee' => 'required'
        // ]);

        // $validator = $request->validate([
        //     'username' => 'required',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required',
        //     'employee' => 'required|unique:users,employee',
        //     'role_id' => 'required'
        // ]);

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
