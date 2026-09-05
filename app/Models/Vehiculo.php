<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculos';

    protected $fillable = [
        'transportista_id',
        'patente',
        'tipo',
        'marca',
        'modelo',
        'anio',
        'observaciones',
    ];

    protected $casts = [
        'anio' => 'integer',
    ];

    /**
     * Transportista asociado al vehículo.
     */
    public function transportista(): BelongsTo
    {
        return $this->belongsTo(Transportista::class);
    }

    /**
     * Servicios de transporte realizados con este vehículo.
     */
    public function serviciosTransporte(): HasMany
    {
        return $this->hasMany(ServicioTransporte::class);
    }
}