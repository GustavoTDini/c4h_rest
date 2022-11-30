<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Endereco extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'enderecos';

    protected $fillable = [ 'id',  'id_usuario', 'tipo', 'logradouro', 'numero', 'cep', 'complemento', 'bairro', 'cidade', 'estado', 'pais'];

}
