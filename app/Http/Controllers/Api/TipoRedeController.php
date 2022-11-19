<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoRede;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class TipoRedeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $tiposRede = TipoRede::all();
            return response()->json([
                'status' => 200,
                'message' => $tiposRede,
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
            if ($request->nome !== null && $request->logo !== null ){
                $tipoRede = TipoRede::create([
                    'nome' => $request->nome,
                    'logo' => $request->logo,
                ]);
                $tipoRede->save();
                return response()->json([
                    'status' => 201,
                    'message' => "Tipo de Rede Criado",
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
     * Display the specified resource.
     *
     * @param  \App\Models\TipoRede  $tipoRede
     * @return \Illuminate\Http\Response
     */
    public function getById(int $id): JsonResponse
    {
        try {
            $tipoRede = TipoRede::find($id);
            return response()->json([
                'status' => 200,
                'message' => $tipoRede,
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
            $tipoRede = TipoRede::find($id);
            if ($request->nome !== null){
                $tipoRede->nome = $request->nome;
            }
            if ($request->logo !== null){
                $tipoRede->logo = $request->logo;
            }

            $tipoRede->save();
            return response()->json([
                'status' => 200,
                'message' => "Tipo de Rede Alterado!",
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
            $tipoRede = TipoRede::find($id);
            $tipoRede->delete();
            return response()->json([
                'status' => 200,
                'message' => "Tipo de Rede Deletado!",
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
