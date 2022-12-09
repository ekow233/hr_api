<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AppHelper;
use App\Models\Module;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ModulesController extends Controller
{
    protected $module;
    public function __construct(Module $module){
        $this->module = $module;
    }

    //method to get all modules in the database
    public function getModules(Request $request){
        // $modules = $this->module->getsModule();

        //check if the user has permission to view modules
        // $userPerm = AppHelper::instance()->checkViewModulesPerm($request->id);

        //if user does not have the permission {VIEW USERS} return 401
        // if(!$userPerm){
        //     return response()->json(['response_code1'=>'401','message'=>'user does not have the required permission']);
        // }

        $modules = DB::table('modules')->get();
        if(count($modules)){
            return response()->json(['response_code'=>200, 'message'=>'data found', 'data' => $modules]);
        }
        return response()->json(['data'=>null, 'response_code'=>404, 'message'=>'no data available']);

        // if(count($modules)> 0){
        //     return response()->json(['data' => $modules,'response_code'=>200,'message'=>'data found']);
        // }
        // else{
        //     return response()->json(['response_code'=>404, 'message'=>'no data found']);
        // }
        
    }

    //return module details by the id specified
    public function getModuleById($id){
        // $module = $this->module->getModule($id);
        $module = DB::table('modules')->where('id',$id)->get();
        
        $test = Module::where('id',$id)->get('user_levels');
        // return $test1 = JSON.parse($test);
        // return $result = json_encode($module->user_levels);

        if($module){
            return response()->json(['message' =>'data found','response_code'=>200,'user_level'=>null,'data'=>$module]);
        }
        else{
            return response()->json([ 'response_code' =>404,'message'=>'no module details found']);
        }
    }

    //method to add new module to the database
    public function addModule(Request $request){
        $module = new Module;
        
        $validator = Validator::make($request->all(),[
            "menu" => 'required',
            "name" => 'required',
            "label" => 'required',
            "icon" => 'required',
            "mod_group" => 'required',
            "mod_order" => 'required',
            "status" => 'required',
            "version" => 'required',
            "update_path" => 'required',
            "user_levels" => 'required',
            "user_roles" => "required",
            "user_roles_blacklist" => 'required'
            ]);
    }

    

}
