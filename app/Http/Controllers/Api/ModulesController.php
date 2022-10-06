<?php

namespace App\Http\Controllers\Api;
use App\Models\Module;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModulesController extends Controller
{
    protected $module;
    public function __construct(Module $module){
        $this->module = $module;
    }

    //method to get all modules in the database
    public function gets(){
        $modules = $this->module->getsModule();

        if(count($modules)> 0){
            return response()->json(['data' => $modules,'response_code'=>200,'message'=>'data found']);
        }
        else{
            return response()->json(['response_code'=>404, 'message'=>'no data found']);
        }
        
    }

    //return module details by the id specified
    public function get($id){
        $module = $this->module->getModule($id);

        if($module){
            return response()->json(['data'=>$module, 'response_code'=>200, 'message' =>'data found']);
        }
        else{
            return response()->json([ 'response_code' =>404,'message'=>'no module details not found']);
        }
    }

    

}
