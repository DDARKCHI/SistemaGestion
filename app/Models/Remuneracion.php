<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'estado',
        'observaciones',
    ];

    protected $casts = [
        'sueldo_base' => 'decimal:2',
        'bonificaciones' => 'decimal:2',
        'descuentos' => 'decimal:2',
        'total_liquido' => 'decimal:2',
    ];

    /**
     * Trabajador al que pertenece la remuneración.
     */
    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }
}