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
        Schema::create('reclamos', function (Blueprint $table) {
            $table->id();

            // Cliente que presenta el reclamo.
            $table->foreignId('cliente_id')
                ->constrained('clientes')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Operación relacionada con el reclamo.
            $table->foreignId('operacion_id')
                ->constrained('operaciones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Información principal del reclamo.
            $table->date('fecha');
            $table->string('tipo')->nullable();
            $table->string('estado')->default('pendiente');

            // Descripción y gestión del reclamo.
            $table->text('descripcion')->nullable();
            $table->text('respuesta')->nullable();
            $table->date('fecha_respuesta')->nullable();

            // Observaciones adicionales.
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamos');
    }
};