<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id('id_pago'); // Llave primaria
            
            // Llave foránea conectada al pedido correspondiente
            $table->unsignedBigInteger('id_pedido');
            $table->foreign('id_pedido')->references('id_pedido')->on('pedidos')->onDelete('cascade');
            
            $table->date('fecha_pago');
            $table->decimal('monto_total_pedido', 10, 2);
            $table->decimal('abono', 10, 2); // La cantidad que está pagando hoy
            $table->decimal('saldo_restante', 10, 2); // Lo que le queda debiendo después del abono
            $table->string('metodo_pago', 50); // Efectivo, Transferencia, etc.
            $table->string('estado', 50)->default('Completado');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
