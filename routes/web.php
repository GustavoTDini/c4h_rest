<?php

use App\Http\Controllers\Api\UsuarioController;
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

//Rotas do usuario
Route::get('/usuario', [UsuarioController::class, 'index']);
Route::post('/addUsuario', [UsuarioController::class, 'store']);
Route::delete('/usuario/{id}', [UsuarioController::class, 'destroy']);
Route::patch('/usuario/{id}', [UsuarioController::class, 'update']);
Route::get('/usuario/{id}', [UsuarioController::class, 'getById']);
Route::get('/usuario/login/{login}', [UsuarioController::class, 'findByLogin']);
Route::get('/usuario/email/{email}', [UsuarioController::class, 'findByEmail']);
Route::get('/usuario/cpf/{cpf}', [UsuarioController::class, 'findByCpf']);
Route::get('/usuario/cnpj/{cnpj}', [UsuarioController::class, 'findByCnpj']);

//Rotas de Authenticação
