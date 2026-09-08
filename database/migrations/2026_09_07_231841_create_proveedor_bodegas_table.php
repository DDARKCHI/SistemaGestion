<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proveedor_bodegas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('proveedor_id')
                ->constrained('proveedores')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('nombre', 150);

            $table->string('direccion', 255);

            $table->string('localidad', 100)
                ->nullable();

            $table->text('observaciones')
                ->nullable();

            $table->timestamps();

            $table->index([
                'proveedor_id',
                'localidad',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proveedor_bodegas');
    }
};