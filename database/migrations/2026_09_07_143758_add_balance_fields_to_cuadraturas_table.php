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
        Schema::table('cuadraturas', function (Blueprint $table) {
            $table->decimal('saldo_a_favor', 15, 2)
                ->default(0)
                ->after('total_gastos');

            $table->decimal('saldo_en_contra', 15, 2)
                ->default(0)
                ->after('saldo_a_favor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cuadraturas', function (Blueprint $table) {
            $table->dropColumn([
                'saldo_a_favor',
                'saldo_en_contra',
            ]);
        });
    }
};