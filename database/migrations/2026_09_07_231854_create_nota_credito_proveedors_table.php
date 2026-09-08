<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nota_credito_proveedores', function (Blueprint $table) {
            $table->id();

            $table->foreignId('proveedor_id')
                ->constrained('proveedores')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->string('numero_nota', 50);

            $table->date('fecha');

            $table->decimal('monto', 15, 2);

            $table->string('motivo', 255)
                ->nullable();

            $table->string('estado', 50)
                ->default('pendiente');

            $table->text('observaciones')
                ->nullable();

            $table->timestamps();

            $table->unique([
                'proveedor_id',
                'numero_nota',
            ]);

            $table->index([
                'proveedor_id',
                'estado',
            ]);

            $table->index('fecha');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nota_credito_proveedores');
    }
};