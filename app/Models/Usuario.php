<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
    use HasFactory;

    use SoftDeletes;

//    public mixed $login;
//    public mixed $email;
//    /**
//     * @var mixed|string
//     */
//    public mixed $senha;
//    public mixed $cnpj;
//    public mixed $cpf;
    protected $fillable = [ 'login', 'email', 'senha', 'nome', 'razao_social', 'cpf', 'cnpj', 'url', 'dt_nascimento',
                            'admin', 'doador', 'assinante', 'colaborador', 'voluntario', 'foto'];
    //protected $hidden = ['senha'];
}

