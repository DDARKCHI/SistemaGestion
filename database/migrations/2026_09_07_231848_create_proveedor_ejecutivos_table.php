<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proveedor_ejecutivos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('proveedor_id')
                ->constrained('proveedores')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('nombre', 150);

            $table->string('cargo', 100)
                ->nullable();

            $table->string('correo', 150)
                ->nullable();

            $table->string('telefono', 50)
                ->nullable();

            $table->text('observaciones')
                ->nullable();

            $table->timestamps();

            $table->index([
                'proveedor_id',
                'nombre',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proveedor_ejecutivos');
    }
};