<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index(): View
    {
        $usuarios = User::with('roles')
            ->orderBy('name')
            ->get();

        return view('usuarios.index', compact('usuarios'));
    }

    public function create(): View
    {
        $roles = Role::orderBy('name')->get();

        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
            'rol' => [
                'required',
                'string',
                'exists:roles,name',
            ],
            'activo' => [
                'nullable',
                'boolean',
            ],
        ]);

        $usuario = User::create([
            'name' => $datos['name'],
            'email' => $datos['email'],
            'password' => Hash::make($datos['password']),
            'activo' => $request->boolean('activo'),
        ]);

        $usuario->syncRoles([
            $datos['rol'],
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with(
                'success',
                'Usuario creado correctamente.'
            );
    }

    public function edit(User $usuario): View
    {
        $roles = Role::orderBy('name')->get();

        return view(
            'usuarios.edit',
            compact('usuario', 'roles')
        );
    }

    public function update(
        Request $request,
        User $usuario
    ): RedirectResponse {
        $datos = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($usuario->id),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
            'rol' => [
                'required',
                'string',
                'exists:roles,name',
            ],
            'activo' => [
                'nullable',
                'boolean',
            ],
        ]);

        $usuario->name = $datos['name'];
        $usuario->email = $datos['email'];
        $usuario->activo = $request->boolean('activo');

        if (! empty($datos['password'])) {
            $usuario->password =
                Hash::make($datos['password']);
        }

        $usuario->save();

        $usuario->syncRoles([
            $datos['rol'],
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with(
                'success',
                'Usuario actualizado correctamente.'
            );
    }

    public function cambiarEstado(
        User $usuario
    ): RedirectResponse {
        if (
            auth()->id() === $usuario->id &&
            $usuario->activo
        ) {
            return redirect()
                ->route('usuarios.index')
                ->with(
                    'error',
                    'No puedes desactivar tu propio usuario.'
                );
        }

        $usuario->activo = ! $usuario->activo;
        $usuario->save();

        $mensaje = $usuario->activo
            ? 'Usuario activado correctamente.'
            : 'Usuario desactivado correctamente.';

        return redirect()
            ->route('usuarios.index')
            ->with('success', $mensaje);
    }
}