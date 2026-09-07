<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\ModificacionContratoController;
use App\Http\Controllers\OperacionController;
use App\Http\Controllers\RemuneracionController;
use App\Http\Controllers\TrabajadorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('clientes.index');
});

Route::resource('clientes', ClienteController::class);

Route::resource('operaciones', OperacionController::class)
    ->parameters([
        'operaciones' => 'operacion',
    ]);

Route::post(
    'operaciones/{operacion}/documentos',
    [OperacionController::class, 'storeDocumento']
)->name('operaciones.documentos.store');

Route::delete(
    'operaciones/{operacion}/documentos/{documento}',
    [OperacionController::class, 'destroyDocumento']
)->name('operaciones.documentos.destroy');

Route::resource('entregas', EntregaController::class)
    ->parameters([
        'entregas' => 'entrega',
    ]);

Route::resource('trabajadores', TrabajadorController::class)
    ->parameters([
        'trabajadores' => 'trabajador',
    ]);


// =========================================================
// CONTRATOS
// =========================================================

Route::get(
    'trabajadores/{trabajador}/contratos/create',
    [ContratoController::class, 'create']
)->name('trabajadores.contratos.create');

Route::post(
    'trabajadores/{trabajador}/contratos',
    [ContratoController::class, 'store']
)->name('trabajadores.contratos.store');


// =========================================================
// MODIFICACIONES CONTRACTUALES
// =========================================================

Route::get(
    'trabajadores/{trabajador}/contratos/{contrato}/modificaciones/create',
    [ModificacionContratoController::class, 'create']
)->name('trabajadores.contratos.modificaciones.create');

Route::post(
    'trabajadores/{trabajador}/contratos/{contrato}/modificaciones',
    [ModificacionContratoController::class, 'store']
)->name('trabajadores.contratos.modificaciones.store');


// =========================================================
// REMUNERACIONES
// =========================================================

Route::get(
    'trabajadores/{trabajador}/remuneraciones/create',
    [RemuneracionController::class, 'create']
)->name('trabajadores.remuneraciones.create');

Route::post(
    'trabajadores/{trabajador}/remuneraciones',
    [RemuneracionController::class, 'store']
)->name('trabajadores.remuneraciones.store');


// =========================================================
// HORARIOS
// =========================================================

Route::get(
    'trabajadores/{trabajador}/horarios/create',
    [HorarioController::class, 'create']
)->name('trabajadores.horarios.create');

Route::post(
    'trabajadores/{trabajador}/horarios',
    [HorarioController::class, 'store']
)->name('trabajadores.horarios.store');

Route::get(
    'trabajadores/{trabajador}/horarios/{horario}/edit',
    [HorarioController::class, 'edit']
)->name('trabajadores.horarios.edit');

Route::put(
    'trabajadores/{trabajador}/horarios/{horario}',
    [HorarioController::class, 'update']
)->name('trabajadores.horarios.update');

Route::delete(
    'trabajadores/{trabajador}/horarios/{horario}',
    [HorarioController::class, 'destroy']
)->name('trabajadores.horarios.destroy');


// =========================================================
// DOCUMENTOS
// =========================================================

Route::resource('documentos', DocumentoController::class)
    ->parameters([
        'documentos' => 'documento',
    ]);