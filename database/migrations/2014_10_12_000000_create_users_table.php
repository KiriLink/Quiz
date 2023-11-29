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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('rut',13)->unique()->default("");
            $table->string('name',43);
            $table->string('apellido_paterno',35)->default("");
            $table->string('apellido_materno',35)->default("");
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('ruta_foto')->default("assets/profile.png");
            $table->date('anio_actual')->nullable();
            $table->integer('horario')->default(0);
            $table->integer('estado')->default(0);
            $table->integer('tipo_usu')->default(0);
            $table->rememberToken();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
