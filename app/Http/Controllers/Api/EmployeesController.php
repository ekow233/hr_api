<?php

namespace App\Http\Controllers\Api;

use Carbon\Traits\Date;
use App\Models\Employee;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    //get all the employees
    public function getEmployees(Request $request){

        //check if the user has permission to view users
        $userPerm = AppHelper::instance()->checkViewEmployeesPerm($request->id);
        
        //if user does not have the permission {VIEW USERS} return 401
        if(!$userPerm){
            return response()->json(['response_code1'=>'401','message'=>'user does not have the required permission']);
        }

        $employees = Employee::all();
        return $employees;
    }

    //create employees
    public function createEmployee(Request $request){

        // return $request;

        //check if the user has permission to view users
        $userPerm = AppHelper::instance()->checkCreateEmployeePerm($request->posted_by);
        
        //if user does not have the permission {VIEW USERS} return 401
        if(!$userPerm){
            return response()->json(['response_code'=>'401','message'=>'user does not have the required permission']);
        }

        $validator = Validator::make($request->all(),[
        "employee_id" => 'Required|Unique:employees',
        "title" => 'required',
        "first_name" => 'required',
        "middle_name" => 'required',
        "last_name" => 'required',
        "birthday" => 'required',
        "bank_acc_no" => 'required',
        "pay_grade" => 'required',
        "notches" => 'required',
        "home_phone" => 'required',
        "mobile_phone" => 'required',
        "work_phone" => "required",
        "work_email" => 'required',
        "private_email" => 'required',
        "recruitment_date" => 'required',
        "supervisor" => 'required',
        "indirect_supervisors" => 'required',
        "branch" => 'required'
        ]);


        if($validator->fails()){
            return $error_msg = $validator->messages();
            // return response()->json(['response_code'=>'401','message'=>'user details validation failed'.$error_msg]);
        }else{
            //now create the user
            
            //get the date objects
            $time = strtotime($request->birthday);
            $birthday = date('Y-m-d',$time);

            $recruit_time = strtotime($request->birthday);
            $recruitment = date('Y-m-d',$recruit_time);

            //add date to request
            $request['recruitment_date'] = $recruitment;
            $request['birthday'] = $birthday;

            //add employee to database
            $employee = Employee::create($request->all());

            //if creation is a success return return success
            if($employee){
                return response()->json(['employee details' => $employee,'response_code'=>'200','message'=>'Employee Added']);
            }else{
                return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
            }
           
        }
    }

    // update employee details
    public function updateEmployee(Request $request){
        
    }
}
