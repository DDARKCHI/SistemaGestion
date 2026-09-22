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
        'fecha',
        'total_horas',
        'dinero_depositado',
        'gastos_facturados',
        'gastos_con_boleta',
        'gastos_sin_comprobante',
        'saldo_a_favor',
        'saldo_en_contra',
        'estado',
        'observaciones',
    ];

    protected $casts = [
        'fecha' => 'date',
        'total_horas' => 'decimal:2',
        'dinero_depositado' => 'decimal:2',
        'gastos_facturados' => 'decimal:2',
        'gastos_con_boleta' => 'decimal:2',
        'gastos_sin_comprobante' => 'decimal:2',
        'saldo_a_favor' => 'decimal:2',
        'saldo_en_contra' => 'decimal:2',
    ];

    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function operacion(): BelongsTo
    {
        return $this->belongsTo(Operacion::class);
    }
}