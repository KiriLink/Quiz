<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuario_registros', function (Blueprint $table) {
            $table->id('id_usuarios_registro');
            $table->unsignedBigInteger('fk_usuario');
            $table->integer('preguntas_normales_acierto');
            $table->integer('preguntas_normales_fallos');
            $table->integer('preguntas_dificiles_aciertos');
            $table->integer('preguntas_dificiles_fallos');
            $table->integer('desafio_max');
            $table->integer('estado');
            $table->foreign('fk_usuario')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_registros');
    }
};
