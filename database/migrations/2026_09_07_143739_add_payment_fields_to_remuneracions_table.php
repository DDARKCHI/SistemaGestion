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
        Schema::table('remuneraciones', function (Blueprint $table) {
            $table->decimal('monto_pagado', 15, 2)
                ->default(0)
                ->after('total_liquido');

            $table->date('fecha_pago')
                ->nullable()
                ->after('monto_pagado');

            $table->decimal('saldo_a_pagar', 15, 2)
                ->default(0)
                ->after('fecha_pago');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('remuneraciones', function (Blueprint $table) {
            $table->dropColumn([
                'monto_pagado',
                'fecha_pago',
                'saldo_a_pagar',
            ]);
        });
    }
};