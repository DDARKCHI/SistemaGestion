<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(
            'nota_credito_proveedores',
            function (Blueprint $table) {

                $table->date('fecha_recuperacion')
                    ->nullable()
                    ->after('estado');
            }
        );
    }

    public function down(): void
    {
        Schema::table(
            'nota_credito_proveedores',
            function (Blueprint $table) {

                $table->dropColumn(
                    'fecha_recuperacion'
                );
            }
        );
    }
};