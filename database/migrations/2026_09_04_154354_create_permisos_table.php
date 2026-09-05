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
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();

            // Trabajador que solicita o registra el permiso.
            $table->foreignId('trabajador_id')
                ->constrained('trabajadores')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Permiso por día completo o por horas.
            $table->string('tipo')->default('dia_completo');

            // Fecha y horario del permiso.
            $table->date('fecha_inicio');
            $table->date('fecha_termino')->nullable();
            $table->time('hora_inicio')->nullable();
            $table->time('hora_termino')->nullable();

            // Cantidad de días u horas solicitadas.
            $table->decimal('cantidad_horas', 5, 2)->nullable();

            // Permiso justificado o injustificado.
            $table->string('estado')->default('pendiente');

            // Motivo y justificación.
            $table->text('motivo')->nullable();
            $table->text('justificacion')->nullable();

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
        Schema::dropIfExists('permisos');
    }
};