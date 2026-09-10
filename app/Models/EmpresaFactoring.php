<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmpresaFactoring extends Model
{
    use HasFactory;

    protected $table = 'empresas_factoring';

    protected $fillable = [
        'nombre',
        'rut',
        'correo',
        'telefono',
        'ejecutivo',
        'telefono_ejecutivo',
        'cuenta_bancaria',
        'otros_datos',
        'estado',
    ];

    /**
     * Operaciones de factoring asociadas a esta empresa.
     */
    public function factorings(): HasMany
    {
        return $this->hasMany(
            Factoring::class,
            'empresa_factoring_id'
        );
    }
}