<?php

namespace App\Http\Controllers;

use App\Models\EmpresaFactoring;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class EmpresaFactoringController extends Controller
{
    /**
     * Mostrar listado de empresas de factoring.
     */
    public function index(): View
    {
        $empresasFactoring = EmpresaFactoring::query()
            ->withCount('factorings')
            ->orderBy('nombre')
            ->get();

        return view(
            'empresas-factoring.index',
            compact('empresasFactoring')
        );
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create(): View
    {
        return view('empresas-factoring.create');
    }

    /**
     * Registrar una nueva empresa de factoring.
     */
    public function store(Request $request): RedirectResponse
    {
        $datos = $this->validarDatos($request);

        $empresaFactoring = EmpresaFactoring::create($datos);

        return redirect()
            ->route(
                'empresas-factoring.show',
                $empresaFactoring
            )
            ->with(
                'success',
                'Empresa de factoring registrada correctamente.'
            );
    }

    /**
     * Mostrar ficha de la empresa de factoring.
     */
    public function show(
        EmpresaFactoring $empresaFactoring
    ): View {
        $empresaFactoring->load([
            'factorings' => function ($query) {
                $query
                    ->with([
                        'operacion.cliente',
                        'factura',
                    ])
                    ->orderByDesc('fecha_curse')
                    ->orderByDesc('id');
            },
        ]);

        return view(
            'empresas-factoring.show',
            compact('empresaFactoring')
        );
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(
        EmpresaFactoring $empresaFactoring
    ): View {
        return view(
            'empresas-factoring.edit',
            compact('empresaFactoring')
        );
    }

    /**
     * Actualizar empresa de factoring.
     */
    public function update(
        Request $request,
        EmpresaFactoring $empresaFactoring
    ): RedirectResponse {
        $datos = $this->validarDatos(
            $request,
            $empresaFactoring
        );

        $empresaFactoring->update($datos);

        return redirect()
            ->route(
                'empresas-factoring.show',
                $empresaFactoring
            )
            ->with(
                'success',
                'Empresa de factoring actualizada correctamente.'
            );
    }

    /**
     * Eliminar empresa de factoring.
     */
    public function destroy(
        EmpresaFactoring $empresaFactoring
    ): RedirectResponse {
        if ($empresaFactoring->factorings()->exists()) {
            return redirect()
                ->route(
                    'empresas-factoring.show',
                    $empresaFactoring
                )
                ->with(
                    'error',
                    'No se puede eliminar esta empresa de factoring porque tiene operaciones de factoring asociadas.'
                );
        }

        try {
            $empresaFactoring->delete();
        } catch (QueryException $exception) {
            return redirect()
                ->route(
                    'empresas-factoring.show',
                    $empresaFactoring
                )
                ->with(
                    'error',
                    'No se puede eliminar esta empresa de factoring porque tiene registros asociados.'
                );
        }

        return redirect()
            ->route('empresas-factoring.index')
            ->with(
                'success',
                'Empresa de factoring eliminada correctamente.'
            );
    }

    /**
     * Validar datos de la empresa.
     */
    private function validarDatos(
        Request $request,
        ?EmpresaFactoring $empresaFactoring = null
    ): array {
        $empresaId = $empresaFactoring?->id;

        return $request->validate(
            [
                'nombre' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'rut' => [
                    'required',
                    'string',
                    'max:20',
                    Rule::unique(
                        'empresas_factoring',
                        'rut'
                    )->ignore($empresaId),
                ],

                'correo' => [
                    'nullable',
                    'email',
                    'max:255',
                ],

                'telefono' => [
                    'nullable',
                    'string',
                    'max:50',
                ],

                'ejecutivo' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'telefono_ejecutivo' => [
                    'nullable',
                    'string',
                    'max:50',
                ],

                'cuenta_bancaria' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'otros_datos' => [
                    'nullable',
                    'string',
                ],

                'estado' => [
                    'required',
                    Rule::in([
                        'activo',
                        'inactivo',
                    ]),
                ],
            ],
            [
                'nombre.required' =>
                    'El nombre de la empresa de factoring es obligatorio.',

                'nombre.string' =>
                    'El nombre de la empresa de factoring no es válido.',

                'nombre.max' =>
                    'El nombre de la empresa de factoring no puede superar los 255 caracteres.',

                'rut.required' =>
                    'El RUT de la empresa de factoring es obligatorio.',

                'rut.string' =>
                    'El RUT ingresado no es válido.',

                'rut.max' =>
                    'El RUT no puede superar los 20 caracteres.',

                'rut.unique' =>
                    'Ya existe una empresa de factoring registrada con este RUT.',

                'correo.email' =>
                    'El correo electrónico ingresado no es válido.',

                'correo.max' =>
                    'El correo electrónico no puede superar los 255 caracteres.',

                'telefono.max' =>
                    'El teléfono no puede superar los 50 caracteres.',

                'ejecutivo.max' =>
                    'El nombre del ejecutivo no puede superar los 255 caracteres.',

                'telefono_ejecutivo.max' =>
                    'El teléfono del ejecutivo no puede superar los 50 caracteres.',

                'cuenta_bancaria.max' =>
                    'La cuenta bancaria no puede superar los 255 caracteres.',

                'estado.required' =>
                    'El estado de la empresa es obligatorio.',

                'estado.in' =>
                    'El estado seleccionado no es válido.',
            ]
        );
    }
}
