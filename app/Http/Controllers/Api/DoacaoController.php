<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doacao;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DoacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
{
    try {
        $doacoes = Doacao::all();
        return response()->json([
            'status' => 200,
            'message' => $doacoes,
        ]);
    } catch (\Throwable $th) {
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
            if ($request->valor !== null){
                $doacao = Doacao::create([
                    'id_usuario' =>auth()->user()->getAuthIdentifier(),
                    'valor' => $request->valor,
                ]);
                $doacao->save();
                return response()->json([
                    'status' => 201,
                    'message' => "Doação Enviada",
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
     * @param Request $request
     * @return JsonResponse
     */
    public function getByMonth(int $mes, int $ano): JsonResponse
    {
        try {
            $doacoes = Doacao::whereYear('created_at', '=', $ano)
                ->whereMonth('created_at', '=', $mes)
                ->get()->all();
            return response()->json([
                'status' => 200,
                'message' => $doacoes
            ], 200);
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
     * @return JsonResponse
     */
    public function getByUser(): JsonResponse
    {
        try {
            $id = auth()->user()->getAuthIdentifier();
            $doacoes = Doacao::where('id_usuario', $id)
                ->get()->all();
            return response()->json([
                'status' => 200,
                'message' => $doacoes,
            ], 200);
        } catch (\Throwable $th) {
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
     * @param Doacao $doacao
     * @return Response
     */
    public function update(Request $request, Doacao $doacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Doacao $doacao
     * @return Response
     */
    public function destroy(Doacao $doacao)
    {
        //
    }
}
