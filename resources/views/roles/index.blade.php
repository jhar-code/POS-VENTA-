@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <h2>Lista de Roles</h2>
            <hr>
            <br>
            <a href="{{ route('roles.create') }}" class="btn btn-primary">Nuevo Rol</a>
            @php
                $colors = ['primary', 'success', 'danger', 'warning', 'info', 'dark'];
            @endphp

            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Permisos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        @php $color = $colors[$role->id % count($colors)]; @endphp
                        <tr>
                            <td><span class="badge badge-{{ $color }}">{{ $role->name }}</span></td>
                            <td>
                                @foreach ($role->permissions as $permission)
                                    <span class="badge badge-{{ $color }}">{{ $permission->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar este rol?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
