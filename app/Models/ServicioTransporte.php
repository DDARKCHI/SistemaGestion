<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicioTransporte extends Model
{
    use HasFactory;

    protected $table = 'servicio_transportes';

    protected $fillable = [
        'operacion_id',
        'transportista_id',
        'vehiculo_id',
        'fecha_servicio',
        'tipo_servicio',
        'monto',
        'observaciones',
    ];

    protected $casts = [
        'fecha_servicio' => 'date',
        'monto' => 'decimal:2',
    ];

    /**
     * Operación asociada al servicio.
     */
    public function operacion(): BelongsTo
    {
        return $this->belongsTo(Operacion::class);
    }

    /**
     * Transportista que realizó el servicio.
     */
    public function transportista(): BelongsTo
    {
        return $this->belongsTo(Transportista::class);
    }

    /**
     * Vehículo utilizado en el servicio.
     */
    public function vehiculo(): BelongsTo
    {
        return $this->belongsTo(Vehiculo::class);
    }
}