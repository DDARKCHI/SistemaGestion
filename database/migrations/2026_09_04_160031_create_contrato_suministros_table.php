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
        Schema::create('contrato_suministros', function (Blueprint $table) {
            $table->id();

            // Cliente asociado al contrato de suministro.
            $table->foreignId('cliente_id')
                ->constrained('clientes')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Identificación del contrato.
            $table->string('numero_contrato')->unique();

            // Información principal.
            $table->string('tipo')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_termino')->nullable();
            $table->string('estado')->default('vigente');

            // Condiciones del suministro.
            $table->text('descripcion')->nullable();
            $table->text('condiciones')->nullable();

            // Información adicional.
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrato_suministros');
    }
};