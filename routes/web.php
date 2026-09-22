<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\DetalleVacacionController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EmpresaFactoringController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\FactoringController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\ModificacionContratoController;
use App\Http\Controllers\MoraController;
use App\Http\Controllers\NotaCreditoProveedorController;
use App\Http\Controllers\OperacionController;
use App\Http\Controllers\ProveedorBodegaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProveedorEjecutivoController;
use App\Http\Controllers\RemuneracionController;
use App\Http\Controllers\ServicioTransporteController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\TransportistaController;
use App\Http\Controllers\VacacionController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;


// =========================================================
// INICIO
// =========================================================

Route::get('/', function () {
    return view('inicio');
})->name('inicio');


// =========================================================
// CLIENTES
// =========================================================

Route::resource('clientes', ClienteController::class);


// =========================================================
// OPERACIONES
// =========================================================

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


// =========================================================
// ENTREGAS
// =========================================================

Route::resource('entregas', EntregaController::class)
    ->parameters([
        'entregas' => 'entrega',
    ]);


// =========================================================
// FACTURAS
// =========================================================

Route::resource('facturas', FacturaController::class)
    ->parameters([
        'facturas' => 'factura',
    ]);


// =========================================================
// EMPRESAS DE FACTORING
// =========================================================

Route::resource(
    'empresas-factoring',
    EmpresaFactoringController::class
)->parameters([
    'empresas-factoring' => 'empresaFactoring',
]);


// =========================================================
// OPERACIONES DE FACTORING
// =========================================================

Route::resource('factorings', FactoringController::class)
    ->parameters([
        'factorings' => 'factoring',
    ]);


// =========================================================
// MORAS
// =========================================================

Route::resource('moras', MoraController::class)
    ->parameters([
        'moras' => 'mora',
    ]);


// =========================================================
// GASTOS
// =========================================================

Route::resource('gastos', GastoController::class)
    ->parameters([
        'gastos' => 'gasto',
    ]);


// =========================================================
// TRABAJADORES
// =========================================================

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
// VACACIONES
// =========================================================

Route::get(
    'trabajadores/{trabajador}/vacaciones/create',
    [VacacionController::class, 'create']
)->name('trabajadores.vacaciones.create');

Route::post(
    'trabajadores/{trabajador}/vacaciones',
    [VacacionController::class, 'store']
)->name('trabajadores.vacaciones.store');

Route::get(
    'trabajadores/{trabajador}/vacaciones/{vacacion}/edit',
    [VacacionController::class, 'edit']
)->name('trabajadores.vacaciones.edit');

Route::put(
    'trabajadores/{trabajador}/vacaciones/{vacacion}',
    [VacacionController::class, 'update']
)->name('trabajadores.vacaciones.update');

Route::delete(
    'trabajadores/{trabajador}/vacaciones/{vacacion}',
    [VacacionController::class, 'destroy']
)->name('trabajadores.vacaciones.destroy');


// =========================================================
// DETALLES DE VACACIONES
// =========================================================

Route::get(
    'trabajadores/{trabajador}/vacaciones/{vacacion}/detalles/create',
    [DetalleVacacionController::class, 'create']
)->name('trabajadores.vacaciones.detalles.create');

Route::post(
    'trabajadores/{trabajador}/vacaciones/{vacacion}/detalles',
    [DetalleVacacionController::class, 'store']
)->name('trabajadores.vacaciones.detalles.store');

Route::get(
    'trabajadores/{trabajador}/vacaciones/{vacacion}/detalles/{detalleVacacion}/edit',
    [DetalleVacacionController::class, 'edit']
)->name('trabajadores.vacaciones.detalles.edit');

Route::put(
    'trabajadores/{trabajador}/vacaciones/{vacacion}/detalles/{detalleVacacion}',
    [DetalleVacacionController::class, 'update']
)->name('trabajadores.vacaciones.detalles.update');

Route::delete(
    'trabajadores/{trabajador}/vacaciones/{vacacion}/detalles/{detalleVacacion}',
    [DetalleVacacionController::class, 'destroy']
)->name('trabajadores.vacaciones.detalles.destroy');


// =========================================================
// PROVEEDORES
// =========================================================

Route::resource('proveedores', ProveedorController::class)
    ->parameters([
        'proveedores' => 'proveedor',
    ]);


// =========================================================
// BODEGAS DE PROVEEDORES
// =========================================================

Route::get(
    'proveedores/{proveedor}/bodegas/create',
    [ProveedorBodegaController::class, 'create']
)->name('proveedores.bodegas.create');

Route::post(
    'proveedores/{proveedor}/bodegas',
    [ProveedorBodegaController::class, 'store']
)->name('proveedores.bodegas.store');

Route::get(
    'proveedores/{proveedor}/bodegas/{bodega}/edit',
    [ProveedorBodegaController::class, 'edit']
)->name('proveedores.bodegas.edit');

Route::put(
    'proveedores/{proveedor}/bodegas/{bodega}',
    [ProveedorBodegaController::class, 'update']
)->name('proveedores.bodegas.update');

Route::delete(
    'proveedores/{proveedor}/bodegas/{bodega}',
    [ProveedorBodegaController::class, 'destroy']
)->name('proveedores.bodegas.destroy');


// =========================================================
// EJECUTIVOS DE PROVEEDORES
// =========================================================

Route::get(
    'proveedores/{proveedor}/ejecutivos/create',
    [ProveedorEjecutivoController::class, 'create']
)->name('proveedores.ejecutivos.create');

Route::post(
    'proveedores/{proveedor}/ejecutivos',
    [ProveedorEjecutivoController::class, 'store']
)->name('proveedores.ejecutivos.store');

Route::get(
    'proveedores/{proveedor}/ejecutivos/{ejecutivo}/edit',
    [ProveedorEjecutivoController::class, 'edit']
)->name('proveedores.ejecutivos.edit');

Route::put(
    'proveedores/{proveedor}/ejecutivos/{ejecutivo}',
    [ProveedorEjecutivoController::class, 'update']
)->name('proveedores.ejecutivos.update');

Route::delete(
    'proveedores/{proveedor}/ejecutivos/{ejecutivo}',
    [ProveedorEjecutivoController::class, 'destroy']
)->name('proveedores.ejecutivos.destroy');


// =========================================================
// NOTAS DE CRÉDITO DE PROVEEDORES
// =========================================================

Route::resource(
    'notas-credito-proveedores',
    NotaCreditoProveedorController::class
)->parameters([
    'notas-credito-proveedores' => 'notaCreditoProveedor',
]);


// =========================================================
// TRANSPORTISTAS
// =========================================================

Route::resource('transportistas', TransportistaController::class)
    ->parameters([
        'transportistas' => 'transportista',
    ]);


// =========================================================
// VEHÍCULOS
// =========================================================

Route::resource('vehiculos', VehiculoController::class)
    ->parameters([
        'vehiculos' => 'vehiculo',
    ]);


// =========================================================
// SERVICIOS DE TRANSPORTE
// =========================================================

Route::resource(
    'servicios-transporte',
    ServicioTransporteController::class
)->parameters([
    'servicios-transporte' => 'servicioTransporte',
]);


// =========================================================
// DOCUMENTOS
// =========================================================

Route::resource('documentos', DocumentoController::class)
    ->parameters([
        'documentos' => 'documento',
    ]);