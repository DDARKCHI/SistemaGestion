<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleVacacion extends Model
{
    use HasFactory;

    protected $table = 'detalle_vacaciones';

    protected $fillable = [
        'vacacion_id',
        'fecha_inicio',
        'fecha_termino',
        'dias',
        'tipo',
        'observaciones',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_termino' => 'date',
        'dias' => 'decimal:2',
    ];

    /**
     * Período de vacaciones al que pertenece este detalle.
     */
    public function vacacion(): BelongsTo
    {
        return $this->belongsTo(Vacacion::class);
    }
}