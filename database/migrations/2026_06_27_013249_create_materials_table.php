<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materiales', function (Blueprint $table) {
            $table->id('id_material'); // Llave primaria
            $table->string('nombre_material', 100);
            $table->string('categoria', 50); // Tela, hilo, botón, cierre
            $table->integer('stock')->default(0); // Cantidad disponible sana
            $table->integer('stock_danado')->default(0); // NUEVO: Control de merma/dañado
            $table->string('unidad_medida', 30); // Metros, piezas, rollos
            $table->decimal('costo_unitario', 10, 2);
            $table->string('proveedor', 100)->nullable();
            $table->date('fecha_compra')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materiales');
    }
};
