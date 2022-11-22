<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RedesSociais;
use App\Models\TipoRede;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class RedesSociaisController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $redeSociais = RedesSociais::all();
            $redeSociaisJson = [];
            foreach ($redeSociais as $redeSocial){
                $id_tipo = $redeSocial->id_rede;
                $tipo_rede = TipoRede::find($id_tipo);
                $redeSocial->nome_tipo_rede = $tipo_rede->nome;
                $redeSocial->logo_rede = $tipo_rede->logo;
                array_push($redeSociaisJson, $redeSocial);
            }
            return response()->json([
                'status' => 200,
                'message' => $redeSociaisJson,
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
            if ($request->url !== null && $request->id_rede !== null) {
                $id = auth()->user()->getAuthIdentifier();
                $redeSocial = RedesSociais::create([
                    'id_usuario' =>$id,
                    'id_rede' => $request->nome,
                    'url' => $request->url,
                ]);
                $redeSocial->save();
                return response()->json([
                    'status' => 201,
                    'message' => "Rede Social Criada",
                ], 201);
            } else {
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
     * @param \App\Models\RedesSociais $redeSocial
     * @return \Illuminate\Http\Response
     */
    public function getById(int $id): JsonResponse
    {
        try {
            $redeSocial = RedesSociais::find($id);
            return response()->json([
                'status' => 200,
                'message' => $redeSocial,
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
            $redeSociais = RedesSociais::where('id_usuario', $id)
                ->get()->all();
            $redeSociaisJson = [];
            foreach ($redeSociais as $redeSocial){
                $id_tipo = $redeSocial->id_rede;
                $tipo_rede = TipoRede::find($id_tipo);
                $redeSocial->nome_tipo_rede = $tipo_rede->nome;
                $redeSocial->logo_rede = $tipo_rede->logo;
                array_push($redeSociaisJson, $redeSocial);
            }
            return response()->json([
                'status' => 200,
                'message' => $redeSociaisJson,
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
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $redeSocial = RedesSociais::find($id);
            if ($request->nome !== null) {
                $redeSocial->nome = $request->nome;
            }
            if ($request->ddd !== null) {
                $redeSocial->ddd = $request->ddd;
            }
            if ($request->numero !== null) {
                $redeSocial->numero = $request->numero;
            }

            $redeSocial->save();
            return response()->json([
                'status' => 200,
                'message' => "Rede Social Alterado!",
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
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $redeSocial = RedesSociais::find($id);
            $redeSocial->delete();
            return response()->json([
                'status' => 200,
                'message' => "Rede Social Deletado!",
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
