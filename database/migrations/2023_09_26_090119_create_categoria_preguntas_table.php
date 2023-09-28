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
        Schema::create('categoria_preguntas', function (Blueprint $table) {
            $table->id('id_categoria_preguntas');
            $table->unsignedBigInteger('fk_pregunta');
            $table->string('area', 50);
            $table->string('categoria', 50);
            $table->foreign('fk_pregunta')->references('id_preguntas')->on('preguntas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_preguntas');
    }
};
