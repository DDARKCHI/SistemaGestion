<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Permiso extends Model
{
    use HasFactory;

    protected $table = 'permisos';

    protected $fillable = [
        'trabajador_id',
        'tipo',
        'fecha_inicio',
        'fecha_termino',
        'hora_inicio',
        'hora_termino',
        'cantidad_horas',
        'estado',
        'motivo',
        'justificacion',
        'observaciones',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_termino' => 'date',
        'cantidad_horas' => 'decimal:2',
    ];

    /**
     * Trabajador al que pertenece el permiso.
     */
    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }

    /**
     * Documentos de respaldo asociados al permiso.
     */
    public function documentos(): MorphMany
    {
        return $this->morphMany(Documento::class, 'documentable');
    }
}