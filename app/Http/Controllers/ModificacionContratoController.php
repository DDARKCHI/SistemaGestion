<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Trabajador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModificacionContratoController extends Controller
{
    public function create(
        Trabajador $trabajador,
        Contrato $contrato
    ): View {
        abort_unless(
            $contrato->trabajador_id === $trabajador->id,
            404
        );

        return view(
            'trabajadores.contratos.modificaciones.create',
            compact('trabajador', 'contrato')
        );
    }

    public function store(
        Request $request,
        Trabajador $trabajador,
        Contrato $contrato
    ): RedirectResponse {
        abort_unless(
            $contrato->trabajador_id === $trabajador->id,
            404
        );

        $datos = $request->validate(
            [
                'tipo' => ['required', 'string', 'max:100'],
                'fecha' => ['required', 'date'],
                'descripcion' => ['required', 'string'],
                'nueva_remuneracion' => [
                    'nullable',
                    'numeric',
                    'min:0',
                ],
                'nuevo_bono' => [
                    'nullable',
                    'numeric',
                    'min:0',
                ],
                'observaciones' => [
                    'nullable',
                    'string',
                ],
                'documento' => [
                    'nullable',
                    'file',
                    'max:20480',
                    'mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx',
                ],
            ],
            [
                'tipo.required' =>
                    'El tipo de modificación es obligatorio.',

                'tipo.max' =>
                    'El tipo de modificación no puede superar los 100 caracteres.',

                'fecha.required' =>
                    'La fecha de la modificación es obligatoria.',

                'fecha.date' =>
                    'La fecha de la modificación no es válida.',

                'descripcion.required' =>
                    'La descripción de la modificación es obligatoria.',

                'nueva_remuneracion.numeric' =>
                    'La nueva remuneración debe ser numérica.',

                'nueva_remuneracion.min' =>
                    'La nueva remuneración no puede ser negativa.',

                'nuevo_bono.numeric' =>
                    'El nuevo bono debe ser numérico.',

                'nuevo_bono.min' =>
                    'El nuevo bono no puede ser negativo.',

                'observaciones.string' =>
                    'Las observaciones ingresadas no son válidas.',

                'documento.file' =>
                    'El archivo seleccionado no es válido.',

                'documento.max' =>
                    'El archivo no puede superar los 20 MB.',

                'documento.mimes' =>
                    'El documento debe ser PDF, imagen, Word o Excel.',
            ]
        );

        $datos['contrato_id'] = $contrato->id;

        $modificacion = $contrato->modificaciones()->create($datos);

        if ($request->hasFile('documento')) {
            $archivo = $request->file('documento');

            $ruta = $archivo->store(
                'modificaciones-contrato',
                'public'
            );

            $modificacion->documentos()->create([
                'nombre' => $archivo->getClientOriginalName(),
                'tipo' => 'Anexo / modificación contractual',
                'ruta' => $ruta,
                'mime_type' => $archivo->getClientMimeType(),
                'tamano' => $archivo->getSize(),
                'descripcion' =>
                    'Documento asociado a una modificación contractual.',
            ]);
        }

        return redirect()
            ->route(
                'trabajadores.show',
                $trabajador
            )
            ->with(
                'success',
                'Modificación contractual registrada correctamente.'
                . ($request->hasFile('documento')
                    ? ' El documento quedó asociado a la modificación.'
                    : '')
            );
    }
}