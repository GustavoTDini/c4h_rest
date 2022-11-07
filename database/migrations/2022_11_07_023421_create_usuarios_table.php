<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('login')->unique();
            $table->string('email')->unique();
            $table->string('senha');
            $table->string('nome')->default("");
            $table->string('razao_social')->default("");
            $table->string('cpf')->nullable()->default(null)->unique();
            $table->string('cnpj')->nullable()->default(null)->unique();
            $table->string('url')->default("");
            $table->date(  'dt_nascimento')->nullable()->default(null);
            $table->boolean('admin')->default(false);
            $table->boolean('doador')->default(false);
            $table->boolean('assinante')->default(false);
            $table->boolean('colaborador')->default(false);
            $table->boolean('voluntario')->default(false);
            $table->binary('foto')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
