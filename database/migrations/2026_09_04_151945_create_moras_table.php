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
        Schema::create('moras', function (Blueprint $table) {
            $table->id();

            // Factura que originó la mora
            $table->foreignId('factura_origen_id')
                ->constrained('facturas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Operación donde se originó la mora
            $table->foreignId('operacion_origen_id')
                ->constrained('operaciones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Factura a la que se carga la mora
            $table->foreignId('factura_destino_id')
                ->nullable()
                ->constrained('facturas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Operación correspondiente a la factura destino
            $table->foreignId('operacion_destino_id')
                ->nullable()
                ->constrained('operaciones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Información de la mora
            $table->unsignedInteger('dias_atraso')->default(0);
            $table->decimal('valor_mora', 15, 2)->default(0);
            $table->decimal('iva_mora', 15, 2)->default(0);

            // Fecha o período en que se registra la mora
            $table->date('fecha')->nullable();

            // Información adicional
            $table->text('observacion')->nullable();

            $table->timestamps();

            // Índices para facilitar consultas
            $table->index('factura_origen_id');
            $table->index('factura_destino_id');
            $table->index('operacion_origen_id');
            $table->index('operacion_destino_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moras');
    }
};