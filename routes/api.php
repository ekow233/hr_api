<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//api routes 
Route::prefix('/user/v1')->group(function(){
    Route::post('/login', [LoginController::class, 'login']);

    //all routes are protected by the api authentication
    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('/register', [RegisterController::class, 'register']);
        Route::get('/users', [UsersController::class, 'getUsers']);
        Route::post('/deactivate-user', [UsersController::class, 'deactivateUser']);
        Route::post('/logout', [LogoutController::class, 'logout']);
             
    });
    
});
