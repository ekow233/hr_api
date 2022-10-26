<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    //This controller handles users

    //this function gets all users and their roles
    public function getUsers(Request $request){

         //check if the user has permission to view users
        $userPerm = AppHelper::instance()->checkViewUsersPerm($request->requested_by);
        
        //if user does not have the permission {VIEW USERS} return 401
        if(!$userPerm){
            return response()->json(['response_code'=>'401','message'=>'user does not have the required permission']);
        }

        return response()->json(['users' => User::with('roles')->paginate(15),'response_code'=>'200','message'=>'All users']);
    }

    //this function deletes user
    public function deactivateUser(Request $id)
    {

        //check if the user has permission to view users
        $userPerm = AppHelper::instance()->checkDeactivateUserPerm($id->id);
        
        //if user does not have the permission {VIEW USERS} return 401
        if(!$userPerm){
            return response()->json(['response_code'=>'401','message'=>'user does not have the required permission']);
        }

        //find the user
        $user = User::find($id->id);

        //set status to 0 for inactive and save 
        $user->status = 0;
        $user->save();

        //return response
        return response()->json(['response_code'=>'200','message'=>'User Deactivated']);
    }


    //this function deletes user
    public function activateUser(Request $id){

        //check if the user has permission to view users
        $userPerm = AppHelper::instance()->checkActivateUserPerm($id->id);
        
        //if user does not have the permission {VIEW USERS} return 401
        if(!$userPerm){
            return response()->json(['response_code'=>'401','message'=>'user does not have the required permission']);
        }

        //find the user
        $user = User::find($id->id);

        //set status to 0 for inactive and save 
        $user->status = 1;
        $user->save();

        //return response
        return response()->json(['response_code'=>'200','message'=>'User Activated']);
    }
}
