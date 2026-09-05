<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\OperacionController;
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

Route::resource('documentos', DocumentoController::class)
    ->parameters([
        'documentos' => 'documento',
    ]);