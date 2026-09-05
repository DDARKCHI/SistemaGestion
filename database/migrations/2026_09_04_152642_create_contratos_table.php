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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();

            // Trabajador al que pertenece el contrato
            $table->foreignId('trabajador_id')
                ->constrained('trabajadores')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Información del contrato
            $table->string('tipo')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_termino')->nullable();
            $table->string('estado')->default('vigente');

            // Condiciones laborales
            $table->decimal('remuneracion', 15, 2)->default(0);
            $table->decimal('horas_semanales', 5, 2)->nullable();
            $table->decimal('horas_mensuales', 7, 2)->nullable();

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
        Schema::dropIfExists('contratos');
    }
};