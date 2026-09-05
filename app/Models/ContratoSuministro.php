<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContratoSuministro extends Model
{
    use HasFactory;

    protected $table = 'contrato_suministros';

    protected $fillable = [
        'cliente_id',
        'numero_contrato',
        'tipo',
        'fecha_inicio',
        'fecha_termino',
        'estado',
        'descripcion',
        'condiciones',
        'observaciones',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_termino' => 'date',
    ];

    /**
     * Cliente asociado al contrato de suministro.
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }
}