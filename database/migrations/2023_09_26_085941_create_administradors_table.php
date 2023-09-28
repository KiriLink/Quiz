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
        Schema::create('administradors', function (Blueprint $table) {
            $table->id('id_administrador');
            $table->string('rut',13)->unique();
            $table->string('correo',60)->unique();
            $table->string('nombre',43);
            $table->string('apellido_paterno',35);
            $table->string('apellido_materno',35);
            $table->binary('contrasena');
            $table->string('ruta_foto');
            $table->integer('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administradors');
    }
};
