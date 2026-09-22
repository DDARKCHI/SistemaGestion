<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cuadraturas', function (Blueprint $table) {
            $table->dropColumn([
                'total_descuentos',
                'total_gastos',
                'total_liquidado',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('cuadraturas', function (Blueprint $table) {
            $table->decimal('total_descuentos', 15, 2)->default(0);
            $table->decimal('total_gastos', 15, 2)->default(0);
            $table->decimal('total_liquidado', 15, 2)->default(0);
        });
    }
};