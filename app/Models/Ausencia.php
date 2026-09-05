<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ausencia extends Model
{
    use HasFactory;

    protected $table = 'ausencias';

    protected $fillable = [
        'trabajador_id',
        'fecha_inicio',
        'fecha_termino',
        'dias',
        'tipo',
        'estado',
        'justificacion',
        'observaciones',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_termino' => 'date',
        'dias' => 'decimal:2',
    ];

    /**
     * Trabajador al que pertenece la ausencia.
     */
    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }
}