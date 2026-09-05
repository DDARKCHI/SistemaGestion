<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'razon_social',
        'rut',
        'comuna',
        'telefono',
        'correo',
        'direccion',
        'observaciones',
    ];

    /**
     * Operaciones del cliente.
     */
    public function operaciones(): HasMany
    {
        return $this->hasMany(Operacion::class);
    }

    /**
     * Reclamos presentados por el cliente.
     */
    public function reclamos(): HasMany
    {
        return $this->hasMany(Reclamo::class);
    }

    /**
     * Juicios relacionados con el cliente.
     */
    public function juicios(): HasMany
    {
        return $this->hasMany(Juicio::class);
    }

    /**
     * Contratos de suministro del cliente.
     */
    public function contratosSuministro(): HasMany
    {
        return $this->hasMany(ContratoSuministro::class);
    }
}