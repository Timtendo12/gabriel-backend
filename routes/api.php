<?php

use App\Http\Controllers\extraInfo;
use App\Http\Controllers\SwipeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;

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

Route::post('register', [RegistrationController::class, 'store']);
Route::post('login', [LoginController::class, 'doLogin']);

Route::post('authenticate', [LoginController::class, 'tokenLogin']);
Route::post('login/token', [LoginController::class, 'tokenLogin']);

Route::post('logout', [LoginController::class, 'doLogout']);
Route::post('getinfo', [extraInfo::class, 'getExtraInfo']);
Route::post('getuser', [extraInfo::class, 'getUser']);

Route::post('swipe', [SwipeController::class, 'swipe']);
Route::post('getswipes', [SwipeController::class, 'getSwipes']);
Route::get('showuser', [SwipeController::class, 'showUserToSwipe']);


