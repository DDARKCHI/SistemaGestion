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
        Schema::create('ausencias', function (Blueprint $table) {
            $table->id();

            // Trabajador que registra la ausencia.
            $table->foreignId('trabajador_id')
                ->constrained('trabajadores')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Fecha o período de la ausencia.
            $table->date('fecha_inicio');
            $table->date('fecha_termino')->nullable();

            // Cantidad de días de ausencia.
            $table->decimal('dias', 5, 2)->default(1);

            // Motivo de la ausencia.
            $table->string('tipo')->nullable();

            // Estado de la ausencia.
            // Ejemplos: justificada, injustificada, pendiente.
            $table->string('estado')->default('pendiente');

            // Información adicional y respaldo.
            $table->text('justificacion')->nullable();
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ausencias');
    }
};