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
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();

            // Operación a la que pertenece la entrega
            $table->foreignId('operacion_id')
                ->constrained('operaciones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Información de la entrega
            $table->date('fecha_entrega')->nullable();
            $table->string('numero_entrega')->nullable();
            $table->string('estado')->default('pendiente');

            // Información adicional
            $table->text('descripcion')->nullable();
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entregas');
    }
};