<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProveedorBodega extends Model
{
    use HasFactory;

    protected $table = 'proveedor_bodegas';

    protected $fillable = [
        'proveedor_id',
        'nombre',
        'direccion',
        'localidad',
        'observaciones',
    ];

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }
}