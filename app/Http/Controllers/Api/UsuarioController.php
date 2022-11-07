<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $usuarios = Usuario::all();

        return response($usuarios);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $usuario = new Usuario;
        $jsonRequest = json_decode($request->getContent());
        $usuario->login = $jsonRequest->login;
        $usuario->email = $jsonRequest->email;
        $usuario->senha = Hash::make($jsonRequest->senha);
        if ($jsonRequest->cpf == null){
            $usuario->cnpj = $jsonRequest->cnpj;
        } else{
            $usuario->cpf = $jsonRequest->cpf;
        }

        $usuario->save();

        return response($usuario)->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function getById(int $id): Response
    {
        $usuario = Usuario::find($id);

        return response($usuario);
    }

    /**
     * Check if exists user with login $login
     *
     * @param  string $login
     * @return Response
     */
    public function findByLogin(string $login): Response
    {
        $exist = true;
        $usuario = Usuario::where('login', $login)->first();
        if ($usuario === null) {
            $exist =  false;
        }
        return response(json_encode($exist));
    }

    /**
     * Check if exists user with email $email
     *
     * @param  string $email
     * @return Response
     */
    public function findByEmail(string $email): Response
    {
        $exist = true;
        $usuario = Usuario::where('email', $email)->first();
        if ($usuario === null) {
            $exist =  false;
        }
        return response(json_encode($exist));
    }

    /**
     * Check if exists user with cpf $cpf
     *
     * @param  string $cpf
     * @return Response
     */
    public function findByCpf(string $cpf): Response
    {
        $exist = true;
        $usuario = Usuario::where('cpf', $cpf)->first();
        if ($usuario === null) {
            $exist =  false;
        }
        return response(json_encode($exist));
    }

    /**
     * Check if exists user with cnpj $cnpj
     *
     * @param  string $cnpj
     * @return Response
     */
    public function findByCnpj(string $cnpj): Response
    {
        $exist = true;
        $usuario = Usuario::where('cnpj', $cnpj)->first();
        if ($usuario === null) {
            $exist =  false;
        }
        return response(json_encode($exist));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, int $id)
    {
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

        return Response($usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $usuario = Usuario::find($id);
        $usuario->delete();

        return Response($id);
    }
}
