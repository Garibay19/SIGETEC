<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('id_pedido'); // Llave primaria
            
            // Llave foránea conectada estrictamente al módulo de clientes que ya hicimos
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
            
            $table->text('descripcion'); // Detalles de las prendas a confeccionar
            $table->date('fecha_entrega'); // Fecha en la que se debe entregar
            $table->decimal('total', 10, 2); // Precio total del pedido
            $table->decimal('saldo_pendiente', 10, 2); // Lo que falta por pagar
            $table->string('estado', 50)->default('Pendiente'); // 'Pendiente', 'En proceso', 'Terminado'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
