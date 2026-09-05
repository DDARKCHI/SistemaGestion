<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mora extends Model
{
    use HasFactory;

    protected $table = 'moras';

    protected $fillable = [
        'factura_origen_id',
        'operacion_origen_id',
        'factura_destino_id',
        'operacion_destino_id',
        'dias_atraso',
        'valor_mora',
        'iva_mora',
        'fecha',
        'observacion',
    ];

    protected $casts = [
        'dias_atraso' => 'integer',
        'valor_mora' => 'decimal:2',
        'iva_mora' => 'decimal:2',
        'fecha' => 'date',
    ];

    /**
     * Factura que originó la mora.
     */
    public function facturaOrigen(): BelongsTo
    {
        return $this->belongsTo(Factura::class, 'factura_origen_id');
    }

    /**
     * Operación donde se originó la mora.
     */
    public function operacionOrigen(): BelongsTo
    {
        return $this->belongsTo(Operacion::class, 'operacion_origen_id');
    }

    /**
     * Factura a la que se carga la mora.
     */
    public function facturaDestino(): BelongsTo
    {
        return $this->belongsTo(Factura::class, 'factura_destino_id');
    }

    /**
     * Operación correspondiente a la factura destino.
     */
    public function operacionDestino(): BelongsTo
    {
        return $this->belongsTo(Operacion::class, 'operacion_destino_id');
    }
}