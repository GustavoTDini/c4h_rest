<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $usuarios = Usuario::all();
            return response()->json([
                'status' => 200,
                'message' => $usuarios,
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        try {
            $usuario = Usuario::find($id);
            return response()->json([
                'status' => 200,
                'message' => $usuario,
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function getCurrentLoggedUser(): JsonResponse
    {
        try {
            $usuario = auth()->user();
            return response()->json([
                'status' => 200,
                'message' => $usuario,
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Check if exists user with login $login
     *
     * @param  string $login
     * @return JsonResponse
     */
    public function findByLogin(string $login): JsonResponse
    {

        try {
            $exist = true;
            $usuario = Usuario::where('login', $login)->first();
            if ($usuario === null) {
                $exist =  false;
            }
            return response()->json([
                'status' => 200,
                'message' => $exist,
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Check if exists user with email $email
     *
     * @param  string $email
     * @return JsonResponse
     */
    public function findByEmail(string $email): JsonResponse
    {
        try {
            $exist = true;
            $usuario = Usuario::where('email', $email)->first();
            if ($usuario === null) {
                $exist =  false;
            }
            return response()->json([
                'status' => 200,
                'message' => $exist,
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Check if exists user with cpf $cpf
     *
     * @param  string $cpf
     * @return JsonResponse
     */
    public function findByCpf(string $cpf): JsonResponse
    {
        try {
            $exist = true;
            $usuario = Usuario::where('cpf', $cpf)->first();
            if ($usuario === null) {
                $exist =  false;
            }
            return response()->json([
                'status' => 200,
                'message' => $exist,
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Check if exists user with cnpj $cnpj
     *
     * @param  string $cnpj
     * @return JsonResponse
     */
    public function findByCnpj(string $cnpj): JsonResponse
    {
        try {
            $exist = true;
            $usuario = Usuario::where('cnpj', $cnpj)->first();
            if ($usuario === null) {
                $exist =  false;
            }
            return response()->json([
                'status' => 200,
                'message' => $exist,
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $usuario = Usuario::find($id);
            if ($request->login !== null){
                $usuario->login = $request->login;
            }
            if ($request->email !== null){
                $usuario->email = $request->email;
            }
            if ($request->senha !== null){
                $usuario->senha = $request->senha;
            }
            if ($request->nome !== null){
                $usuario->nome = $request->nome;
            }
            if ($request->razao_social !== null){
                $usuario->razao_social = $request->razao_social;
            }
            if ($request->cpf !== null){
                $usuario->cpf = $request->cpf;
            }
            if ($request->cnpj !== null){
                $usuario->cnpj = $request->cnpj;
            }
            if ($request->url !== null){
                $usuario->url = $request->url;
            }
            if ($request->dt_nascimento !== null){
                $usuario->dt_nascimento = $request->dt_nascimento;
            }
            if ($request->admin !== null){
                $usuario->admin = $request->admin;
            }
            if ($request->doador !== null){
                $usuario->doador = $request->doador;
            }
            if ($request->assinante !== null){
                $usuario->assinante = $request->assinante;
            }
            if ($request->colaborador !== null){
                $usuario->colaborador = $request->colaborador;
            }
            if ($request->voluntario !== null){
                $usuario->voluntario = $request->voluntario;
            }
            if ($request->foto !== null){
                $usuario->foto = $request->foto;
            }

            $usuario->save();
            return response()->json([
                'status' => 200,
                'message' => "Usuário Alterado!",
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $usuario = Usuario::find($id);
            $usuario->delete();
            return response()->json([
                'status' => 200,
                'message' => "Usuário Deletado!",
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
