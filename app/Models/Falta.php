<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Falta extends Model
{
    use HasFactory;

    protected $table = 'faltas';

    protected $fillable = [
        'trabajador_id',
        'fecha',
        'tipo',
        'descripcion',
        'estado',
        'sancion',
        'observaciones',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    /**
     * Trabajador al que pertenece la falta.
     */
    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }
}