<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Documento extends Model
{
    use HasFactory;

    protected $table = 'documentos';

    protected $fillable = [
        'documentable_type',
        'documentable_id',
        'nombre',
        'tipo',
        'ruta',
        'mime_type',
        'tamano',
        'descripcion',
        'observaciones',
    ];

    /**
     * Registro al que pertenece el documento.
     */
    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }
}