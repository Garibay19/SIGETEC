<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trabajadores', function (Blueprint $table) {
            $table->id('id_trabajador'); // Llave primaria clara
            $table->string('nombre', 100);
            $table->string('telefono', 20)->nullable();
            $table->string('puesto', 50)->nullable();
            $table->string('area_asignada', 50)->nullable();
            $table->string('estatus', 20)->default('Activo'); // Activo, Inactivo, etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trabajadores');
    }
};
