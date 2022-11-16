<?php

use App\Http\Controllers\Api\DoacaoController;
use App\Http\Controllers\Api\DoacaoMensalController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

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

//Rotas do usuario

Route::delete('/usuario/{id}', [UsuarioController::class, 'destroy']);
Route::patch('/usuario/{id}', [UsuarioController::class, 'update']);
Route::get('/usuario/{id}', [UsuarioController::class, 'getById']);
Route::get('/usuario/login/{login}', [UsuarioController::class, 'findByLogin']);
Route::get('/usuario/email/{email}', [UsuarioController::class, 'findByEmail']);
Route::get('/usuario/cpf/{cpf}', [UsuarioController::class, 'findByCpf']);
Route::get('/usuario/cnpj/{cnpj}', [UsuarioController::class, 'findByCnpj']);

//Rotas de Autenticação
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {

    // Rotas do usuario e autenticação restritas
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/usuario', [UsuarioController::class, 'index']);

    // Rotas de doaçoes restritas
    Route::get('/doacoes', [DoacaoController::class, 'index']);
    Route::post('/doacoes', [DoacaoController::class, 'create']);
    Route::get('/doacoes/mes/{mes}&{ano}', [DoacaoController::class, 'getByMonth']);
    Route::get('/doacoes/usuario', [DoacaoController::class, 'getByUser']);
    Route::delete('/doacoes/{id}', [DoacaoController::class, 'destroy']);
    Route::patch('/doacoes/{id}', [DoacaoController::class, 'update']);

    // Rotas de doaçoes Mensais restritas
    Route::get('/doacoesMensais', [DoacaoMensalController::class, 'index']);
    Route::post('/doacoesMensais', [DoacaoMensalController::class, 'create']);
    Route::get('/doacoesMensais/usuario', [DoacaoMensalController::class, 'getByUser']);
    Route::delete('/doacoesMensais/{id}', [DoacaoMensalController::class, 'destroy']);
    Route::patch('/doacoesMensais/{id}', [DoacaoMensalController::class, 'update']);
});
