<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotaCreditoProveedor extends Model
{
    use HasFactory;

    protected $table = 'nota_credito_proveedores';

    protected $fillable = [
        'proveedor_id',
        'numero_nota',
        'fecha',
        'monto',
        'motivo',
        'estado',
        'fecha_recuperacion',
        'observaciones',
    ];

    protected $casts = [
        'fecha' => 'date',
        'fecha_recuperacion' => 'date',
        'monto' => 'decimal:2',
    ];

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }
}