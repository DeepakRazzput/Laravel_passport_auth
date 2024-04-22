<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//open routes

Route::get('/employees', [ApiController::class,"getEmployees"]);
Route::post('register',[ApiController::class,"register"]);
Route::post('login',[ApiController::class,"login"]);

//protect

Route::group(["middleware"=>["auth:api"]],function(){
    Route::get('profile',[ApiController::class,"profile"]);
    Route::get('logout',[ApiController::class,"logout"]);

});
