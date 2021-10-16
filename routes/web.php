<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoadUser;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PuestoLaboralController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('perfiles', [PuestoLaboralController::class, 'index'])->name('perfiles.index');
Route::resource('user',UserController::class);
