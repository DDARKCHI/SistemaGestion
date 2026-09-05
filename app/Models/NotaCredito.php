<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotaCredito extends Model
{
    use HasFactory;

    protected $table = 'nota_creditos';

    protected $fillable = [
        'factura_id',
        'numero_nota',
        'fecha_emision',
        'neto',
        'iva',
        'total',
        'motivo',
        'estado',
        'observaciones',
    ];

    protected $casts = [
        'fecha_emision' => 'date',
        'neto' => 'decimal:2',
        'iva' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /**
     * Factura a la que pertenece la nota de crédito.
     */
    public function factura(): BelongsTo
    {
        return $this->belongsTo(Factura::class);
    }
}