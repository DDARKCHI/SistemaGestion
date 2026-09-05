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
        Schema::create('trabajadores', function (Blueprint $table) {
            $table->id();

            // Identificación del trabajador
            $table->string('nombre');
            $table->string('rut', 20)->unique();

            // Información personal y de contacto
            $table->string('direccion')->nullable();
            $table->string('telefono', 30)->nullable();
            $table->string('correo')->nullable();

            // Información laboral inicial
            $table->date('fecha_ingreso')->nullable();
            $table->decimal('remuneracion_acordada', 15, 2)->default(0);

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
        Schema::dropIfExists('trabajadores');
    }
};