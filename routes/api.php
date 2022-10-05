<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
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
    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('/register', [RegisterController::class, 'register']);
    });
    
});
