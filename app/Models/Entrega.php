<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Entrega extends Model
{
    use HasFactory;

    protected $table = 'entregas';

    protected $fillable = [
        'operacion_id',
        'fecha_entrega',
        'numero_entrega',
        'estado',
        'descripcion',
        'observaciones',
    ];

    protected $casts = [
        'fecha_entrega' => 'date',
    ];

    public function operacion(): BelongsTo
    {
        return $this->belongsTo(Operacion::class);
    }

    public function documentos(): MorphMany
    {
        return $this->morphMany(
            Documento::class,
            'documentable'
        );
    }
}