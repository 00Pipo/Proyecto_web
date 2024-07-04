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
        Schema::create('arriendos', function (Blueprint $table) {
            $table->id();
            $table->string('cliente_rut', 8);
            $table->unsignedBigInteger('vehiculo_id');
            $table->string('user_rut', 8);
            $table->date('fecha_inicio');
            $table->date('fecha_termino');
            $table->dateTime('fecha_entrega')->nullable();
            $table->dateTime('fecha_devolucion')->nullable();
            $table->text('fotos_entrega')->nullable();
            $table->text('fotos_devolucion')->nullable();
            $table->decimal('valor_total', 10, 2);
            $table->timestamps();

            $table->foreign('cliente_rut')->references('rut')->on('clientes')->onDelete('restrict');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos')->onDelete('restrict');
            $table->foreign('user_rut')->references('rut')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arriendos');
    }
};
