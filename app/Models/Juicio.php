<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Juicio extends Model
{
    use HasFactory;

    protected $table = 'juicios';

    protected $fillable = [
        'cliente_id',
        'operacion_id',
        'fecha_inicio',
        'tipo',
        'tribunal',
        'rol',
        'estado',
        'descripcion',
        'observaciones',
        'fecha_termino',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_termino' => 'date',
    ];

    /**
     * Cliente relacionado con el juicio.
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Operación relacionada con el juicio.
     */
    public function operacion(): BelongsTo
    {
        return $this->belongsTo(Operacion::class);
    }
}