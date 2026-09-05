<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Documento;
use App\Models\Operacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OperacionController extends Controller
{
    public function index(): View
    {
        $operaciones = Operacion::with('cliente')
            ->orderByDesc('fecha_operacion')
            ->orderByDesc('id')
            ->get();

        return view('operaciones.index', compact('operaciones'));
    }

    public function create(): View
    {
        $clientes = Cliente::orderBy('razon_social')->get();

        return view('operaciones.create', compact('clientes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'cliente_id' => ['required', 'exists:clientes,id'],
            'numero_operacion' => [
                'required',
                'string',
                'max:255',
                'unique:operaciones,numero_operacion',
            ],
            'tipo' => ['nullable', 'string', 'max:255'],
            'fecha_operacion' => ['nullable', 'date'],
            'fecha_curse' => ['nullable', 'date'],
            'estado' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'observaciones' => ['nullable', 'string'],

            'documentos' => ['nullable', 'array'],
            'documentos.*.archivo' => [
                'nullable',
                'file',
                'max:10240',
            ],
            'documentos.*.tipo' => [
                'nullable',
                'string',
                'max:255',
            ],
            'documentos.*.descripcion' => [
                'nullable',
                'string',
            ],
            'documentos.*.observaciones' => [
                'nullable',
                'string',
            ],
        ]);

        $operacion = Operacion::create([
            'cliente_id' => $datos['cliente_id'],
            'numero_operacion' => $datos['numero_operacion'],
            'tipo' => $datos['tipo'] ?? null,
            'fecha_operacion' => $datos['fecha_operacion'] ?? null,
            'fecha_curse' => $datos['fecha_curse'] ?? null,
            'estado' => $datos['estado'],
            'descripcion' => $datos['descripcion'] ?? null,
            'observaciones' => $datos['observaciones'] ?? null,
        ]);

        if ($request->has('documentos')) {

            foreach ($request->file('documentos', []) as $indice => $documento) {

                if (
                    !isset($documento['archivo']) ||
                    !$documento['archivo']
                ) {
                    continue;
                }

                $archivo = $documento['archivo'];

                $ruta = $archivo->store(
                    'documentos',
                    'public'
                );

                Documento::create([
                    'documentable_type' => Operacion::class,
                    'documentable_id' => $operacion->id,
                    'nombre' => $archivo->getClientOriginalName(),
                    'tipo' => $request->input(
                        "documentos.$indice.tipo"
                    ),
                    'ruta' => $ruta,
                    'mime_type' => $archivo->getMimeType(),
                    'tamano' => $archivo->getSize(),
                    'descripcion' => $request->input(
                        "documentos.$indice.descripcion"
                    ),
                    'observaciones' => $request->input(
                        "documentos.$indice.observaciones"
                    ),
                ]);
            }
        }

        return redirect()
            ->route('operaciones.show', $operacion)
            ->with('success', 'Operación creada correctamente.');
    }

    public function show(Operacion $operacion): View
    {
        $operacion->load([
            'cliente',
            'entregas',
            'documentos',
            'facturas',
            'factorings',
            'morasOrigen',
            'morasDestino',
            'gastos',
            'serviciosTransporte',
            'cuadraturas',
            'reclamos',
            'juicios',
        ]);

        return view('operaciones.show', compact('operacion'));
    }

    public function edit(Operacion $operacion): View
    {
        $clientes = Cliente::orderBy('razon_social')->get();

        return view('operaciones.edit', compact(
            'operacion',
            'clientes'
        ));
    }

    public function update(
        Request $request,
        Operacion $operacion
    ): RedirectResponse {
        $datos = $request->validate([
            'cliente_id' => ['required', 'exists:clientes,id'],
            'numero_operacion' => [
                'required',
                'string',
                'max:255',
                'unique:operaciones,numero_operacion,' . $operacion->id,
            ],
            'tipo' => ['nullable', 'string', 'max:255'],
            'fecha_operacion' => ['nullable', 'date'],
            'fecha_curse' => ['nullable', 'date'],
            'estado' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'observaciones' => ['nullable', 'string'],
        ]);

        $operacion->update($datos);

        return redirect()
            ->route('operaciones.show', $operacion)
            ->with('success', 'Operación actualizada correctamente.');
    }

    public function destroy(Operacion $operacion): RedirectResponse
    {
        $operacion->delete();

        return redirect()
            ->route('operaciones.index')
            ->with('success', 'Operación eliminada correctamente.');
    }

    /**
     * Guardar un documento directamente desde una operación.
     */
    public function storeDocumento(
        Request $request,
        Operacion $operacion
    ): RedirectResponse {
        $datos = $request->validate([
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

        $archivo = $request->file('archivo');

        $ruta = $archivo->store(
            'documentos',
            'public'
        );

        Documento::create([
            'documentable_type' => Operacion::class,
            'documentable_id' => $operacion->id,
            'nombre' => $archivo->getClientOriginalName(),
            'tipo' => $datos['tipo'] ?? null,
            'ruta' => $ruta,
            'mime_type' => $archivo->getMimeType(),
            'tamano' => $archivo->getSize(),
            'descripcion' => $datos['descripcion'] ?? null,
            'observaciones' => $datos['observaciones'] ?? null,
        ]);

        return redirect()
            ->route('operaciones.show', $operacion)
            ->with('success', 'Documento adjuntado correctamente.');
    }

    /**
     * Eliminar un documento desde una operación.
     */
    public function destroyDocumento(
        Operacion $operacion,
        Documento $documento
    ): RedirectResponse {
        if (
            $documento->documentable_type !== Operacion::class ||
            $documento->documentable_id !== $operacion->id
        ) {
            abort(404);
        }

        if (
            $documento->ruta &&
            Storage::disk('public')->exists($documento->ruta)
        ) {
            Storage::disk('public')->delete(
                $documento->ruta
            );
        }

        $documento->delete();

        return redirect()
            ->route('operaciones.show', $operacion)
            ->with('success', 'Documento eliminado correctamente.');
    }
}