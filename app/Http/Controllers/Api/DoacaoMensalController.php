<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DoacaoMensal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class DoacaoMensalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $doacoesMensais = DoacaoMensal::where('ativa', true)->orderBy('dia', 'asc')->get()->all();
            return response()->json([
                'status' => 200,
                'message' => $doacoesMensais,
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
            if ($request->valor !== null && $request->dia !== null){
                $id = auth()->user()->getAuthIdentifier();
                $doacaoAtual = DoacaoMensal::where('id_usuario', $id)->first();
                if ($doacaoAtual !== null) {
                    $doacaoAtual->ativa = false;
                    $doacaoAtual->save();
                }
                $doacao = DoacaoMensal::create([
                    'id_usuario' => $id,
                    'valor' => $request->valor,
                    'dia' => $request->dia,
                    'ativa' => true
                ]);
                $doacao->save();
                return response()->json([
                    'status' => 201,
                    'message' => "Doação Programada",
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
     * @return JsonResponse
     */
    public function getByUser(): JsonResponse
    {
        try {
            $id = auth()->user()->getAuthIdentifier();
            $doacaoMensal = DoacaoMensal::where('id_usuario', $id)->where('ativa', true)
                ->get()->first();
            return response()->json([
                'status' => 200,
                'message' => $doacaoMensal,
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $doacaoMensal = DoacaoMensal::find($id);
            if ($request->valor !== null){
                $doacaoMensal->valor = $request->valor;
            }
            if ($request->dia !== null){
                $doacaoMensal->dia = $request->dia;
            }
            if ($request->ativa !== null){
                $doacaoMensal->ativa = $request->ativa;
            }
            $doacaoMensal->save();
            return response()->json([
                'status' => 200,
                'message' => "Doação Mensal Alterada!",
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
            $doacaoMensal = DoacaoMensal::find($id);
            $doacaoMensal->delete();
            return response()->json([
                'status' => 200,
                'message' => "Doação Mensal Apagada!",
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
