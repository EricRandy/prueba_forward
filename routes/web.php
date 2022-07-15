<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::resource('tareas', App\Http\Controllers\TareaController::class)->middleware('auth');
Route::resource('equipos', App\Http\Controllers\EquipoController::class)->middleware('auth');
Route::resource('usuarios', App\Http\Controllers\UsuarioController::class)->middleware('auth');
Route::resource('equipo-tarea', App\Http\Controllers\EquipoTareaController::class)->middleware('auth');
Route::resource('usuario-equipo', App\Http\Controllers\UsuarioEquipoController::class)->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cards', [App\Http\Controllers\HomeController::class, 'cards'])->name('cards');
Route::get('/getCards', [App\Http\Controllers\HomeController::class, 'getCardsUser'])->name('getCards');

