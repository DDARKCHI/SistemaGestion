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
        Schema::create('transportistas', function (Blueprint $table) {
            $table->id();

            // Identificación del transportista
            $table->string('nombre');
            $table->string('rut', 20)->unique();

            // Información de contacto
            $table->string('telefono', 30)->nullable();
            $table->string('correo')->nullable();
            $table->string('direccion')->nullable();

            // Información adicional
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportistas');
    }
};