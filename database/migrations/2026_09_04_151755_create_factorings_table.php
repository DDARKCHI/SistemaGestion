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
        Schema::create('factorings', function (Blueprint $table) {
            $table->id();

            // Relaciones principales
            $table->foreignId('operacion_id')
                ->constrained('operaciones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('factura_id')
                ->constrained('facturas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Información del factoring
            $table->date('fecha_curse')->nullable();
            $table->string('estado')->default('pendiente');

            // Datos financieros del factoring
            $table->decimal('monto_factura', 15, 2)->default(0);
            $table->decimal('monto_anticipo', 15, 2)->default(0);
            $table->decimal('comision', 15, 2)->default(0);
            $table->decimal('interes', 15, 2)->default(0);
            $table->decimal('monto_liquidado', 15, 2)->default(0);

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
        Schema::dropIfExists('factorings');
    }
};