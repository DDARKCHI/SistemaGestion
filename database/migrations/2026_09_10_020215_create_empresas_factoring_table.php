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
        Schema::create('empresas_factoring', function (Blueprint $table) {
            $table->id();

            // =====================================================
            // IDENTIFICACIÓN
            // =====================================================

            $table->string('nombre', 255);

            $table->string('rut', 20)
                ->unique();

            // =====================================================
            // DATOS DE CONTACTO
            // =====================================================

            $table->string('correo', 255)
                ->nullable();

            $table->string('telefono', 50)
                ->nullable();

            // =====================================================
            // EJECUTIVO
            // =====================================================

            $table->string('ejecutivo', 255)
                ->nullable();

            $table->string('telefono_ejecutivo', 50)
                ->nullable();

            // =====================================================
            // DATOS BANCARIOS
            // =====================================================

            $table->string('cuenta_bancaria', 255)
                ->nullable();

            // =====================================================
            // INFORMACIÓN ADICIONAL
            // =====================================================

            $table->text('otros_datos')
                ->nullable();

            // =====================================================
            // ESTADO
            // =====================================================

            $table->string('estado', 30)
                ->default('activo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas_factoring');
    }
};