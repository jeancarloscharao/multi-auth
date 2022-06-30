<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DpoController;

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

Route::get('/', function(){ return view('index'); })->name('home');

Route::get('/usuarios/login', [UsuarioController::class, 'login'])->name('usuarios.login');
Route::post('/usuarios/logar', [UsuarioController::class, 'logar'])->name('usuarios.logar');
Route::post('/usuarios/logout', [UsuarioController::class, 'logout'])->name('usuarios.logout');
Route::get('/usuarios/dashboard', [UsuarioController::class, 'dashboard'])->name('usuarios.dashboard')->middleware('auth');

Route::get('/clientes/login', [ClienteController::class, 'login'])->name('clientes.login');
Route::post('/clientes/logar', [ClienteController::class, 'logar'])->name('clientes.logar');
Route::post('/clientes/logout', [ClienteController::class, 'logout'])->name('clientes.logout');
Route::get('/clientes/dashboard', [ClienteController::class, 'dashboard'])->name('clientes.dashboard')->middleware('auth.cliente');

