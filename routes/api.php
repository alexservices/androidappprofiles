<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoadUser;
use App\Http\Controllers\UserController;

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

Route::post('/load_data', [LoadUser::class, 'load_data']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/listar_usuarios', [UserController::class, 'listar_usuarios']);
Route::get('/consultar_usuario', [UserController::class, 'consultar_usuario']);
Route::post('/edit_user', [UserController::class, 'edit']);