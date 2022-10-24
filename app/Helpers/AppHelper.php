<?php
namespace App\Helpers;

use App\Models\User;
use Spatie\Permission\Models\Role;

class AppHelper
{


      public static function instance()
     {
         return new AppHelper();
     }

      //*************************************************//
      //*          USER PERMISSION CHECKS               *//    
      //*************************************************//

      //checks for permission to create users
      public function checkCreateUserPerm($user)
      {
            //find the user and get all the roles
            $user = User::find($user)->roles->all();

            //get the id of the role and find the role object
            $role_id = $user[0]->pivot->role_id;
            $role = Role::find($role_id);

            //now get all the permissions assigned to the role
            $perm1 = Role::where('roles.id', $role_id)->with('permissions')->get();
            //get the permissions array
            $perms = $perm1[0]->permissions;

            //loop through the arrays to check if the user role has "create user" permission
            //if it exist then return true else false
            foreach($perms as $perm){
                  if($perm->name == "create user"){
                        return true;
                  }
            }
            return false;
             
      }

      //check for permission to view users
      public function checkViewUsersPerm($user)
      {
            //find the user and get all the roles
            $user = User::find($user)->roles->all();

            //get the id of the role and find the role object
            $role_id = $user[0]->pivot->role_id;
            $role = Role::find($role_id);

            //now get all the permissions assigned to the role
            $perm1 = Role::where('roles.id', $role_id)->with('permissions')->get();
            //get the permissions array
            $perms = $perm1[0]->permissions;

            //loop through the arrays to check if the user role has "create user" permission
            //if it exist then return true else false
            foreach($perms as $perm){
                  if($perm->name == "view users"){
                        return true;
                  }
            }
            return false;
             
      }

      //check for permission to view users
      public function checkDeactivateUserPerm($user)
      {
            //find the user and get all the roles
            $user = User::find($user)->roles->all();

            //get the id of the role and find the role object
            $role_id = $user[0]->pivot->role_id;
            $role = Role::find($role_id);

            //now get all the permissions assigned to the role
            $perm1 = Role::where('roles.id', $role_id)->with('permissions')->get();
            //get the permissions array
            $perms = $perm1[0]->permissions;

            //loop through the arrays to check if the user role has "create user" permission
            //if it exist then return true else false
            foreach($perms as $perm){
                  if($perm->name == "deactivate user"){
                        return true;
                  }
            }
            return false;
             
      }

      //check for permission to view users
      public function checkActivateUserPerm($user)
      {
            //find the user and get all the roles
            $user = User::find($user)->roles->all();

            //get the id of the role and find the role object
            $role_id = $user[0]->pivot->role_id;
            $role = Role::find($role_id);

            //now get all the permissions assigned to the role
            $perm1 = Role::where('roles.id', $role_id)->with('permissions')->get();
            //get the permissions array
            $perms = $perm1[0]->permissions;

            //loop through the arrays to check if the user role has "create user" permission
            //if it exist then return true else false
            foreach($perms as $perm){
                  if($perm->name == "activate user"){
                        return true;
                  }
            }
            return false;
             
      }


       //*************************************************//
      //*          EMPLOYEE PERMISSION CHECKS               *//    
      //*************************************************//

      
      //check for permission to view employees
      public function checkViewEmployeesPerm($user)
      {
            //find the user and get all the roles
            $user = User::find($user)->roles->all();

            //get the id of the role and find the role object
            $role_id = $user[0]->pivot->role_id;
            $role = Role::find($role_id);

            //now get all the permissions assigned to the role
            $perm1 = Role::where('roles.id', $role_id)->with('permissions')->get();
            //get the permissions array
            $perms = $perm1[0]->permissions;

            //loop through the arrays to check if the user role has "create user" permission
            //if it exist then return true else false
            foreach($perms as $perm){
                  if($perm->name == "view employees"){
                        return true;
                  }
            }
            return false;
             
      }

      //check for permission to view employees
      public function checkCreateEmployeePerm($user)
      {
            //find the user and get all the roles
            $user = User::find($user)->roles->all();

            //get the id of the role and find the role object
            $role_id = $user[0]->pivot->role_id;
            $role = Role::find($role_id);

            //now get all the permissions assigned to the role
            $perm1 = Role::where('roles.id', $role_id)->with('permissions')->get();
            //get the permissions array
            $perms = $perm1[0]->permissions;

            //loop through the arrays to check if the user role has "create user" permission
            //if it exist then return true else false
            foreach($perms as $perm){
                  if($perm->name == "create employee"){
                        return true;
                  }
            }
            return false;
             
      }

     
}