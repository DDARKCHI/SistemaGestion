<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacacion extends Model
{
    use HasFactory;

    protected $table = 'vacaciones';

    protected $fillable = [
        'trabajador_id',
        'periodo',
        'dias_correspondientes',
        'dias_tomados',
        'dias_reservados',
        'dias_restantes',
        'estado',
        'observaciones',
    ];

    protected $casts = [
        'dias_correspondientes' => 'decimal:2',
        'dias_tomados' => 'decimal:2',
        'dias_reservados' => 'decimal:2',
        'dias_restantes' => 'decimal:2',
    ];

    /**
     * Trabajador al que pertenece este período de vacaciones.
     */
    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }

    /**
     * Detalles de uso o reserva de las vacaciones.
     */
    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleVacacion::class);
    }
}