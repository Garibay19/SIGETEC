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
        Schema::create('bonos', function (Blueprint $table) {
            $table->id('id_bono'); // Llave primaria
            
            // Llave foránea conectada directamente al módulo de trabajadores
            $table->unsignedBigInteger('id_trabajador');
            $table->foreign('id_trabajador')->references('id_trabajador')->on('trabajadores')->onDelete('cascade');
            
            $table->string('operacion', 100); // Ejemplo: PEGADO PUÑO, DOBLADILLO, OVERLEADO
            $table->integer('objetivo_semanal'); // Meta de piezas (Ejemplo: 9360)
            
            // Campos diarios para capturar la producción de forma ultra práctica
            $table->integer('lunes')->default(0);
            $table->integer('martes')->default(0);
            $table->integer('miercoles')->default(0);
            $table->integer('jueves')->default(0);
            $table->integer('viernes')->default(0);
            $table->integer('sabado')->default(0);
            
            $table->integer('total_piezas')->default(0); // Suma automática de L a S
            $table->decimal('monto_bono', 10, 2); // Cuánto dinero vale el bono (Ejemplo: 465.98)
            $table->string('cumplimiento', 20)->default('No cumple'); // 'Cumple' o 'No cumple'
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bonos');
    }
};
