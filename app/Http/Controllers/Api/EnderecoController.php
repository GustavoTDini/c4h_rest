<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Endereco;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $enderecos = Endereco::all();
            return response()->json([
                'status' => 200,
                'message' => $enderecos,
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
            if ($request->tipo !== null && $request->logradouro !== null && $request->numero !== null
                && $request->cep !== null && $request->bairro !== null && $request->cidade !== null
                && $request->estado !== null && $request->pais !== null && $request->userId){
                $endereco = Endereco::create([
                    'id_usuario' =>$request->userId,
                    'tipo' => $request->tipo,
                    'logradouro' => $request->logradouro,
                    'numero' => $request->numero,
                    'cep' => $request->cep,
                    'complemento' => $request->complemento,
                    'bairro' => $request->bairro,
                    'cidade' => $request->cidade,
                    'estado' => $request->estado,
                    'pais' => $request->pais,
                ]);
                $endereco->save();
                return response()->json([
                    'status' => 201,
                    'message' => "Endereço Criado",
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getById(int $id): JsonResponse
    {
        try {
            $endereco = Endereco::find($id);
            return response()->json([
                'status' => 200,
                'message' => $endereco,
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
            $enderecos = Endereco::where('id_usuario', $id)
                ->get()->all();
            return response()->json([
                'status' => 200,
                'message' => $enderecos,
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
            $endereco = Endereco::find($id);
            if ($request->nome !== null){
                $endereco->nome = $request->nome;
            }
            if ($request->logradouro !== null){
                $endereco->logradouro = $request->logradouro;
            }
            if ($request->numero !== null){
                $endereco->numero = $request->numero;
            }
            if ($request->cep !== null){
                $endereco->cep = $request->cep;
            }
            if ($request->complemento !== null){
                $endereco->complemento = $request->complemento;
            }
            if ($request->bairro !== null){
                $endereco->bairro = $request->bairro;
            }
            if ($request->cidade !== null){
                $endereco->cidade = $request->cidade;
            }
            if ($request->estado !== null){
                $endereco->estado = $request->estado;
            }
            if ($request->pais !== null){
                $endereco->pais = $request->pais;
            }

            $endereco->save();
            return response()->json([
                'status' => 200,
                'message' => "Endereço Alterado!",
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
            $endereco = Endereco::find($id);
            $endereco->delete();
            return response()->json([
                'status' => 200,
                'message' => "Endereço Deletado!",
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
