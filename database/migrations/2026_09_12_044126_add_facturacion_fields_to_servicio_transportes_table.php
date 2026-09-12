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
        Schema::table('servicio_transportes', function (Blueprint $table) {

            // Indica si el transportista emite factura.
            $table->boolean('emite_factura')
                ->default(true)
                ->after('monto');

            // Estado de facturación del servicio.
            $table->enum('estado_facturacion', [
                'Pendiente',
                'Recibida',
            ])
                ->default('Pendiente')
                ->after('emite_factura');

            // Número de factura recibida.
            $table->string('numero_factura', 50)
                ->nullable()
                ->after('estado_facturacion');

            // Fecha de la factura recibida.
            $table->date('fecha_factura')
                ->nullable()
                ->after('numero_factura');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servicio_transportes', function (Blueprint $table) {

            $table->dropColumn([
                'emite_factura',
                'estado_facturacion',
                'numero_factura',
                'fecha_factura',
            ]);
        });
    }
};