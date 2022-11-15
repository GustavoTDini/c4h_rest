<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * create a new User
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        try {
            if ($request->login !== null && $request->email !== null && $request->senha !== null &&
                (($request->cpf === null && $request->cnpj !== null) || ($request->cpf !== null && $request->cnpj === null))){
                $usuario = Usuario::create([
                    'login' => $request->login,
                    'email' => $request->email,
                    'senha' => Hash::make($request->senha),
                    'cnpj' => $request->cnpj,
                    'cpf' => $request->cpf,
                ]);
                $usuario->save();
                return response()->json([
                    'status' => 201,
                    'message' => "Usuário Criado",
                ], 201);
            } else{
                return response()->json([
                    'status' => 400,
                    'message' => "Bad request",
                ], 400);

            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    /**
     * Handle an incoming authentication request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        try {
            if ($request->login !== null && $request->senha !== null){
                $usuario = Usuario::where('login', $request->login)->first();
                if ( $usuario !== null && Hash::check($request->senha, $usuario->senha)) {
                    $token = $usuario->createToken("API TOKEN")->plainTextToken;
                    return response()->json([
                        'status' => 202,
                        'message' => "Usuario Logado com sucesso!",
                        'token'=> $token
                    ], 202);

                } else {
                    return response()->json([
                        'status' => 401,
                        'message' => "Login ou senha não existentes",
                    ], 401);
                }
            } else{
                return response()->json([
                    'status' => 400,
                    'message' => "Bad request",
                ], 400);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        try {
            auth()->user()->tokens()->delete();
            Auth::guard('api')->logout();
            return response()->json([
                'status' => 200,
                'message' => "Usuario saiu com sucesso!",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
