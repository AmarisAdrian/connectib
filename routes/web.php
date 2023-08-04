<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;
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
Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('inicio');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('inicio');
    Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'userList'])->name('usuario.userList');
    Route::get('/getState/{id}', [App\Http\Controllers\UserController::class, 'getState'])->name('getState');
    Route::get('/getCity/{id}', [App\Http\Controllers\UserController::class, 'getCity'])->name('getCity');
    Route::post('/guardarusuario', [App\Http\Controllers\UserController::class, 'addUser'])->name('usuario.addUser');
    Route::post('/actualizarusuario', [App\Http\Controllers\UserController::class, 'updateUser'])->name('usuario.updateUser');
    Route::get('/getUser/{id}', [App\Http\Controllers\UserController::class, 'getUser'])->name('usuario.getUser');
    Route::get('/deleteUser/{id}', [App\Http\Controllers\UserController::class, 'deleteUser'])->name('usuario.deleteUser');
});