<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Factoring extends Model
{
    use HasFactory;

    protected $table = 'factorings';

    protected $fillable = [
        'operacion_id',
        'factura_id',
        'fecha_curse',
        'estado',
        'monto_factura',
        'monto_anticipo',
        'comision',
        'interes',
        'monto_liquidado',
        'observaciones',
    ];

    protected $casts = [
        'fecha_curse' => 'date',
        'monto_factura' => 'decimal:2',
        'monto_anticipo' => 'decimal:2',
        'comision' => 'decimal:2',
        'interes' => 'decimal:2',
        'monto_liquidado' => 'decimal:2',
    ];

    /**
     * Operación asociada al factoring.
     */
    public function operacion(): BelongsTo
    {
        return $this->belongsTo(Operacion::class);
    }

    /**
     * Factura asociada al factoring.
     */
    public function factura(): BelongsTo
    {
        return $this->belongsTo(Factura::class);
    }
}