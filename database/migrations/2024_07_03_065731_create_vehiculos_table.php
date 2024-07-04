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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_id');
            $table->string('marca', 50);
            $table->string('modelo', 50);
            $table->integer('valor_arriendo_diario');
            $table->enum('estado', ['disponible', 'arrendado', 'en mantenimiento', 'de baja'])->default('disponible');
            $table->timestamps();

            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
