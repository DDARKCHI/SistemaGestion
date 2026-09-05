<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';

    protected $fillable = [
        'trabajador_id',
        'tipo',
        'dia',
        'hora_inicio',
        'hora_termino',
        'horas_diarias',
        'horas_semanales',
        'horas_mensuales',
        'estado',
        'observaciones',
    ];

    protected $casts = [
        'horas_diarias' => 'decimal:2',
        'horas_semanales' => 'decimal:2',
        'horas_mensuales' => 'decimal:2',
    ];

    /**
     * Trabajador al que pertenece el horario.
     */
    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }
}