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
        Schema::create('operaciones', function (Blueprint $table) {
            $table->id();

            // Cliente asociado a la operación
            $table->foreignId('cliente_id')
                ->constrained('clientes')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Identificación de la operación
            $table->string('numero_operacion')->unique();
            $table->string('tipo')->nullable();

            // Información principal
            $table->date('fecha_operacion')->nullable();
            $table->date('fecha_curse')->nullable();
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
        Schema::dropIfExists('operaciones');
    }
};