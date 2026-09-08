<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = [
        'nombre',
        'rut',
        'localidad',
        'cuenta',
        'direccion',
        'correo',
        'telefono',
        'observaciones',
    ];

    public function bodegas(): HasMany
    {
        return $this->hasMany(ProveedorBodega::class);
    }

    public function ejecutivos(): HasMany
    {
        return $this->hasMany(ProveedorEjecutivo::class);
    }

    public function notasCredito(): HasMany
    {
        return $this->hasMany(NotaCreditoProveedor::class);
    }
}