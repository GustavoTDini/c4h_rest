<?php

use App\Http\Controllers\Api\DoacaoController;
use App\Http\Controllers\Api\DoacaoMensalController;
use App\Http\Controllers\Api\EnderecoController;
use App\Http\Controllers\Api\RedesSociaisController;
use App\Http\Controllers\Api\TelefoneController;
use App\Http\Controllers\Api\TipoRedeController;
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
Route::get('/usuario/login/{login}', [UsuarioController::class, 'findByLogin']);
Route::get('/usuario/email/{email}', [UsuarioController::class, 'findByEmail']);
Route::get('/usuario/cpf/{cpf}', [UsuarioController::class, 'findByCpf']);
Route::get('/usuario/cnpj/{cnpj}', [UsuarioController::class, 'findByCnpj']);

//Rotas de Autenticação
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

//Middleware de autenticação
Route::middleware(['auth:sanctum'])->group(function () {

    // Rotas do usuario e autenticação restritas
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/usuario', [UsuarioController::class, 'index']);
    Route::get('/usuario_logged', [UsuarioController::class, 'getCurrentLoggedUser']);
    Route::delete('/usuario/{id}', [UsuarioController::class, 'destroy']);
    Route::patch('/usuario/{id}', [UsuarioController::class, 'update']);
    Route::get('/usuario/{id}', [UsuarioController::class, 'getById']);

    // Rotas de doaçoes restritas
    Route::get('/doacoes', [DoacaoController::class, 'index']);
    Route::post('/doacoes', [DoacaoController::class, 'create']);
    Route::get('/doacoes/{id}', [DoacaoController::class, 'getById']);
    Route::get('/doacoes_mes/{mes}&{ano}', [DoacaoController::class, 'getByMonth']);
    Route::get('/doacoes_usuario', [DoacaoController::class, 'getByUser']);
    Route::delete('/doacoes/{id}', [DoacaoController::class, 'destroy']);
    Route::patch('/doacoes/{id}', [DoacaoController::class, 'update']);

    // Rotas de doaçoes Mensais restritas
    Route::get('/doacoesMensais', [DoacaoMensalController::class, 'index']);
    Route::post('/doacoesMensais', [DoacaoMensalController::class, 'create']);
    Route::get('/doacoesMensais/{id}', [DoacaoMensalController::class, 'getById']);
    Route::get('/doacoesMensais_usuario', [DoacaoMensalController::class, 'getByUser']);
    Route::delete('/doacoesMensais/{id}', [DoacaoMensalController::class, 'destroy']);
    Route::patch('/doacoesMensais/{id}', [DoacaoMensalController::class, 'update']);

    // Rotas de Telefones restritas
    Route::get('/telefone', [TelefoneController::class, 'index']);
    Route::post('/telefone', [TelefoneController::class, 'create']);
    Route::get('/telefone_usuario/{id}', [TelefoneController::class, 'getByUser']);
    Route::get('/telefone/{id}', [TelefoneController::class, 'getById']);
    Route::delete('/telefone/{id}', [TelefoneController::class, 'destroy']);
    Route::patch('/telefone/{id}', [TelefoneController::class, 'update']);

    // Rotas de Endereços restritas
    Route::get('/endereco', [EnderecoController::class, 'index']);
    Route::post('/endereco', [EnderecoController::class, 'create']);
    Route::get('/endereco_usuario/{id}', [EnderecoController::class, 'getByUser']);
    Route::get('/endereco/{id}', [EnderecoController::class, 'getById']);
    Route::delete('/endereco/{id}', [EnderecoController::class, 'destroy']);
    Route::patch('/endereco/{id}', [EnderecoController::class, 'update']);

    // Rotas de RodesSociais restritas
    Route::get('/rede', [RedesSociaisController::class, 'index']);
    Route::post('/rede', [RedesSociaisController::class, 'create']);
    Route::get('/rede_usuario/{id}', [RedesSociaisController::class, 'getByUser']);
    Route::get('/rede/{id}', [RedesSociaisController::class, 'getById']);
    Route::delete('/rede/{id}', [RedesSociaisController::class, 'destroy']);
    Route::patch('/rede/{id}', [RedesSociaisController::class, 'update']);

    // Rotas de RodesSociais restritas
    Route::get('/rede_tipo', [TipoRedeController::class, 'index']);
    Route::post('/rede_tipo', [TipoRedeController::class, 'create']);
    Route::get('/rede_tipo/{id}', [TipoRedeController::class, 'getById']);
    Route::delete('/rede_tipo/{id}', [TipoRedeController::class, 'destroy']);
    Route::patch('/rede_tipo/{id}', [TipoRedeController::class, 'update']);

});
