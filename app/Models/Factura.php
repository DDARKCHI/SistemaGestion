<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'facturas';

    protected $fillable = [
        'operacion_id',
        'numero_factura',
        'factura_reemplazada_id',
        'fecha_emision',
        'fecha_vencimiento',
        'neto',
        'iva',
        'total',
        'estado',
        'estado_mora',
        'fecha_pago',
        'fecha_cierre',
        'observaciones',
    ];

    protected $casts = [
        'fecha_emision' => 'date',
        'fecha_vencimiento' => 'date',
        'fecha_pago' => 'date',
        'fecha_cierre' => 'date',
        'neto' => 'decimal:2',
        'iva' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /**
     * Operación a la que pertenece la factura.
     */
    public function operacion(): BelongsTo
    {
        return $this->belongsTo(Operacion::class);
    }

    /**
     * Factura anterior que esta factura reemplaza.
     */
    public function facturaReemplazada(): BelongsTo
    {
        return $this->belongsTo(
            Factura::class,
            'factura_reemplazada_id'
        );
    }

    /**
     * Facturas nuevas que reemplazan a esta factura.
     */
    public function reemplazos(): HasMany
    {
        return $this->hasMany(
            Factura::class,
            'factura_reemplazada_id'
        );
    }

    /**
     * Notas de crédito asociadas.
     */
    public function notasCredito(): HasMany
    {
        return $this->hasMany(NotaCredito::class);
    }

    /**
     * Registros de factoring asociados.
     */
    public function factorings(): HasMany
    {
        return $this->hasMany(Factoring::class);
    }

    /**
     * Moras generadas por esta factura.
     */
    public function morasOrigen(): HasMany
    {
        return $this->hasMany(
            Mora::class,
            'factura_origen_id'
        );
    }

    /**
     * Moras trasladadas a esta factura.
     */
    public function morasDestino(): HasMany
    {
        return $this->hasMany(
            Mora::class,
            'factura_destino_id'
        );
    }
}