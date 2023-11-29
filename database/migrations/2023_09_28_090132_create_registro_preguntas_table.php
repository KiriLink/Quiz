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
        Schema::create('registro_preguntas', function (Blueprint $table) {
            $table->id('id_registro_preguntas');
            $table->unsignedBigInteger('fk_usuario');
            $table->unsignedBigInteger('fk_pregunta');
            $table->string('respuesta',25);
            $table->integer('desafio')->default(0);
            $table->integer('estado');
            $table->foreign('fk_usuario')->references('id')->on('users');
            $table->foreign('fk_pregunta')->references('id_preguntas')->on('preguntas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_preguntas');
    }
};
