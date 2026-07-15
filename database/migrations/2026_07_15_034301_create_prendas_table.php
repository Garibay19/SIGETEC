<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prendas', function (Blueprint $table) {
            $table->id('id_prenda'); 
            $table->string('nombre_prenda', 150); 
            $table->string('categoria', 100)->nullable(); 
            $table->string('talla', 20)->nullable(); 
            $table->integer('stock_disponible')->default(0); 
            $table->string('imagen', 255)->nullable(); // NUEVO: Guarda la ruta de la foto de la prenda
            $table->string('estatus', 50)->default('Diseño Nuevo'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prendas');
    }
};
