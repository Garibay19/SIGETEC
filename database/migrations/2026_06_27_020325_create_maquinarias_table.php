<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maquinarias', function (Blueprint $table) {
            $table->id('id_maquinaria'); // Llave primaria
            $table->string('nombre_maquina', 100); // Ejemplo: Máquina Recta
            $table->string('marca', 50)->nullable(); // Ejemplo: Juki
            $table->string('modelo', 50)->nullable(); // Ejemplo: DDL-8700
            $table->string('estatus', 50)->default('Operando'); // Operando, En reparación, etc.
            $table->date('fecha_adquisicion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maquinarias');
    }
};
