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
        Schema::create('juicios', function (Blueprint $table) {
            $table->id();

            // Cliente relacionado con el juicio.
            $table->foreignId('cliente_id')
                ->constrained('clientes')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Operación relacionada con el juicio.
            $table->foreignId('operacion_id')
                ->constrained('operaciones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Información principal del juicio.
            $table->date('fecha_inicio')->nullable();
            $table->string('tipo')->nullable();
            $table->string('tribunal')->nullable();
            $table->string('rol')->nullable();

            // Estado actual del proceso.
            $table->string('estado')->default('activo');

            // Descripción y antecedentes.
            $table->text('descripcion')->nullable();
            $table->text('observaciones')->nullable();

            // Fecha de término, si el juicio ya finalizó.
            $table->date('fecha_termino')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juicios');
    }
};