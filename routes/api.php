<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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


Route::prefix('v1')->group(function () {
    Route::post('/auth/login', [AuthController::class, 'login']);
});

Route::prefix('v1')->group(function () {
    Route::post('/users', [UserController::class, 'store']);
});

Route::group(['middleware' => ['firebase.auth', 'role:ADMIN, role:MANAGER'], 'prefix' => 'v1'], function () {
    Route::post('/users', [UserController::class, 'store']);
});

Route::group(['middleware' => ['firebase.auth', 'role:ADMIN'], 'prefix' => 'v1'], function () {
    Route::post('/roles', [RoleController::class, 'store']);
    Route::get('/roles', [RoleController::class, 'index']);
    Route::get('/users', [UserController::class, 'index']);
});


/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
