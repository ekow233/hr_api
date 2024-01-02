<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Companystructure;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CompanyStructureController extends Controller
{
    
    //add branch or department
    public function addCompanyStructure(Request $request){

        //check to see if employee has the right to add company structure
        $userPerm = AppHelper::instance()->checkCreateCompStructurePerm(Auth::user()->id);

        //if user does not have the permission {ADD COMPANY STRUCTURE} return 401
        if(!$userPerm){
            return response()->json(['response_code'=>'401','message'=>'user does not have the required permission']);
        }

        //validate entries
        $validator = Validator::make($request->all(),[
            "title" => 'required',
            "comp_code" => 'required|unique:companystructures',
            "type" => 'required',
            "country" => 'required'
        ]);

        if($validator->fails()){
            return $validator->messages();
        }else{

            $request['approval_status'] = "Pending";
            $compstructure = Companystructure::create($request->all());

            //if creation is a success return return success
            if($compstructure){
                return response()->json(['company sturcture' => $compstructure,'response_code'=>'200','message'=>'Company Structure Added']);
            }else{
                return response()->json(['response_code'=>'401','message'=>'Company structure could not be added, try again or contact admin']);
            }
        }


    }

    //edit branch
    public function updateCompanyStructure(Request $request){
        
        //check to see if employee has the right to add company structure
        $userPerm = AppHelper::instance()->checkEditCompStructurePerm(Auth::user()->id);

        //if user does not have the permission {ADD COMPANY STRUCTURE} return 401
        if(!$userPerm){
            return response()->json(['response_code'=>'401','message'=>'user does not have the required permission']);
        }else{

            //validate entries
            $validator = Validator::make($request->all(),[
                "id" => 'required',
                "title" => 'required',
                'comp_code' => [
                    Rule::unique('companystructures')->ignore($request->id),
                ],
                "type" => 'required',
                "country" => 'required'
            ]);

            //if the validation fails return error
            if($validator->fails()){
                    return $validator->messages();
            }else{  
                    //now update the company structure
                    $compstructure = Companystructure::find($request->id)->update($request->all());
                    
                    //if creation is a success return return success
                    if($compstructure){
                        return response()->json(['company sturcture' => $compstructure,'response_code'=>'200','message'=>'Company Structure Updated']);
                    }    
            }
        }
    }

    //get all the company structures
    public function getAllStructures(Request $request){

        //check to see if employee has the right to add company structure
        $userPerm = AppHelper::instance()->checkEditCompStructurePerm(Auth::user()->id);

        //if user does not have the permission {ADD COMPANY STRUCTURE} return 401
        if(!$userPerm){
            return response()->json(['response_code'=>'401','message'=>'user does not have the required permission']);
        }else{
            $companyStructures = CompanyStructure::all();

            //if company structures exist return all
            if($companyStructures){
                return response()->json(['All company sturctures' => $companyStructures,'response_code'=>'200','message'=>'All Company Structures']);
            }else{
                return response()->json(['response_code'=>'401','message'=>'Company structure could not be added, try again or contact admin']);
            }
        }

        
    }
}
