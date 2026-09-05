<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transportista extends Model
{
    use HasFactory;

    protected $table = 'transportistas';

    protected $fillable = [
        'nombre',
        'rut',
        'telefono',
        'correo',
        'direccion',
        'observaciones',
    ];

    /**
     * Vehículos del transportista.
     */
    public function vehiculos(): HasMany
    {
        return $this->hasMany(Vehiculo::class);
    }

    /**
     * Servicios de transporte realizados.
     */
    public function serviciosTransporte(): HasMany
    {
        return $this->hasMany(ServicioTransporte::class);
    }

    /**
     * Gastos asociados al transportista.
     */
    public function gastos(): HasMany
    {
        return $this->hasMany(Gasto::class);
    }
}