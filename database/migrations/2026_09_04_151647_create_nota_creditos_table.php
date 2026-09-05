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
        Schema::create('nota_creditos', function (Blueprint $table) {
            $table->id();

            // Factura a la que pertenece la nota de crédito
            $table->foreignId('factura_id')
                ->constrained('facturas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Identificación de la nota de crédito
            $table->string('numero_nota')->unique();
            $table->date('fecha_emision')->nullable();

            // Montos
            $table->decimal('neto', 15, 2)->default(0);
            $table->decimal('iva', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);

            // Motivo y estado
            $table->string('motivo')->nullable();
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
        Schema::dropIfExists('nota_creditos');
    }
};