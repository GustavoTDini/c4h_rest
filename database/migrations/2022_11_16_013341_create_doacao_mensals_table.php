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
        Schema::create('doacao_mensals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->references("id")->on("usuarios");
            $table->unsignedFloat('valor');
            $table->unsignedInteger('dia');
            $table->boolean('ativa');
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
        Schema::dropIfExists('doacao_mensals');
    }
};
