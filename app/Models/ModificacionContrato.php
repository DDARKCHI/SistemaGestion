<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ModificacionContrato extends Model
{
    use HasFactory;

    protected $table = 'modificacion_contratos';

    protected $fillable = [
        'contrato_id',
        'tipo',
        'fecha',
        'descripcion',
        'nueva_remuneracion',
        'nuevo_bono',
        'observaciones',
    ];

    protected $casts = [
        'fecha' => 'date',
        'nueva_remuneracion' => 'decimal:2',
        'nuevo_bono' => 'decimal:2',
    ];

    public function contrato(): BelongsTo
    {
        return $this->belongsTo(Contrato::class);
    }

    public function documentos(): MorphMany
    {
        return $this->morphMany(
            Documento::class,
            'documentable'
        );
    }
}