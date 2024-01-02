<?php

namespace App\Http\Controllers\Api;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{
    //create leave types
    public function addLeaveType(Request $request){

       //validate entries
        $validator = Validator::make($request->all(),[
                "name" => 'required',
                'leave_gl' => 'required',
                "supervisor_leave_assign" => 'required',
                "employee_can_apply" => 'required',
                "apply_beyond_current" => 'required',
                "default_per_year" => 'required',
                
        ]); 

        //if validator fails
        if($validator->fails()){
            return $error_msg = $validator->messages();
        }else{

            //create leave type
            $leaveType = LeaveType::create($request->all());

            //if creation is a success return return success
            if($leaveType){
                return response()->json(['leave type details' => $leaveType,'response_code'=>'200','message'=>'Leave type Added']);
            }else{
                return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
            }
        }
    }

    //update leave types
    public function updateLeaveType(Request $request){

       //validate entries
        $validator = Validator::make($request->all(),[
                "id" => 'required',
                "name" => 'required',
                'leave_gl' => 'required',
                "supervisor_leave_assign" => 'required',
                "employee_can_apply" => 'required',
                "apply_beyond_current" => 'required',
                "default_per_year" => 'required',                
        ]); 

        //if validator fails
        if($validator->fails()){
            return $error_msg = $validator->messages();
        }else{

            //now update the leave type
            $leaveType = LeaveType::find($request->id)->update($request->all());
                    

            //if update is a success return return success
            if($leaveType){
                return response()->json(['response_code'=>'200','message'=>'Leave type updated']);
            }else{
                return response()->json(['response_code'=>'401','message'=>'Something went wrong, try again or contact admin']);
            }
        }
    }

    //get all leave types
    public function getAllLeaveTypes(){

        //get all leaves
        $allLeaveTypes = LeaveType::all();

        //if leave type exist return all
        if($allLeaveTypes){
            return response()->json(['All Leave types' => $allLeaveTypes,'response_code'=>'200','message'=>'All Company Structures']);
        }else{
            return response()->json(['response_code'=>'401','message'=>'Company structure could not be added, try again or contact admin']);
        }
    }
}
