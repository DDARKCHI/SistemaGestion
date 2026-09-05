<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\Operacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EntregaController extends Controller
{
    public function index(): View
    {
        $entregas = Entrega::with('operacion')
            ->orderByDesc('fecha_entrega')
            ->orderByDesc('id')
            ->get();

        return view('entregas.index', compact('entregas'));
    }

    public function create(): View
    {
        $operaciones = Operacion::with('cliente')
            ->orderByDesc('fecha_curse')
            ->orderByDesc('id')
            ->get();

        return view('entregas.create', compact('operaciones'));
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'operacion_id' => ['required', 'exists:operaciones,id'],
            'fecha_entrega' => ['nullable', 'date'],
            'numero_entrega' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'observaciones' => ['nullable', 'string'],
        ]);

        Entrega::create($datos);

        return redirect()
            ->route('entregas.index')
            ->with('success', 'Entrega creada correctamente.');
    }

    public function show(Entrega $entrega): View
    {
        $entrega->load('operacion.cliente');

        return view('entregas.show', compact('entrega'));
    }

    public function edit(Entrega $entrega): View
    {
        $operaciones = Operacion::with('cliente')
            ->orderByDesc('fecha_curse')
            ->orderByDesc('id')
            ->get();

        return view('entregas.edit', compact('entrega', 'operaciones'));
    }

    public function update(
        Request $request,
        Entrega $entrega
    ): RedirectResponse {
        $datos = $request->validate([
            'operacion_id' => ['required', 'exists:operaciones,id'],
            'fecha_entrega' => ['nullable', 'date'],
            'numero_entrega' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'observaciones' => ['nullable', 'string'],
        ]);

        $entrega->update($datos);

        return redirect()
            ->route('entregas.index')
            ->with('success', 'Entrega actualizada correctamente.');
    }

    public function destroy(Entrega $entrega): RedirectResponse
    {
        $entrega->delete();

        return redirect()
            ->route('entregas.index')
            ->with('success', 'Entrega eliminada correctamente.');
    }
}