<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cuadratura extends Model
{
    use HasFactory;

    protected $table = 'cuadraturas';

    protected $fillable = [
        'trabajador_id',
        'operacion_id',
        'periodo',
        'total_horas',
        'total_ingresos',
        'total_descuentos',
        'total_gastos',
        'total_liquidado',
        'estado',
        'observaciones',
    ];

    protected $casts = [
        'total_horas' => 'decimal:2',
        'total_ingresos' => 'decimal:2',
        'total_descuentos' => 'decimal:2',
        'total_gastos' => 'decimal:2',
        'total_liquidado' => 'decimal:2',
    ];

    /**
     * Trabajador asociado a la cuadratura.
     */
    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }

    /**
     * Operación asociada a la cuadratura.
     */
    public function operacion(): BelongsTo
    {
        return $this->belongsTo(Operacion::class);
    }
}