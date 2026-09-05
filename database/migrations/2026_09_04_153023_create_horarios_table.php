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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();

            // Trabajador al que pertenece el horario
            $table->foreignId('trabajador_id')
                ->constrained('trabajadores')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Información del horario
            $table->string('tipo')->nullable();
            $table->string('dia')->nullable();
            $table->time('hora_inicio')->nullable();
            $table->time('hora_termino')->nullable();

            // Horas correspondientes
            $table->decimal('horas_diarias', 5, 2)->nullable();
            $table->decimal('horas_semanales', 5, 2)->nullable();
            $table->decimal('horas_mensuales', 7, 2)->nullable();

            // Estado
            $table->string('estado')->default('vigente');

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
        Schema::dropIfExists('horarios');
    }
};