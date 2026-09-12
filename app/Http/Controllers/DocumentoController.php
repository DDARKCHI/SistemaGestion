<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Gasto;
use App\Models\Operacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DocumentoController extends Controller
{
    /**
     * Mostrar todos los documentos.
     */
    public function index(): View
    {
        $documentos = Documento::with('documentable')
            ->orderByDesc('created_at')
            ->get();

        return view('documentos.index', compact('documentos'));
    }

    /**
     * Mostrar formulario para subir un documento.
     */
    public function create(): View
    {
        $operaciones = Operacion::with('cliente')
            ->orderByDesc('fecha_curse')
            ->orderByDesc('id')
            ->get();

        $gastos = Gasto::with([
                'operacion.cliente',
                'transportista',
            ])
            ->orderByDesc('fecha')
            ->orderByDesc('id')
            ->get();

        return view(
            'documentos.create',
            compact(
                'operaciones',
                'gastos'
            )
        );
    }

    /**
     * Guardar un nuevo documento.
     */
    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'registro_tipo' => [
                'required',
                'in:operacion,gasto',
            ],

            'registro_id' => [
                'required',
                'integer',
            ],

            'archivo' => [
                'required',
                'file',
                'max:10240',
            ],

            'tipo' => [
                'nullable',
                'string',
                'max:255',
            ],

            'descripcion' => [
                'nullable',
                'string',
            ],

            'observaciones' => [
                'nullable',
                'string',
            ],
        ]);

        $modelo = $this->obtenerModeloAsociado(
            $datos['registro_tipo'],
            $datos['registro_id']
        );

        if (!$modelo) {
            return back()
                ->withErrors([
                    'registro_id' =>
                        'El registro seleccionado no existe.',
                ])
                ->withInput();
        }

        $archivo = $request->file('archivo');

        $ruta = $archivo->store(
            'documentos',
            'public'
        );

        Documento::create([
            'documentable_type' =>
                get_class($modelo),

            'documentable_id' =>
                $modelo->id,

            'nombre' =>
                $archivo->getClientOriginalName(),

            'tipo' =>
                $datos['tipo'] ?? null,

            'ruta' =>
                $ruta,

            'mime_type' =>
                $archivo->getMimeType(),

            'tamano' =>
                $archivo->getSize(),

            'descripcion' =>
                $datos['descripcion'] ?? null,

            'observaciones' =>
                $datos['observaciones'] ?? null,
        ]);

        return redirect()
            ->route('documentos.index')
            ->with(
                'success',
                'Documento subido correctamente.'
            );
    }

    /**
     * Mostrar información del documento.
     */
    public function show(Documento $documento): View
    {
        $documento->load([
            'documentable',
        ]);

        return view(
            'documentos.show',
            compact('documento')
        );
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Documento $documento): View
    {
        $operaciones = Operacion::with('cliente')
            ->orderByDesc('fecha_curse')
            ->orderByDesc('id')
            ->get();

        $gastos = Gasto::with([
                'operacion.cliente',
                'transportista',
            ])
            ->orderByDesc('fecha')
            ->orderByDesc('id')
            ->get();

        $documento->load([
            'documentable',
        ]);

        return view(
            'documentos.edit',
            compact(
                'documento',
                'operaciones',
                'gastos'
            )
        );
    }

    /**
     * Actualizar información del documento.
     */
    public function update(
        Request $request,
        Documento $documento
    ): RedirectResponse {
        $datos = $request->validate([
            'registro_tipo' => [
                'required',
                'in:operacion,gasto',
            ],

            'registro_id' => [
                'required',
                'integer',
            ],

            'archivo' => [
                'nullable',
                'file',
                'max:10240',
            ],

            'tipo' => [
                'nullable',
                'string',
                'max:255',
            ],

            'descripcion' => [
                'nullable',
                'string',
            ],

            'observaciones' => [
                'nullable',
                'string',
            ],
        ]);

        $modelo = $this->obtenerModeloAsociado(
            $datos['registro_tipo'],
            $datos['registro_id']
        );

        if (!$modelo) {
            return back()
                ->withErrors([
                    'registro_id' =>
                        'El registro seleccionado no existe.',
                ])
                ->withInput();
        }

        $documento->documentable_type =
            get_class($modelo);

        $documento->documentable_id =
            $modelo->id;

        $documento->tipo =
            $datos['tipo'] ?? null;

        $documento->descripcion =
            $datos['descripcion'] ?? null;

        $documento->observaciones =
            $datos['observaciones'] ?? null;

        if ($request->hasFile('archivo')) {

            $archivo =
                $request->file('archivo');

            if (
                $documento->ruta &&
                Storage::disk('public')->exists(
                    $documento->ruta
                )
            ) {
                Storage::disk('public')->delete(
                    $documento->ruta
                );
            }

            $ruta = $archivo->store(
                'documentos',
                'public'
            );

            $documento->nombre =
                $archivo->getClientOriginalName();

            $documento->ruta =
                $ruta;

            $documento->mime_type =
                $archivo->getMimeType();

            $documento->tamano =
                $archivo->getSize();
        }

        $documento->save();

        return redirect()
            ->route(
                'documentos.show',
                $documento
            )
            ->with(
                'success',
                'Documento actualizado correctamente.'
            );
    }

    /**
     * Eliminar documento y archivo físico.
     */
    public function destroy(
        Documento $documento
    ): RedirectResponse {
        if (
            $documento->ruta &&
            Storage::disk('public')->exists(
                $documento->ruta
            )
        ) {
            Storage::disk('public')->delete(
                $documento->ruta
            );
        }

        $documento->delete();

        return redirect()
            ->route('documentos.index')
            ->with(
                'success',
                'Documento eliminado correctamente.'
            );
    }

    /**
     * Obtener el modelo asociado según el tipo
     * de registro seleccionado.
     */
    private function obtenerModeloAsociado(
        string $tipo,
        int $id
    ): ?object {
        return match ($tipo) {

            'operacion' =>
                Operacion::find($id),

            'gasto' =>
                Gasto::find($id),

            default =>
                null,
        };
    }
}