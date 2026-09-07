<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Trabajador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ContratoController extends Controller
{
    public function create(Trabajador $trabajador): View
    {
        return view(
            'trabajadores.contratos.create',
            compact('trabajador')
        );
    }

    public function store(
        Request $request,
        Trabajador $trabajador
    ): RedirectResponse {
        $datos = $request->validate(
            [
                'tipo' => ['required', 'string', 'max:100'],
                'fecha_inicio' => ['required', 'date'],
                'fecha_termino' => [
                    'nullable',
                    'date',
                    'after_or_equal:fecha_inicio',
                ],
                'estado' => ['required', 'string', 'max:50'],
                'remuneracion' => ['nullable', 'numeric', 'min:0'],
                'horas_semanales' => ['nullable', 'numeric', 'min:0'],
                'horas_mensuales' => ['nullable', 'numeric', 'min:0'],
                'observaciones' => ['nullable', 'string'],

                'contrato_archivo' => [
                    'nullable',
                    'file',
                    'max:20480',
                    'mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx',
                ],
            ],
            [
                'tipo.required' =>
                    'El tipo de contrato es obligatorio.',

                'tipo.max' =>
                    'El tipo de contrato no puede superar los 100 caracteres.',

                'fecha_inicio.required' =>
                    'La fecha de inicio es obligatoria.',

                'fecha_inicio.date' =>
                    'La fecha de inicio no es válida.',

                'fecha_termino.date' =>
                    'La fecha de término no es válida.',

                'fecha_termino.after_or_equal' =>
                    'La fecha de término debe ser igual o posterior a la fecha de inicio.',

                'estado.required' =>
                    'El estado del contrato es obligatorio.',

                'estado.max' =>
                    'El estado no puede superar 50 caracteres.',

                'remuneracion.numeric' =>
                    'La remuneración debe ser un valor numérico.',

                'remuneracion.min' =>
                    'La remuneración no puede ser negativa.',

                'horas_semanales.numeric' =>
                    'Las horas semanales deben ser numéricas.',

                'horas_semanales.min' =>
                    'Las horas semanales no pueden ser negativas.',

                'horas_mensuales.numeric' =>
                    'Las horas mensuales deben ser numéricas.',

                'horas_mensuales.min' =>
                    'Las horas mensuales no pueden ser negativas.',

                'observaciones.string' =>
                    'Las observaciones ingresadas no son válidas.',

                'contrato_archivo.file' =>
                    'El archivo seleccionado no es válido.',

                'contrato_archivo.max' =>
                    'El archivo no puede superar los 20 MB.',

                'contrato_archivo.mimes' =>
                    'El contrato debe ser PDF, imagen, Word o Excel.',
            ]
        );

        $datos['trabajador_id'] = $trabajador->id;

        $contrato = Contrato::create($datos);

        if ($request->hasFile('contrato_archivo')) {
            $archivo = $request->file('contrato_archivo');

            $ruta = $archivo->store(
                'contratos',
                'public'
            );

            $contrato->documentos()->create([
                'nombre' => $archivo->getClientOriginalName(),
                'tipo' => 'Contrato',
                'ruta' => $ruta,
                'mime_type' => $archivo->getClientMimeType(),
                'tamano' => $archivo->getSize(),
                'descripcion' => 'Contrato asociado al trabajador.',
            ]);
        }

        return redirect()
            ->route('trabajadores.show', $trabajador)
            ->with(
                'success',
                'Contrato creado correctamente.'
                . ($request->hasFile('contrato_archivo')
                    ? ' El documento quedó asociado al contrato.'
                    : '')
            );
    }
}