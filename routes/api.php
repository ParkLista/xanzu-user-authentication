<?php

use Illuminate\Http\Request;
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


Route::group(['prefix' => 'v1', 'middleware'=> ['api']], function() {
    Route::group(['prefix' => 'user'], function(){
        Route::post('/register', [\App\Http\Controllers\Api\V1\Auth\RegisterUserController::class, 'create']);
        Route::post('/login', [\App\Http\Controllers\Api\V1\Auth\LoginUserController::class, 'login']);

        Route::group(["middleware" => ["auth:api"]], function(){
            Route::group(['prefix' => 'auth'], function(){
                Route::get('/profile', [\App\Http\Controllers\Api\V1\User\UserController::class, 'profile']);
                Route::put('/profile', [\App\Http\Controllers\Api\V1\User\UserController::class, 'updateProfile']);
            });
        });
    });

});

