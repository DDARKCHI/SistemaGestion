<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reclamo extends Model
{
    use HasFactory;

    protected $table = 'reclamos';

    protected $fillable = [
        'cliente_id',
        'operacion_id',
        'fecha',
        'tipo',
        'estado',
        'descripcion',
        'respuesta',
        'fecha_respuesta',
        'observaciones',
    ];

    protected $casts = [
        'fecha' => 'date',
        'fecha_respuesta' => 'date',
    ];

    /**
     * Cliente que presenta el reclamo.
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Operación relacionada con el reclamo.
     */
    public function operacion(): BelongsTo
    {
        return $this->belongsTo(Operacion::class);
    }
}