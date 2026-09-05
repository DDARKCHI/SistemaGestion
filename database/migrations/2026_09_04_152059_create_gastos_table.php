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
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();

            // Operación a la que pertenece el gasto
            $table->foreignId('operacion_id')
                ->constrained('operaciones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Información del gasto
            $table->date('fecha')->nullable();
            $table->string('tipo')->nullable();
            $table->string('descripcion')->nullable();
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
        Schema::dropIfExists('gastos');
    }
};