<?php

use App\Http\Controllers\AuthController;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// public route without need to authenticate to access it
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


//use 'auth' middleware from laravel sanctum for authentication
Route::middleware('auth:sanctum')->group(function(){
    Route::get('user', [AuthController::class, 'user']);
});

