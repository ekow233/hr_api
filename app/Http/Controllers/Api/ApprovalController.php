<?php

namespace App\Http\Controllers\Api;

use App\Models\Approval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApprovalController extends Controller
{
    //this function returns the approval data
    public function getApproval(Request $request){

        // Get All approval data
        $approvals = Approval::all();

        //get the limit of the general approval
        $limitOfGeneral = Approval::find(1)->levels;

        //put result in the array
        $approvalData = array($approvals, $limitOfGeneral);

        //return approval data
        return response()->json(['Approval Data' => $approvalData,'response_code'=> 200,'message'=>'All Approval data']);
  
    }

    //update an approval
    public function updateApproval(Request $request){
            //validate entries
            $validator = Validator::make($request->all(),[
                "id" => 'required',
                "self_approval" => 'required',
                "levels" => 'required'
            ]);

            //if validator fails
            if($validator->fails()){
                return $validator->messages();    
            }else{
                //update the details of a particular approval
                $approval = Approval::where('id', $request->id)->first();
                $approval->self_approval = $request->self_approval;
                $approval->levels = $request->levels;

                //if the approval is the general approval
                if ($request->id == 1) {
                    //update all approvals settings where the approval levels are greater than the new general
                    //approval level to have the same level as the general approval
                    $outcome = Approval::where('levels', '>', $request->levels)->update(['levels' => $request->levels]);

                    if($outcome){
                        $saved = $approval->save();

                        //return approval data
                        return response()->json(['response_code'=> 200,'message'=>'General Approval updated']);
                    }
                }

                //save approval
                $saved = $approval->save();

                if($saved){
                    //return approval data
                    return response()->json(['response_code'=> 200,'message'=>'Approval updated']);
                } else {
                    // Return an error message if no record is found
                    return response()->json(['message' => 'Update not successful !!', 'response_code' => '400']);
                }
            }
         
    }


    //this function updates all approval levels
    public function updateAllApprovals(Request $request){
        //validate entries
        $validator = Validator::make($request->all(),[
            "levels" => 'required'
        ]);

        //if validator fails
        if($validator->fails()){
            return $validator->messages();
        }else{

            //update all approvals settings to the same level
            $saved =  DB::table('approvals')->update(['levels' => $request->levels]);

            if ($saved) {
                return response()->json(['message' => 'All Levels Updated', 'response_code' => 200]);
            } else {
                // Return an error message if no record is found
                return response()->json(['message' => 'Update not successful !!', 'response_code' => 400]);
            }
        }   
    }
}
