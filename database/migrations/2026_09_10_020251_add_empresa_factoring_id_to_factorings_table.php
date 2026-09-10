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
        Schema::table('factorings', function (Blueprint $table) {
            $table->foreignId('empresa_factoring_id')
                ->nullable()
                ->after('factura_id')
                ->constrained('empresas_factoring')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('factorings', function (Blueprint $table) {
            $table->dropForeign([
                'empresa_factoring_id',
            ]);

            $table->dropColumn('empresa_factoring_id');
        });
    }
};