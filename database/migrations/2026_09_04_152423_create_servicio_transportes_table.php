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
        Schema::create('servicio_transportes', function (Blueprint $table) {
            $table->id();

            // Operación asociada
            $table->foreignId('operacion_id')
                ->constrained('operaciones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Transportista que realizó el servicio
            $table->foreignId('transportista_id')
                ->constrained('transportistas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Vehículo utilizado
            $table->foreignId('vehiculo_id')
                ->constrained('vehiculos')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Información del servicio
            $table->date('fecha_servicio')->nullable();
            $table->string('tipo_servicio')->nullable();
            $table->decimal('monto', 15, 2)->default(0);

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
        Schema::dropIfExists('servicio_transportes');
    }
};