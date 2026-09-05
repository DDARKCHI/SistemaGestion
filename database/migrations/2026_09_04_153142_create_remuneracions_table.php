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
        Schema::create('remuneraciones', function (Blueprint $table) {
            $table->id();

            // Trabajador al que pertenece la remuneración
            $table->foreignId('trabajador_id')
                ->constrained('trabajadores')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Período de la remuneración
            $table->string('periodo');

            // Información de la remuneración
            $table->decimal('sueldo_base', 15, 2)->default(0);
            $table->decimal('bonificaciones', 15, 2)->default(0);
            $table->decimal('descuentos', 15, 2)->default(0);
            $table->decimal('total_liquido', 15, 2)->default(0);

            // Estado
            $table->string('estado')->default('pendiente');

            // Información adicional
            $table->text('observaciones')->nullable();

            $table->timestamps();

            // Evita duplicar la remuneración del mismo trabajador
            // para el mismo período.
            $table->unique(
                ['trabajador_id', 'periodo'],
                'remuneraciones_trabajador_periodo_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remuneraciones');
    }
};