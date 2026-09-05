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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();

            // Registro al que pertenece el documento
            $table->string('documentable_type');
            $table->unsignedBigInteger('documentable_id');

            // Información del documento
            $table->string('nombre');
            $table->string('tipo')->nullable();
            $table->string('ruta');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('tamano')->nullable();

            // Información adicional
            $table->text('descripcion')->nullable();
            $table->text('observaciones')->nullable();

            $table->timestamps();

            // Índice para la relación polimórfica
            $table->index(
                ['documentable_type', 'documentable_id'],
                'documentos_documentable_index'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};