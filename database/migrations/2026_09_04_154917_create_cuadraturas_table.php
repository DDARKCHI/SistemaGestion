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
        Schema::create('cuadraturas', function (Blueprint $table) {
            $table->id();

            // Trabajador asociado a la cuadratura.
            $table->foreignId('trabajador_id')
                ->constrained('trabajadores')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Operación a la que corresponde la cuadratura.
            $table->foreignId('operacion_id')
                ->constrained('operaciones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Período de la cuadratura.
            $table->string('periodo');

            // Totales de la cuadratura.
            $table->decimal('total_horas', 8, 2)->default(0);
            $table->decimal('total_ingresos', 15, 2)->default(0);
            $table->decimal('total_descuentos', 15, 2)->default(0);
            $table->decimal('total_gastos', 15, 2)->default(0);
            $table->decimal('total_liquidado', 15, 2)->default(0);

            // Estado de la cuadratura.
            // Ejemplos: pendiente, cuadrada, cerrada.
            $table->string('estado')->default('pendiente');

            $table->text('observaciones')->nullable();

            $table->timestamps();

            // Evita duplicar una cuadratura del mismo trabajador,
            // operación y período.
            $table->unique(
                ['trabajador_id', 'operacion_id', 'periodo'],
                'cuadraturas_trabajador_operacion_periodo_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuadraturas');
    }
};