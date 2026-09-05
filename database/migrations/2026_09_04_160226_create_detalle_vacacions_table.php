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
        Schema::create('detalle_vacaciones', function (Blueprint $table) {
            $table->id();

            // Período de vacaciones al que pertenece el detalle.
            $table->foreignId('vacacion_id')
                ->constrained('vacaciones')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Fechas del período utilizado o reservado.
            $table->date('fecha_inicio');
            $table->date('fecha_termino');

            // Cantidad de días correspondientes a este detalle.
            $table->decimal('dias', 5, 2)->default(0);

            // Indica si los días fueron tomados o reservados.
            $table->string('tipo')->default('tomada');

            // Información adicional.
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_vacaciones');
    }
};