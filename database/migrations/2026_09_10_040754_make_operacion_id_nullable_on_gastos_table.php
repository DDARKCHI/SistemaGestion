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
        Schema::table('gastos', function (Blueprint $table) {
            $table->dropForeign(['operacion_id']);

            $table->foreignId('operacion_id')
                ->nullable()
                ->change();

            $table->foreign('operacion_id')
                ->references('id')
                ->on('operaciones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gastos', function (Blueprint $table) {
            $table->dropForeign(['operacion_id']);

            $table->foreignId('operacion_id')
                ->nullable(false)
                ->change();

            $table->foreign('operacion_id')
                ->references('id')
                ->on('operaciones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }
};