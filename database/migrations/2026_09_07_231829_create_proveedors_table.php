<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();

            $table->string('nombre', 150);

            $table->string('rut', 20)
                ->unique();

            $table->string('localidad', 100)
                ->nullable();

            $table->string('cuenta', 100)
                ->nullable();

            $table->string('direccion', 255)
                ->nullable();

            $table->string('correo', 150)
                ->nullable();

            $table->string('telefono', 50)
                ->nullable();

            $table->text('observaciones')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};