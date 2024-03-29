<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DownloadController;
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
Route::post('user/{id}', [UserController::class, 'update']);
Route::post('user/delete/{id}', [UserController::class, 'destroy']);

Route::get('role', [UserRoleController::class, 'index']);
Route::get('role/{id}', [UserRoleController::class, 'getDetail']);
Route::post('role', [UserRoleController::class, 'create']);
Route::post('role/{id}', [UserRoleController::class, 'update']);
Route::post('role/delete/{id}', [UserRoleController::class, 'destroy']);

Route::get('/download/brocure', [DownloadController::class, 'brocure']);
Route::get('/download/compro', [DownloadController::class, 'compro']);
Route::get('/download/poclia', [DownloadController::class, 'poclia']);
