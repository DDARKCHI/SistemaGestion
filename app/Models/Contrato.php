<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Contrato extends Model
{
    use HasFactory;

    protected $table = 'contratos';

    protected $fillable = [
        'trabajador_id',
        'tipo',
        'fecha_inicio',
        'fecha_termino',
        'estado',
        'remuneracion',
        'horas_semanales',
        'horas_mensuales',
        'observaciones',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_termino' => 'date',
        'remuneracion' => 'decimal:2',
        'horas_semanales' => 'decimal:2',
        'horas_mensuales' => 'decimal:2',
    ];

    /**
     * Trabajador al que pertenece el contrato.
     */
    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }

    /**
     * Historial de modificaciones y anexos
     * asociados al contrato.
     */
    public function modificaciones(): HasMany
    {
        return $this->hasMany(
            ModificacionContrato::class
        )->orderByDesc('fecha');
    }

    /**
     * Documentos asociados directamente
     * al contrato original.
     */
    public function documentos(): MorphMany
    {
        return $this->morphMany(
            Documento::class,
            'documentable'
        );
    }
}