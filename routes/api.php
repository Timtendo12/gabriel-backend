<?php

use App\Http\Controllers\extraInfo;
use Illuminate\Http\Request;
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
Route::post('login/token', [LoginController::class, 'tokenLogin']);

Route::get('logout', [LoginController::class, 'doLogout']);
Route::get('getInfo/{id}', [extraInfo::class, 'getExtraInfo']);

Route::post('swipe', [\App\Http\Controllers\SwipeController::class, 'swipe']);
Route::post('get-swipes', [\App\Http\Controllers\SwipeController::class, 'getSwipes']);
Route::get('showUser', [\App\Http\Controllers\SwipeController::class, 'showUserToSwipe']);


