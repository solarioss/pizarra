<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\sessionController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('singup',[userController::class,'singup'])->name('crearUsuario');
Route::post('login',[userController::class,'login'])->name('loginUsuario');
Route::post('create',[sessionController::class,'createSession'])->name('create');
Route::post('restore',[sessionController::class,'SessionSored'])->name('recuperar');
Route::post('unirse',[sessionController::class,'SessionJoin'])->name('unirse');
Route::post('buscar',[sessionController::class,'SessionSearch'])->name('buscar');

Route::post('guardar',[sessionController::class,'SessionGuardarSesion'])->name('guardarSesion');
Route::post('antiguo',[sessionController::class,'BorrarAntiguo'])->name('borrarAntiguo');
Route::post('nuevo',[sessionController::class,'AgregarCuadro'])->name('nuevo');
Route::post('recuperarCuadros',[sessionController::class,'RestaurarCuadros'])->name('recuperarCuadros');