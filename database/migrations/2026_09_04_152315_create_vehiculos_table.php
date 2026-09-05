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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();

            // Transportista propietario o responsable del vehículo
            $table->foreignId('transportista_id')
                ->constrained('transportistas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Información del vehículo
            $table->string('patente', 20)->unique();
            $table->string('tipo')->nullable();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->integer('anio')->nullable();

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
        Schema::dropIfExists('vehiculos');
    }
};