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
        Schema::create('modificacion_contratos', function (Blueprint $table) {
            $table->id();

            // Contrato al que pertenece la modificación
            $table->foreignId('contrato_id')
                ->constrained('contratos')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Tipo de modificación
            $table->string('tipo');

            // Fecha en que se realiza la modificación
            $table->date('fecha');

            // Descripción del cambio realizado
            $table->text('descripcion');

            // Nuevas condiciones, cuando corresponda
            $table->decimal('nueva_remuneracion', 15, 2)->nullable();
            $table->decimal('nuevo_bono', 15, 2)->nullable();

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
        Schema::dropIfExists('modificacion_contratos');
    }
};