<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permisos = [
            // Dashboard
            'ver dashboard',

            // Clientes
            'ver clientes',
            'crear clientes',
            'editar clientes',
            'eliminar clientes',

            // Operaciones
            'ver operaciones',
            'crear operaciones',
            'editar operaciones',
            'eliminar operaciones',

            // Entregas
            'ver entregas',
            'crear entregas',
            'editar entregas',
            'eliminar entregas',

            // Facturas
            'ver facturas',
            'crear facturas',
            'editar facturas',
            'eliminar facturas',

            // Factoring
            'ver factoring',
            'crear factoring',
            'editar factoring',
            'eliminar factoring',

            // Moras
            'ver moras',
            'crear moras',
            'editar moras',
            'eliminar moras',

            // Gastos
            'ver gastos',
            'crear gastos',
            'editar gastos',
            'eliminar gastos',

            // Proveedores
            'ver proveedores',
            'crear proveedores',
            'editar proveedores',
            'eliminar proveedores',

            // Notas de crédito de proveedores
            'ver notas credito proveedores',
            'crear notas credito proveedores',
            'editar notas credito proveedores',
            'eliminar notas credito proveedores',

            // Transportistas
            'ver transportistas',
            'crear transportistas',
            'editar transportistas',
            'eliminar transportistas',

            // Vehículos
            'ver vehiculos',
            'crear vehiculos',
            'editar vehiculos',
            'eliminar vehiculos',

            // Servicios de transporte
            'ver servicios transporte',
            'crear servicios transporte',
            'editar servicios transporte',
            'eliminar servicios transporte',

            // Trabajadores
            'ver trabajadores',
            'crear trabajadores',
            'editar trabajadores',
            'eliminar trabajadores',

            // Contratos
            'ver contratos',
            'crear contratos',
            'editar contratos',
            'eliminar contratos',

            // Horarios
            'ver horarios',
            'crear horarios',
            'editar horarios',
            'eliminar horarios',

            // Remuneraciones
            'ver remuneraciones',
            'crear remuneraciones',
            'editar remuneraciones',
            'eliminar remuneraciones',

            // Vacaciones
            'ver vacaciones',
            'crear vacaciones',
            'editar vacaciones',
            'eliminar vacaciones',

            // Ausencias
            'ver ausencias',
            'crear ausencias',
            'editar ausencias',
            'eliminar ausencias',

            // Permisos laborales
            'ver permisos laborales',
            'crear permisos laborales',
            'editar permisos laborales',
            'eliminar permisos laborales',

            // Faltas
            'ver faltas',
            'crear faltas',
            'editar faltas',
            'eliminar faltas',

            // Cuadraturas
            'ver cuadraturas',
            'crear cuadraturas',
            'editar cuadraturas',
            'eliminar cuadraturas',

            // Documentos
            'ver documentos',
            'crear documentos',
            'editar documentos',
            'eliminar documentos',

            // Reclamos
            'ver reclamos',
            'crear reclamos',
            'editar reclamos',
            'eliminar reclamos',

            // Juicios
            'ver juicios',
            'crear juicios',
            'editar juicios',
            'eliminar juicios',

            // Contratos de suministro
            'ver contratos suministro',
            'crear contratos suministro',
            'editar contratos suministro',
            'eliminar contratos suministro',

            // Configuración
            'ver usuarios',
            'crear usuarios',
            'editar usuarios',
            'desactivar usuarios',

            'ver roles',
            'asignar roles',
            'asignar permisos',
        ];

        foreach ($permisos as $permiso) {
            Permission::findOrCreate($permiso, 'web');
        }

        $administrador = Role::findOrCreate('Administrador', 'web');
        $editor = Role::findOrCreate('Editor', 'web');
        $visualizador = Role::findOrCreate('Visualizador', 'web');

        $administrador->syncPermissions(
            Permission::all()
        );

        $editor->syncPermissions([
            'ver dashboard',

            'ver clientes',
            'crear clientes',
            'editar clientes',

            'ver operaciones',
            'crear operaciones',
            'editar operaciones',

            'ver entregas',
            'crear entregas',
            'editar entregas',

            'ver facturas',
            'crear facturas',
            'editar facturas',

            'ver factoring',
            'crear factoring',
            'editar factoring',

            'ver moras',
            'crear moras',
            'editar moras',

            'ver gastos',
            'crear gastos',
            'editar gastos',

            'ver proveedores',
            'crear proveedores',
            'editar proveedores',

            'ver notas credito proveedores',
            'crear notas credito proveedores',
            'editar notas credito proveedores',

            'ver transportistas',
            'crear transportistas',
            'editar transportistas',

            'ver vehiculos',
            'crear vehiculos',
            'editar vehiculos',

            'ver servicios transporte',
            'crear servicios transporte',
            'editar servicios transporte',

            'ver trabajadores',
            'crear trabajadores',
            'editar trabajadores',

            'ver contratos',
            'crear contratos',
            'editar contratos',

            'ver horarios',
            'crear horarios',
            'editar horarios',

            'ver remuneraciones',
            'crear remuneraciones',
            'editar remuneraciones',

            'ver vacaciones',
            'crear vacaciones',
            'editar vacaciones',

            'ver ausencias',
            'crear ausencias',
            'editar ausencias',

            'ver permisos laborales',
            'crear permisos laborales',
            'editar permisos laborales',

            'ver faltas',
            'crear faltas',
            'editar faltas',

            'ver cuadraturas',
            'crear cuadraturas',
            'editar cuadraturas',

            'ver documentos',
            'crear documentos',
            'editar documentos',

            'ver reclamos',
            'crear reclamos',
            'editar reclamos',

            'ver juicios',
            'crear juicios',
            'editar juicios',

            'ver contratos suministro',
            'crear contratos suministro',
            'editar contratos suministro',
        ]);

        $visualizador->syncPermissions([
            'ver dashboard',
            'ver clientes',
            'ver operaciones',
            'ver entregas',
            'ver facturas',
            'ver factoring',
            'ver moras',
            'ver gastos',
            'ver proveedores',
            'ver notas credito proveedores',
            'ver transportistas',
            'ver vehiculos',
            'ver servicios transporte',
            'ver trabajadores',
            'ver contratos',
            'ver horarios',
            'ver remuneraciones',
            'ver vacaciones',
            'ver ausencias',
            'ver permisos laborales',
            'ver faltas',
            'ver cuadraturas',
            'ver documentos',
            'ver reclamos',
            'ver juicios',
            'ver contratos suministro',
        ]);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}