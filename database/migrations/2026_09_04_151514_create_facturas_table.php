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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();

            // Operación a la que pertenece la factura
            $table->foreignId('operacion_id')
                ->constrained('operaciones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Identificación de la factura
            $table->string('numero_factura')->unique();
            $table->date('fecha_emision')->nullable();
            $table->date('fecha_vencimiento')->nullable();

            // Montos
            $table->decimal('neto', 15, 2)->default(0);
            $table->decimal('iva', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);

            // Estado de la factura
            $table->string('estado')->default('vigente');

            // Estado relacionado con mora
            $table->string('estado_mora')->default('sin_mora');

            // Información de pago/cierre
            $table->date('fecha_pago')->nullable();
            $table->date('fecha_cierre')->nullable();

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
        Schema::dropIfExists('facturas');
    }
};