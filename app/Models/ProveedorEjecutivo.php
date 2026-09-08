<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProveedorEjecutivo extends Model
{
    use HasFactory;

    protected $table = 'proveedor_ejecutivos';

    protected $fillable = [
        'proveedor_id',
        'nombre',
        'cargo',
        'correo',
        'telefono',
        'observaciones',
    ];

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }
}