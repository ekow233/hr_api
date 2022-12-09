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

        // //check if the user has permission to view users
        // $userPerm = AppHelper::instance()->checkViewEmployeesPerm($request->id);

        //if user does not have the permission {VIEW USERS} return 401
        // if(!$userPerm){
        //     return response()->json(['response_code1'=>'401','message'=>'user does not have the required permission']);
        // }

        $employees = Employee::all();
        return response()->json(['response_code'=>200, 'message'=>'data found', 'data'=>$employees]);
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

        //check if the user has permission to view users
        // $userPerm = AppHelper::instance()->checkViewEmployeesPerm($request->id);

        // //default data
        // $data = null;

        //if user does not have the permission {VIEW USERS} return 401
        // if(!$userPerm){
        //     return response()->json(['response_code'=>401,'message'=>'user does not have the required permission',$data]);
        // }

        //code to get employee details by id
        // $employee = Employee::where('employee_id',$request->employee_id)->first();

        //code to check if the model exists
        $countEmployee = Employee::where('id',$request->id)->count();

        $response = null;
        if($countEmployee>0){
            $employee = Employee::find($request->id);
            $employee->employee_id = $request->employee_id;
            $employee->title = $request->title;
            $employee->first_name = $request->first_name;
            $employee->middle_name = $request->middle_name;
            $employee->last_name = $request->last_name;
            $employee->birthday = $request->birthday;
            $employee->bank_acc_no = $request->bank_acc_no;
            $employee->pay_grade = $request->pay_grade;
            $employee->notches = $request->notches;
            $employee->home_phone = $request->home_phone;
            $employee->mobile_phone = $request->mobile_phone;
            $employee->work_phone = $request->work_phone;
            $employee->work_email = $request->work_email;
            $employee->private_email = $request->private_email;
            $employee->recruitment_date = $request->recruitment_date;
            $employee->supervisor = $request->supervisor;
            $employee->indirect_supervisors = $request->indirect_supervisors;
            $employee->branch = $request->branch;
            $employee->updated_date = date("Y-m-d h:i:s");
            $employee->save();
                    $response = response()->json(['response_code' => 200, 'message' => 'update successful', 'data' => $employee]);
        }else{
                    $response = response()->json(['response_code'=>204,'message'=>'data not found', 'data'=>null]);
        }

        return $response;



    }

        //method to find employee with an id
        public function getEmployeeById(Request $request){
            $employee = Employee::where('id', $request->id)->get();
            $count = Employee::where('id', $request->id)->count();

            if($count>0){
                return response()->json(['response_code' => 200, 'message' => 'data found', 'data' => $employee]);
            }else{
                        return response()->json(['response_code' => 204, 'message' => 'data not found', 'data' => null]);
            }

        }
}
