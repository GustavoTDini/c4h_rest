<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Telefone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class TelefoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $telefones = Telefone::all();
            return response()->json([
                'status' => 200,
                'message' => $telefones,
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            if ($request->nome !== null && $request->ddd !== null && $request->numero !== null && $request->userId !== null){
                $telefone = Telefone::create([
                    'id_usuario' =>$request->userId,
                    'nome' => $request->nome,
                    'numero' => $request->numero,
                    'ddd' => $request->ddd,
                ]);
                $telefone->save();
                return response()->json([
                    'status' => 201,
                    'message' => "Telefone Criado",
                ], 201);
            } else{
                return response()->json([
                    'status' => 400,
                    'message' => "Bad request",
                ], 400);

            }
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
     * @param  int  $id
     * @return Response
     */
    public function getById(int $id): JsonResponse
    {
        try {
            $telefone = Telefone::find($id);
            return response()->json([
                'status' => 200,
                'message' => $telefone,
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
     * @param  int  $id
     * @return JsonResponse
     */
    public function getByUser(int $id): JsonResponse
    {
        try {
            $telefones = Telefone::where('id_usuario', $id)
                ->get()->all();
            return response()->json([
                'status' => 200,
                'message' => $telefones,
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
            $telefone = Telefone::find($id);
            if ($request->nome !== null){
                $telefone->nome = $request->nome;
            }
            if ($request->ddd !== null){
                $telefone->ddd = $request->ddd;
            }
            if ($request->numero !== null){
                $telefone->numero = $request->numero;
            }

            $telefone->save();
            return response()->json([
                'status' => 200,
                'message' => "Telefone Alterado!",
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
            $telefone = Telefone::find($id);
            $telefone->delete();
            return response()->json([
                'status' => 200,
                'message' => "Telefone Deletado!",
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
