<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doacao;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

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
            if ($request->valor !== null){
                $id = auth()->user()->getAuthIdentifier();
                $doacao = Doacao::create([
                    'id_usuario' =>$id,
                    'valor' => $request->valor,
                ]);
                Usuario::where('id', $id)->update(['doador' => true]);
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getById(int $id): JsonResponse
    {
        try {
            $doacao = Doacao::find($id);
            return response()->json([
                'status' => 200,
                'message' => $doacao,
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
    public function getByUser(): JsonResponse
    {
        try {
            $id = auth()->user()->getAuthIdentifier();
            $doacoes = Doacao::where('id_usuario', $id)
                ->get()->all();
            return response()->json([
                'status' => 200,
                'message' => $doacoes,
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
    public function update(Request $request, int $id)
    {
        try {
            $doacao = Doacao::find($id);
            if ($request->valor !== null){
                $doacao->valor = $request->valor;
            }
            $doacao->save();
            return response()->json([
                'status' => 200,
                'message' => "Doação Alterada!",
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
    public function destroy(int $id)
    {
        try {
            $doacao = Doacao::find($id);
            $doacao->delete();
            return response()->json([
                'status' => 200,
                'message' => "Doação Deletada!",
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
