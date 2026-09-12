<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Gasto extends Model
{
    use HasFactory;

    protected $table = 'gastos';

    protected $fillable = [
        'operacion_id',
        'transportista_id',
        'fecha',
        'tipo',
        'descripcion',
        'monto',
        'observaciones',
    ];

    protected $casts = [
        'fecha' => 'date',
        'monto' => 'decimal:2',
    ];

    /**
     * Operación a la que pertenece el gasto.
     */
    public function operacion(): BelongsTo
    {
        return $this->belongsTo(Operacion::class);
    }

    /**
     * Transportista asociado al gasto.
     */
    public function transportista(): BelongsTo
    {
        return $this->belongsTo(Transportista::class);
    }

    /**
     * Documentos asociados al gasto.
     */
    public function documentos(): MorphMany
    {
        return $this->morphMany(Documento::class, 'documentable');
    }
}