<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;

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


Route::post('register',[AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::post('refresh', [AuthController::class,'refresh']);
Route::post('logout', [AuthController::class,'logout']);

Route::get('user', [UserController::class, 'index']);
Route::get('user/{id}', [UserController::class, 'getDetail']);

Route::get('role', [UserRoleController::class, 'index']);
Route::get('role/{id}', [UserRoleController::class, 'getDetail']);
Route::post('role', [UserRoleController::class, 'create']);
Route::post('role/{id}', [UserRoleController::class, 'update']);
Route::post('role/delete/{id}', [UserRoleController::class, 'destroy']);
