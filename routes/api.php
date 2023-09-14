<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('v1')->group(function() {
    //Auth API
    Route::prefix('auth')->group(function() {
        Route::post('login', [App\Http\Controllers\AuthController::class, 'login'])->name('api.login');
        Route::post('register', [App\Http\Controllers\AuthController::class, 'register'])->name('api.register');
    });
    Route::get('/quote', [App\Http\Controllers\UserController::class, 'quote'])->name('user.quote');
    
    //Auth Required    
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('transaction', [App\Http\Controllers\UserController::class, 'transaction'])->name('user.transaction');
        Route::get('transaction/get', [App\Http\Controllers\UserController::class, 'getTransaction'])->name('user.transaction.details');
    });
});
