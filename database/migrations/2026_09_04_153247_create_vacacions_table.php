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
        Schema::create('vacaciones', function (Blueprint $table) {
            $table->id();

            // Trabajador al que pertenece el período de vacaciones.
            $table->foreignId('trabajador_id')
                ->constrained('trabajadores')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Período al que corresponden las vacaciones.
            $table->string('periodo');

            // Días que corresponden al trabajador en este período.
            $table->decimal('dias_correspondientes', 5, 2)->default(0);

            // Días ya utilizados.
            $table->decimal('dias_tomados', 5, 2)->default(0);

            // Días reservados o programados para ser utilizados.
            $table->decimal('dias_reservados', 5, 2)->default(0);

            // Días que quedan disponibles.
            $table->decimal('dias_restantes', 5, 2)->default(0);

            // Estado general del período.
            // Ejemplos: no_tomadas, parcialmente_tomadas, tomadas.
            $table->string('estado')->default('no_tomadas');

            $table->text('observaciones')->nullable();

            $table->timestamps();

            // Un trabajador no puede tener dos registros
            // para el mismo período.
            $table->unique(
                ['trabajador_id', 'periodo'],
                'vacaciones_trabajador_periodo_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacaciones');
    }
};