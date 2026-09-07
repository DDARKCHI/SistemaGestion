<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Remuneracion extends Model
{
    use HasFactory;

    protected $table = 'remuneraciones';

    protected $fillable = [
        'trabajador_id',
        'periodo',
        'sueldo_base',
        'bonificaciones',
        'descuentos',
        'total_liquido',
        'monto_pagado',
        'fecha_pago',
        'saldo_a_pagar',
        'estado',
        'observaciones',
    ];

    protected $casts = [
        'sueldo_base' => 'decimal:2',
        'bonificaciones' => 'decimal:2',
        'descuentos' => 'decimal:2',
        'total_liquido' => 'decimal:2',
        'monto_pagado' => 'decimal:2',
        'fecha_pago' => 'date',
        'saldo_a_pagar' => 'decimal:2',
    ];

    /**
     * Trabajador al que pertenece la remuneración.
     */
    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }

    /**
     * Documentos asociados a la remuneración.
     *
     * Ejemplos:
     * - Liquidación de sueldo.
     * - Liquidación firmada.
     * - Otros documentos relacionados.
     */
    public function documentos(): MorphMany
    {
        return $this->morphMany(
            Documento::class,
            'documentable'
        );
    }
}