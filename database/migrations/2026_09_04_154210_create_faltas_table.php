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
        Schema::create('faltas', function (Blueprint $table) {
            $table->id();

            // Trabajador al que corresponde la falta.
            $table->foreignId('trabajador_id')
                ->constrained('trabajadores')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Fecha de la falta.
            $table->date('fecha');

            // Tipo o categoría de la falta.
            $table->string('tipo')->nullable();

            // Descripción de lo ocurrido.
            $table->text('descripcion')->nullable();

            // Estado del registro.
            // Ejemplos: pendiente, registrada, sancionada, cerrada.
            $table->string('estado')->default('registrada');

            // Medida o sanción aplicada, si corresponde.
            $table->text('sancion')->nullable();

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
        Schema::dropIfExists('faltas');
    }
};