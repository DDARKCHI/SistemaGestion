<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Trabajador extends Model
{
    use HasFactory;

    protected $table = 'trabajadores';

    protected $fillable = [
        'nombre',
        'rut',
        'direccion',
        'telefono',
        'correo',
        'fecha_ingreso',
        'remuneracion_acordada',
        'observaciones',
    ];

    protected $casts = [
        'fecha_ingreso' => 'date',
        'remuneracion_acordada' => 'decimal:2',
    ];

    /**
     * Contratos del trabajador.
     */
    public function contratos(): HasMany
    {
        return $this->hasMany(Contrato::class);
    }

    /**
     * Documentos asociados al trabajador.
     */
    public function documentos(): MorphMany
    {
        return $this->morphMany(Documento::class, 'documentable');
    }

    /**
     * Horarios del trabajador.
     */
    public function horarios(): HasMany
    {
        return $this->hasMany(Horario::class);
    }

    /**
     * Remuneraciones del trabajador.
     */
    public function remuneraciones(): HasMany
    {
        return $this->hasMany(Remuneracion::class);
    }

    /**
     * Períodos de vacaciones del trabajador.
     */
    public function vacaciones(): HasMany
    {
        return $this->hasMany(Vacacion::class);
    }

    /**
     * Ausencias del trabajador.
     */
    public function ausencias(): HasMany
    {
        return $this->hasMany(Ausencia::class);
    }

    /**
     * Faltas del trabajador.
     */
    public function faltas(): HasMany
    {
        return $this->hasMany(Falta::class);
    }

    /**
     * Permisos del trabajador.
     */
    public function permisos(): HasMany
    {
        return $this->hasMany(Permiso::class);
    }

    /**
     * Cuadraturas asociadas al trabajador.
     */
    public function cuadraturas(): HasMany
    {
        return $this->hasMany(Cuadratura::class);
    }
}