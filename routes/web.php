<?php

use App\Http\Controllers\AusenciaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\CuadraturaController;
use App\Http\Controllers\DetalleVacacionController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EmpresaFactoringController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\FactoringController;
use App\Http\Controllers\FaltaController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\ModificacionContratoController;
use App\Http\Controllers\MoraController;
use App\Http\Controllers\NotaCreditoProveedorController;
use App\Http\Controllers\OperacionController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ProveedorBodegaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProveedorEjecutivoController;
use App\Http\Controllers\RemuneracionController;
use App\Http\Controllers\ServicioTransporteController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\TransportistaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VacacionController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'active'])->group(function () {

    // =========================================================
    // INICIO
    // =========================================================

    Route::get('/', function () {
        return view('inicio');
    })->name('inicio');


    // =========================================================
    // CLIENTES
    // =========================================================

    Route::resource('clientes', ClienteController::class)
        ->only(['index', 'show'])
        ->middleware('permission:ver clientes');

    Route::resource('clientes', ClienteController::class)
        ->only(['create', 'store'])
        ->middleware('permission:crear clientes');

    Route::resource('clientes', ClienteController::class)
        ->only(['edit', 'update'])
        ->middleware('permission:editar clientes');

    Route::resource('clientes', ClienteController::class)
        ->only(['destroy'])
        ->middleware('permission:eliminar clientes');


    // =========================================================
    // OPERACIONES
    // =========================================================

    Route::resource('operaciones', OperacionController::class)
        ->only(['index', 'show'])
        ->parameters([
            'operaciones' => 'operacion',
        ])
        ->middleware('permission:ver operaciones');

    Route::resource('operaciones', OperacionController::class)
        ->only(['create', 'store'])
        ->parameters([
            'operaciones' => 'operacion',
        ])
        ->middleware('permission:crear operaciones');

    Route::resource('operaciones', OperacionController::class)
        ->only(['edit', 'update'])
        ->parameters([
            'operaciones' => 'operacion',
        ])
        ->middleware('permission:editar operaciones');

    Route::resource('operaciones', OperacionController::class)
        ->only(['destroy'])
        ->parameters([
            'operaciones' => 'operacion',
        ])
        ->middleware('permission:eliminar operaciones');


    // =========================================================
    // DOCUMENTOS DE OPERACIONES
    // =========================================================

    Route::post(
        'operaciones/{operacion}/documentos',
        [OperacionController::class, 'storeDocumento']
    )
        ->name('operaciones.documentos.store')
        ->middleware('permission:crear documentos');

    Route::delete(
        'operaciones/{operacion}/documentos/{documento}',
        [OperacionController::class, 'destroyDocumento']
    )
        ->name('operaciones.documentos.destroy')
        ->middleware('permission:eliminar documentos');


    // =========================================================
    // ENTREGAS
    // =========================================================

    Route::resource('entregas', EntregaController::class)
        ->only(['index', 'show'])
        ->parameters([
            'entregas' => 'entrega',
        ])
        ->middleware('permission:ver entregas');

    Route::resource('entregas', EntregaController::class)
        ->only(['create', 'store'])
        ->parameters([
            'entregas' => 'entrega',
        ])
        ->middleware('permission:crear entregas');

    Route::resource('entregas', EntregaController::class)
        ->only(['edit', 'update'])
        ->parameters([
            'entregas' => 'entrega',
        ])
        ->middleware('permission:editar entregas');

    Route::resource('entregas', EntregaController::class)
        ->only(['destroy'])
        ->parameters([
            'entregas' => 'entrega',
        ])
        ->middleware('permission:eliminar entregas');


    // =========================================================
    // FACTURAS
    // =========================================================

    Route::resource('facturas', FacturaController::class)
        ->only(['index', 'show'])
        ->parameters([
            'facturas' => 'factura',
        ])
        ->middleware('permission:ver facturas');

    Route::resource('facturas', FacturaController::class)
        ->only(['create', 'store'])
        ->parameters([
            'facturas' => 'factura',
        ])
        ->middleware('permission:crear facturas');

    Route::resource('facturas', FacturaController::class)
        ->only(['edit', 'update'])
        ->parameters([
            'facturas' => 'factura',
        ])
        ->middleware('permission:editar facturas');

    Route::resource('facturas', FacturaController::class)
        ->only(['destroy'])
        ->parameters([
            'facturas' => 'factura',
        ])
        ->middleware('permission:eliminar facturas');


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
        ->only(['index', 'show'])
        ->parameters([
            'factorings' => 'factoring',
        ])
        ->middleware('permission:ver factoring');

    Route::resource('factorings', FactoringController::class)
        ->only(['create', 'store'])
        ->parameters([
            'factorings' => 'factoring',
        ])
        ->middleware('permission:crear factoring');

    Route::resource('factorings', FactoringController::class)
        ->only(['edit', 'update'])
        ->parameters([
            'factorings' => 'factoring',
        ])
        ->middleware('permission:editar factoring');

    Route::resource('factorings', FactoringController::class)
        ->only(['destroy'])
        ->parameters([
            'factorings' => 'factoring',
        ])
        ->middleware('permission:eliminar factoring');


    // =========================================================
    // MORAS
    // =========================================================

    Route::resource('moras', MoraController::class)
        ->only(['index', 'show'])
        ->parameters([
            'moras' => 'mora',
        ])
        ->middleware('permission:ver moras');

    Route::resource('moras', MoraController::class)
        ->only(['create', 'store'])
        ->parameters([
            'moras' => 'mora',
        ])
        ->middleware('permission:crear moras');

    Route::resource('moras', MoraController::class)
        ->only(['edit', 'update'])
        ->parameters([
            'moras' => 'mora',
        ])
        ->middleware('permission:editar moras');

    Route::resource('moras', MoraController::class)
        ->only(['destroy'])
        ->parameters([
            'moras' => 'mora',
        ])
        ->middleware('permission:eliminar moras');


    // =========================================================
    // GASTOS
    // =========================================================

    Route::resource('gastos', GastoController::class)
        ->only(['index', 'show'])
        ->parameters([
            'gastos' => 'gasto',
        ])
        ->middleware('permission:ver gastos');

    Route::resource('gastos', GastoController::class)
        ->only(['create', 'store'])
        ->parameters([
            'gastos' => 'gasto',
        ])
        ->middleware('permission:crear gastos');

    Route::resource('gastos', GastoController::class)
        ->only(['edit', 'update'])
        ->parameters([
            'gastos' => 'gasto',
        ])
        ->middleware('permission:editar gastos');

    Route::resource('gastos', GastoController::class)
        ->only(['destroy'])
        ->parameters([
            'gastos' => 'gasto',
        ])
        ->middleware('permission:eliminar gastos');


    // =========================================================
// TRABAJADORES
// =========================================================

Route::resource('trabajadores', TrabajadorController::class)
    ->only(['index', 'show'])
    ->parameters([
        'trabajadores' => 'trabajador',
    ])
    ->middleware('permission:ver trabajadores');

Route::resource('trabajadores', TrabajadorController::class)
    ->only(['create', 'store'])
    ->parameters([
        'trabajadores' => 'trabajador',
    ])
    ->middleware('permission:crear trabajadores');

Route::resource('trabajadores', TrabajadorController::class)
    ->only(['edit', 'update'])
    ->parameters([
        'trabajadores' => 'trabajador',
    ])
    ->middleware('permission:editar trabajadores');

Route::resource('trabajadores', TrabajadorController::class)
    ->only(['destroy'])
    ->parameters([
        'trabajadores' => 'trabajador',
    ])
    ->middleware('permission:eliminar trabajadores');

        // =========================================================
    // CONTRATOS
    // =========================================================

    Route::get(
        'trabajadores/{trabajador}/contratos/create',
        [ContratoController::class, 'create']
    )
        ->name('trabajadores.contratos.create')
        ->middleware('permission:crear contratos');

    Route::post(
        'trabajadores/{trabajador}/contratos',
        [ContratoController::class, 'store']
    )
        ->name('trabajadores.contratos.store')
        ->middleware('permission:crear contratos');


    // =========================================================
    // MODIFICACIONES CONTRACTUALES
    // =========================================================

    Route::get(
        'trabajadores/{trabajador}/contratos/{contrato}/modificaciones/create',
        [ModificacionContratoController::class, 'create']
    )
        ->name('trabajadores.contratos.modificaciones.create')
        ->middleware('permission:editar contratos');

    Route::post(
        'trabajadores/{trabajador}/contratos/{contrato}/modificaciones',
        [ModificacionContratoController::class, 'store']
    )
        ->name('trabajadores.contratos.modificaciones.store')
        ->middleware('permission:editar contratos');
   
       // =========================================================
    // REMUNERACIONES
    // =========================================================

    Route::get(
        'trabajadores/{trabajador}/remuneraciones/create',
        [RemuneracionController::class, 'create']
    )
        ->name('trabajadores.remuneraciones.create')
        ->middleware('permission:crear remuneraciones');

    Route::post(
        'trabajadores/{trabajador}/remuneraciones',
        [RemuneracionController::class, 'store']
    )
        ->name('trabajadores.remuneraciones.store')
        ->middleware('permission:crear remuneraciones');

    Route::get(
        'trabajadores/{trabajador}/remuneraciones/{remuneracion}/edit',
        [RemuneracionController::class, 'edit']
    )
        ->name('trabajadores.remuneraciones.edit')
        ->middleware('permission:editar remuneraciones');

    Route::put(
        'trabajadores/{trabajador}/remuneraciones/{remuneracion}',
        [RemuneracionController::class, 'update']
    )
        ->name('trabajadores.remuneraciones.update')
        ->middleware('permission:editar remuneraciones');

    Route::delete(
        'trabajadores/{trabajador}/remuneraciones/{remuneracion}',
        [RemuneracionController::class, 'destroy']
    )
        ->name('trabajadores.remuneraciones.destroy')
        ->middleware('permission:eliminar remuneraciones');

       // =========================================================
    // HORARIOS
    // =========================================================

    Route::get(
        'trabajadores/{trabajador}/horarios/create',
        [HorarioController::class, 'create']
    )
        ->name('trabajadores.horarios.create')
        ->middleware('permission:crear horarios');

    Route::post(
        'trabajadores/{trabajador}/horarios',
        [HorarioController::class, 'store']
    )
        ->name('trabajadores.horarios.store')
        ->middleware('permission:crear horarios');

    Route::get(
        'trabajadores/{trabajador}/horarios/{horario}/edit',
        [HorarioController::class, 'edit']
    )
        ->name('trabajadores.horarios.edit')
        ->middleware('permission:editar horarios');

    Route::put(
        'trabajadores/{trabajador}/horarios/{horario}',
        [HorarioController::class, 'update']
    )
        ->name('trabajadores.horarios.update')
        ->middleware('permission:editar horarios');

    Route::delete(
        'trabajadores/{trabajador}/horarios/{horario}',
        [HorarioController::class, 'destroy']
    )
        ->name('trabajadores.horarios.destroy')
        ->middleware('permission:eliminar horarios');
        // =========================================================
    // VACACIONES
    // =========================================================

    Route::get(
        'trabajadores/{trabajador}/vacaciones/create',
        [VacacionController::class, 'create']
    )
        ->name('trabajadores.vacaciones.create')
        ->middleware('permission:crear vacaciones');

    Route::post(
        'trabajadores/{trabajador}/vacaciones',
        [VacacionController::class, 'store']
    )
        ->name('trabajadores.vacaciones.store')
        ->middleware('permission:crear vacaciones');

    Route::get(
        'trabajadores/{trabajador}/vacaciones/{vacacion}/edit',
        [VacacionController::class, 'edit']
    )
        ->name('trabajadores.vacaciones.edit')
        ->middleware('permission:editar vacaciones');

    Route::put(
        'trabajadores/{trabajador}/vacaciones/{vacacion}',
        [VacacionController::class, 'update']
    )
        ->name('trabajadores.vacaciones.update')
        ->middleware('permission:editar vacaciones');

    Route::delete(
        'trabajadores/{trabajador}/vacaciones/{vacacion}',
        [VacacionController::class, 'destroy']
    )
        ->name('trabajadores.vacaciones.destroy')
        ->middleware('permission:eliminar vacaciones');


    // =========================================================
    // DETALLES DE VACACIONES
    // =========================================================

    Route::get(
        'trabajadores/{trabajador}/vacaciones/{vacacion}/detalles/create',
        [DetalleVacacionController::class, 'create']
    )
        ->name('trabajadores.vacaciones.detalles.create')
        ->middleware('permission:editar vacaciones');

    Route::post(
        'trabajadores/{trabajador}/vacaciones/{vacacion}/detalles',
        [DetalleVacacionController::class, 'store']
    )
        ->name('trabajadores.vacaciones.detalles.store')
        ->middleware('permission:editar vacaciones');

    Route::get(
        'trabajadores/{trabajador}/vacaciones/{vacacion}/detalles/{detalleVacacion}/edit',
        [DetalleVacacionController::class, 'edit']
    )
        ->name('trabajadores.vacaciones.detalles.edit')
        ->middleware('permission:editar vacaciones');

    Route::put(
        'trabajadores/{trabajador}/vacaciones/{vacacion}/detalles/{detalleVacacion}',
        [DetalleVacacionController::class, 'update']
    )
        ->name('trabajadores.vacaciones.detalles.update')
        ->middleware('permission:editar vacaciones');

    Route::delete(
        'trabajadores/{trabajador}/vacaciones/{vacacion}/detalles/{detalleVacacion}',
        [DetalleVacacionController::class, 'destroy']
    )
        ->name('trabajadores.vacaciones.detalles.destroy')
        ->middleware('permission:eliminar vacaciones');
    
   // =========================================================
// PERMISOS
// =========================================================

Route::get(
    'trabajadores/{trabajador}/permisos/create',
    [PermisoController::class, 'create']
)
    ->name('trabajadores.permisos.create')
    ->middleware('permission:crear permisos laborales');

Route::post(
    'trabajadores/{trabajador}/permisos',
    [PermisoController::class, 'store']
)
    ->name('trabajadores.permisos.store')
    ->middleware('permission:crear permisos laborales');

Route::get(
    'trabajadores/{trabajador}/permisos/{permiso}/edit',
    [PermisoController::class, 'edit']
)
    ->name('trabajadores.permisos.edit')
    ->middleware('permission:editar permisos laborales');

Route::put(
    'trabajadores/{trabajador}/permisos/{permiso}',
    [PermisoController::class, 'update']
)
    ->name('trabajadores.permisos.update')
    ->middleware('permission:editar permisos laborales');

Route::delete(
    'trabajadores/{trabajador}/permisos/{permiso}',
    [PermisoController::class, 'destroy']
)
    ->name('trabajadores.permisos.destroy')
    ->middleware('permission:eliminar permisos laborales');

    // =========================================================
// AUSENCIAS
// =========================================================

Route::get(
    'trabajadores/{trabajador}/ausencias/create',
    [AusenciaController::class, 'create']
)
    ->name('trabajadores.ausencias.create')
    ->middleware('permission:crear ausencias');

Route::post(
    'trabajadores/{trabajador}/ausencias',
    [AusenciaController::class, 'store']
)
    ->name('trabajadores.ausencias.store')
    ->middleware('permission:crear ausencias');

Route::get(
    'trabajadores/{trabajador}/ausencias/{ausencia}/edit',
    [AusenciaController::class, 'edit']
)
    ->name('trabajadores.ausencias.edit')
    ->middleware('permission:editar ausencias');

Route::put(
    'trabajadores/{trabajador}/ausencias/{ausencia}',
    [AusenciaController::class, 'update']
)
    ->name('trabajadores.ausencias.update')
    ->middleware('permission:editar ausencias');

Route::delete(
    'trabajadores/{trabajador}/ausencias/{ausencia}',
    [AusenciaController::class, 'destroy']
)
    ->name('trabajadores.ausencias.destroy')
    ->middleware('permission:eliminar ausencias');
    // =========================================================
    // FALTAS
    // =========================================================

    Route::get(
        'trabajadores/{trabajador}/faltas/create',
        [FaltaController::class, 'create']
    )->name('trabajadores.faltas.create');

    Route::post(
        'trabajadores/{trabajador}/faltas',
        [FaltaController::class, 'store']
    )->name('trabajadores.faltas.store');

    Route::get(
        'trabajadores/{trabajador}/faltas/{falta}/edit',
        [FaltaController::class, 'edit']
    )->name('trabajadores.faltas.edit');

    Route::put(
        'trabajadores/{trabajador}/faltas/{falta}',
        [FaltaController::class, 'update']
    )->name('trabajadores.faltas.update');

    Route::delete(
        'trabajadores/{trabajador}/faltas/{falta}',
        [FaltaController::class, 'destroy']
    )->name('trabajadores.faltas.destroy');


    // =========================================================
    // CUADRATURAS
    // =========================================================

    Route::get(
        'trabajadores/{trabajador}/cuadraturas/create',
        [CuadraturaController::class, 'create']
    )->name('trabajadores.cuadraturas.create');

    Route::post(
        'trabajadores/{trabajador}/cuadraturas',
        [CuadraturaController::class, 'store']
    )->name('trabajadores.cuadraturas.store');

    Route::get(
        'trabajadores/{trabajador}/cuadraturas/{cuadratura}/edit',
        [CuadraturaController::class, 'edit']
    )->name('trabajadores.cuadraturas.edit');

    Route::put(
        'trabajadores/{trabajador}/cuadraturas/{cuadratura}',
        [CuadraturaController::class, 'update']
    )->name('trabajadores.cuadraturas.update');

    Route::delete(
        'trabajadores/{trabajador}/cuadraturas/{cuadratura}',
        [CuadraturaController::class, 'destroy']
    )->name('trabajadores.cuadraturas.destroy');


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


    // =========================================================
    // USUARIOS
    // =========================================================

    Route::middleware('role:Administrador')->group(function () {

        Route::get(
            'usuarios',
            [UsuarioController::class, 'index']
        )->name('usuarios.index');

        Route::get(
            'usuarios/create',
            [UsuarioController::class, 'create']
        )->name('usuarios.create');

        Route::post(
            'usuarios',
            [UsuarioController::class, 'store']
        )->name('usuarios.store');

        Route::get(
            'usuarios/{usuario}/edit',
            [UsuarioController::class, 'edit']
        )->name('usuarios.edit');

        Route::put(
            'usuarios/{usuario}',
            [UsuarioController::class, 'update']
        )->name('usuarios.update');

        Route::patch(
            'usuarios/{usuario}/estado',
            [UsuarioController::class, 'cambiarEstado']
        )->name('usuarios.estado');

    });

});


require __DIR__.'/auth.php';


// =========================================================
// RUTA NO ENCONTRADA
// =========================================================

Route::fallback(function () {

    if (auth()->check()) {
        return redirect()->route('inicio');
    }

    return redirect()->route('login');
});