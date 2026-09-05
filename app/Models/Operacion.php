<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Operacion extends Model
{
    use HasFactory;

    protected $table = 'operaciones';

    protected $fillable = [
        'cliente_id',
        'numero_operacion',
        'tipo',
        'fecha_operacion',
        'fecha_curse',
        'estado',
        'descripcion',
        'observaciones',
    ];

    protected $casts = [
        'fecha_operacion' => 'date',
        'fecha_curse' => 'date',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function entregas(): HasMany
    {
        return $this->hasMany(Entrega::class);
    }

    public function documentos(): MorphMany
    {
        return $this->morphMany(Documento::class, 'documentable');
    }

    public function facturas(): HasMany
    {
        return $this->hasMany(Factura::class);
    }

    public function factorings(): HasMany
    {
        return $this->hasMany(Factoring::class);
    }

    public function morasOrigen(): HasMany
    {
        return $this->hasMany(Mora::class, 'operacion_origen_id');
    }

    public function morasDestino(): HasMany
    {
        return $this->hasMany(Mora::class, 'operacion_destino_id');
    }

    public function gastos(): HasMany
    {
        return $this->hasMany(Gasto::class);
    }

    public function serviciosTransporte(): HasMany
    {
        return $this->hasMany(ServicioTransporte::class);
    }

    public function cuadraturas(): HasMany
    {
        return $this->hasMany(Cuadratura::class);
    }

    public function reclamos(): HasMany
    {
        return $this->hasMany(Reclamo::class);
    }

    /**
     * Juicios relacionados con la operación.
     */
    public function juicios(): HasMany
    {
        return $this->hasMany(Juicio::class);
    }
}