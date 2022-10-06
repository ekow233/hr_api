<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    //This controller handles users

    //this function gets all users and their roles
    public function getUsers(User $model){
        return response()->json(['users' => User::with('roles')->paginate(15),'response_code'=>'200','message'=>'All users']);
    }


    //this function deletes user
    public function deactivateUser(Request $id)
    {
        //find the user
        $user = User::find($id->id);

        //set status to 0 for inactive and save 
        $user->status = 0;
        $user->save();

        //return response
        return response()->json(['response_code'=>'200','message'=>'User Deactivated']);
    }
}
