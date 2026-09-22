<?php

namespace App\Http\Controllers;

use App\Models\Cuadratura;
use App\Models\Operacion;
use App\Models\Trabajador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CuadraturaController extends Controller
{
    public function create(Trabajador $trabajador): View
    {
        $operaciones = Operacion::orderByDesc('id')->get();

        return view(
            'cuadraturas.create',
            compact('trabajador', 'operaciones')
        );
    }

    public function store(
        Request $request,
        Trabajador $trabajador
    ): RedirectResponse {

        $datos = $request->validate(
            [
                'operacion_id' => [
                    'required',
                    'exists:operaciones,id',
                ],
                'periodo' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'fecha' => [
                    'nullable',
                    'date',
                ],
                'total_horas' => [
                    'required',
                    'numeric',
                    'min:0',
                ],
                'dinero_depositado' => [
                    'required',
                    'numeric',
                    'min:0',
                ],
                'gastos_facturados' => [
                    'required',
                    'numeric',
                    'min:0',
                ],
                'gastos_con_boleta' => [
                    'required',
                    'numeric',
                    'min:0',
                ],
                'gastos_sin_comprobante' => [
                    'required',
                    'numeric',
                    'min:0',
                ],
                'saldo_a_favor' => [
                    'required',
                    'numeric',
                    'min:0',
                ],
                'saldo_en_contra' => [
                    'required',
                    'numeric',
                    'min:0',
                ],
                'estado' => [
                    'required',
                    'in:pendiente,cuadrada,cerrada',
                ],
                'observaciones' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'operacion_id.required' =>
                    'La operación es obligatoria.',

                'operacion_id.exists' =>
                    'La operación seleccionada no es válida.',

                'periodo.required' =>
                    'El período es obligatorio.',

                'periodo.max' =>
                    'El período no puede superar los 255 caracteres.',

                'fecha.date' =>
                    'La fecha ingresada no es válida.',

                'total_horas.required' =>
                    'El total de horas es obligatorio.',

                'total_horas.numeric' =>
                    'El total de horas debe ser un número.',

                'total_horas.min' =>
                    'El total de horas no puede ser negativo.',

                'dinero_depositado.required' =>
                    'El dinero depositado es obligatorio.',

                'dinero_depositado.numeric' =>
                    'El dinero depositado debe ser un número.',

                'dinero_depositado.min' =>
                    'El dinero depositado no puede ser negativo.',

                'gastos_facturados.required' =>
                    'Los gastos facturados son obligatorios.',

                'gastos_facturados.numeric' =>
                    'Los gastos facturados deben ser un número.',

                'gastos_facturados.min' =>
                    'Los gastos facturados no pueden ser negativos.',

                'gastos_con_boleta.required' =>
                    'Los gastos con boleta son obligatorios.',

                'gastos_con_boleta.numeric' =>
                    'Los gastos con boleta deben ser un número.',

                'gastos_con_boleta.min' =>
                    'Los gastos con boleta no pueden ser negativos.',

                'gastos_sin_comprobante.required' =>
                    'Los gastos sin comprobante son obligatorios.',

                'gastos_sin_comprobante.numeric' =>
                    'Los gastos sin comprobante deben ser un número.',

                'gastos_sin_comprobante.min' =>
                    'Los gastos sin comprobante no pueden ser negativos.',

                'saldo_a_favor.required' =>
                    'El saldo a favor es obligatorio.',

                'saldo_a_favor.numeric' =>
                    'El saldo a favor debe ser un número.',

                'saldo_a_favor.min' =>
                    'El saldo a favor no puede ser negativo.',

                'saldo_en_contra.required' =>
                    'El saldo en contra es obligatorio.',

                'saldo_en_contra.numeric' =>
                    'El saldo en contra debe ser un número.',

                'saldo_en_contra.min' =>
                    'El saldo en contra no puede ser negativo.',

                'estado.required' =>
                    'El estado es obligatorio.',

                'estado.in' =>
                    'El estado seleccionado no es válido.',
            ]
        );

        $duplicada = Cuadratura::where(
            'trabajador_id',
            $trabajador->id
        )
            ->where(
                'operacion_id',
                $datos['operacion_id']
            )
            ->where(
                'periodo',
                $datos['periodo']
            )
            ->exists();

        if ($duplicada) {
            return back()
                ->withInput()
                ->withErrors([
                    'periodo' =>
                        'Ya existe una cuadratura para este trabajador, operación y período.',
                ]);
        }

        $datos['trabajador_id'] = $trabajador->id;

        Cuadratura::create($datos);

        return redirect()
            ->route('trabajadores.show', $trabajador)
            ->with(
                'success',
                'Cuadratura registrada correctamente.'
            );
    }

    public function edit(
        Trabajador $trabajador,
        Cuadratura $cuadratura
    ): View {

        $this->validarTrabajador(
            $trabajador,
            $cuadratura
        );

        $operaciones = Operacion::orderByDesc('id')->get();

        return view(
            'cuadraturas.edit',
            compact(
                'trabajador',
                'cuadratura',
                'operaciones'
            )
        );
    }

    public function update(
        Request $request,
        Trabajador $trabajador,
        Cuadratura $cuadratura
    ): RedirectResponse {

        $this->validarTrabajador(
            $trabajador,
            $cuadratura
        );

        $datos = $request->validate(
            [
                'operacion_id' => [
                    'required',
                    'exists:operaciones,id',
                ],
                'periodo' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'fecha' => [
                    'nullable',
                    'date',
                ],
                'total_horas' => [
                    'required',
                    'numeric',
                    'min:0',
                ],
                'dinero_depositado' => [
                    'required',
                    'numeric',
                    'min:0',
                ],
                'gastos_facturados' => [
                    'required',
                    'numeric',
                    'min:0',
                ],
                'gastos_con_boleta' => [
                    'required',
                    'numeric',
                    'min:0',
                ],
                'gastos_sin_comprobante' => [
                    'required',
                    'numeric',
                    'min:0',
                ],
                'saldo_a_favor' => [
                    'required',
                    'numeric',
                    'min:0',
                ],
                'saldo_en_contra' => [
                    'required',
                    'numeric',
                    'min:0',
                ],
                'estado' => [
                    'required',
                    'in:pendiente,cuadrada,cerrada',
                ],
                'observaciones' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'operacion_id.required' =>
                    'La operación es obligatoria.',

                'operacion_id.exists' =>
                    'La operación seleccionada no es válida.',

                'periodo.required' =>
                    'El período es obligatorio.',

                'periodo.max' =>
                    'El período no puede superar los 255 caracteres.',

                'fecha.date' =>
                    'La fecha ingresada no es válida.',

                'total_horas.required' =>
                    'El total de horas es obligatorio.',

                'total_horas.numeric' =>
                    'El total de horas debe ser un número.',

                'total_horas.min' =>
                    'El total de horas no puede ser negativo.',

                'dinero_depositado.required' =>
                    'El dinero depositado es obligatorio.',

                'dinero_depositado.numeric' =>
                    'El dinero depositado debe ser un número.',

                'dinero_depositado.min' =>
                    'El dinero depositado no puede ser negativo.',

                'gastos_facturados.required' =>
                    'Los gastos facturados son obligatorios.',

                'gastos_facturados.numeric' =>
                    'Los gastos facturados deben ser un número.',

                'gastos_facturados.min' =>
                    'Los gastos facturados no pueden ser negativos.',

                'gastos_con_boleta.required' =>
                    'Los gastos con boleta son obligatorios.',

                'gastos_con_boleta.numeric' =>
                    'Los gastos con boleta deben ser un número.',

                'gastos_con_boleta.min' =>
                    'Los gastos con boleta no pueden ser negativos.',

                'gastos_sin_comprobante.required' =>
                    'Los gastos sin comprobante son obligatorios.',

                'gastos_sin_comprobante.numeric' =>
                    'Los gastos sin comprobante deben ser un número.',

                'gastos_sin_comprobante.min' =>
                    'Los gastos sin comprobante no pueden ser negativos.',

                'saldo_a_favor.required' =>
                    'El saldo a favor es obligatorio.',

                'saldo_a_favor.numeric' =>
                    'El saldo a favor debe ser un número.',

                'saldo_a_favor.min' =>
                    'El saldo a favor no puede ser negativo.',

                'saldo_en_contra.required' =>
                    'El saldo en contra es obligatorio.',

                'saldo_en_contra.numeric' =>
                    'El saldo en contra debe ser un número.',

                'saldo_en_contra.min' =>
                    'El saldo en contra no puede ser negativo.',

                'estado.required' =>
                    'El estado es obligatorio.',

                'estado.in' =>
                    'El estado seleccionado no es válido.',
            ]
        );

        $duplicada = Cuadratura::where(
            'trabajador_id',
            $trabajador->id
        )
            ->where(
                'operacion_id',
                $datos['operacion_id']
            )
            ->where(
                'periodo',
                $datos['periodo']
            )
            ->where(
                'id',
                '!=',
                $cuadratura->id
            )
            ->exists();

        if ($duplicada) {
            return back()
                ->withInput()
                ->withErrors([
                    'periodo' =>
                        'Ya existe una cuadratura para este trabajador, operación y período.',
                ]);
        }

        $cuadratura->update($datos);

        return redirect()
            ->route('trabajadores.show', $trabajador)
            ->with(
                'success',
                'Cuadratura actualizada correctamente.'
            );
    }

    public function destroy(
        Trabajador $trabajador,
        Cuadratura $cuadratura
    ): RedirectResponse {

        $this->validarTrabajador(
            $trabajador,
            $cuadratura
        );

        $cuadratura->delete();

        return redirect()
            ->route('trabajadores.show', $trabajador)
            ->with(
                'success',
                'Cuadratura eliminada correctamente.'
            );
    }

    private function validarTrabajador(
        Trabajador $trabajador,
        Cuadratura $cuadratura
    ): void {

        abort_unless(
            (int) $cuadratura->trabajador_id ===
            (int) $trabajador->id,
            404
        );
    }
}