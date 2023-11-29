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
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id('id_preguntas');
            $table->unsignedBigInteger('fk_categoria');
            $table->unsignedBigInteger('fk_usuario');
            $table->text('pregunta');
            $table->string('respuesta_correcta');
            $table->string('respuesta_2');
            $table->string('respuesta_3');
            $table->string('respuesta_4');
            $table->text('retroalimentacion_positiva');
            $table->text('retroalimentacion_negativa');
            $table->integer('dificultad');
            $table->foreign('fk_categoria')->references('id_categoria_preguntas')->on('categoria_preguntas');
            $table->foreign('fk_usuario')->references('id')->on('users');
            $table->integer('estado')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntas');
    }
};
