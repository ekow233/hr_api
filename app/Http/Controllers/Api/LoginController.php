<?php

namespace App\Http\Controllers\Api;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //this function handles all logins from the api
    public function login(Request $request){

        //validate the credential passed by the user
        $login = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //if login attempt is successful
        if(Auth::attempt($login)){

            //if the account is authenticated check to see if the account is
            //inactive log the user out
            if(Auth::user()->status == 0){
                //get the user token
                $user = Auth::user()->token();

                //if user has not logged in before return response
                if($user == null){
                    return response()->json(['response_code'=>'401','message'=>'User has been deactivated']);
                }

                //if user has logged in before revoke the token and return response
                $user->revoke();
                return response()->json(['response_code'=>'401','message'=>'User has been deactivated']);
            }

            //return user type
            $token = Auth::user()->createToken('AuthToken')->accessToken;
            if (auth()->user()->hasRole('Admin')) {

                //get all menus under the admin
                $adminMenu = Module::where([['menu','Admin'],['status','enabled']])->get();
                $employeeMenu = Module::where([['menu','Employees'],['status','enabled']])->get();
                $recruitmentMenu = Module::where([['menu','Recruitment'],['status','enabled']])->get();
                $insightMenu = Module::where([['menu','Insights'],['status','enabled']])->get();
                $systemMenu = Module::where([['menu','System'],['status','enabled']])->get();
                $payrollMenu = Module::where([['menu','Payroll'],['status','enabled']])->get();
                $adminReportMenu = Module::where([['menu','Admin Reports'],['status','enabled']])->get();
                $personalInfoMenu = Module::where([['menu','Personal Information'],['status','enabled']])->get();
                $documentMenu = Module::where([['menu','Documents'],['status','enabled']])->get();
                $financeMenu = Module::where([['menu','Finance'],['status','enabled']])->get();
                $leaveMenu = Module::where([['menu','Leave'],['status','enabled']])->get();
                $performanceMenu = Module::where([['menu','Performance'],['status','enabled']])->get();
                $userReportMenu = Module::where([['menu','User Reports'],['status','enabled']])->get();
                $companyMenu = Module::where([['menu','Company'],['status','enabled']])->get();
                $trainingMenu = Module::where([['menu','Training'],['status','enabled']])->get();
                $travelMgtMenu = Module::where([['menu','Travel Management'],['status','enabled']])->get();
                $imprestMenu = Module::where([['menu','Imprest Management'],['status','enabled']])->get();

                //get admin dashboard
                $dashboard = Module::where('dashboard',1)->get();

                //holds all admin dashboard modules
                $admin_dashboard;

                //get all modules that falls under the admin
                foreach($dashboard as $dash){

                    //get user_levels array for each module
                    $user_levels = json_decode($dash->user_levels);
                    
                    //get all dashboard modules assigned to the admin
                    foreach($user_levels as $user_level){
                        if($user_level == 'Admin'){
                            $admin_dashboard[] = $dash;
                        };
                    }
                }

                //return response
                return response()->json(
                    [ 
                      'user' => Auth::user(), 
                      'token' => $token,
                      'dashboard modules'=>$admin_dashboard,
                      'admin menu' => $adminMenu,
                      'employee menu' => $employeeMenu,
                      'recruitment menu' => $recruitmentMenu,
                      'insight menu' => $insightMenu,
                      'system menu' => $systemMenu,
                      'payroll menu' => $payrollMenu,
                      'admin report menu' => $adminReportMenu,
                      'personal info menu' => $personalInfoMenu,
                      'document menu' => $documentMenu,
                      'finance menu' => $financeMenu,
                      'leave menu' => $leaveMenu,
                      'performance menu' =>$performanceMenu,
                      'user report menu' =>$userReportMenu,
                      'company menu' => $companyMenu,
                      'training menu' => $trainingMenu,
                      'travel management menu' =>$travelMgtMenu,
                      'imprest menu' =>$imprestMenu,
                      'response_code'=>'200','message'=>'redirect to Admin screen'
                    ]
                );
            } else if (auth()->user()->hasRole('Manager')) {
                return response()->json(['user' => Auth::user(), 'token' => $token, 'response_code'=>'200','message'=>'redirect to Manager screen']);
            } else if (auth()->user()->hasRole('Employee')) {
                return response()->json(['user' => Auth::user(), 'token' => $token, 'response_code'=>'200','message'=>'redirect to Employee screen']);
            }else{
                //if user has no role then return with no token
                return response()->json(['user' => Auth::user(), 'response_code'=>'200','message'=>'User has no role']);
            } 
                  
        }else{
            return response()->json(['response_code'=>'401','message'=>'unauthorized user']);
        }

    }

}
