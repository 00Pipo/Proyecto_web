@extends('layouts.app')

@section('title', 'Vehiculos')

@section('content')
    <div class="container py-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Vehiculos') }}</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Marca / Modelo</th>
                                    <th scope="col">estado</th>
                                    <th scope="col">$ Arriendo</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($vehiculos as $vehiculo)
                                    <tr>
                                        <td>{{ $vehiculo->id }}</td>
                                        <td>{{ $vehiculo->tipo->nombre }}</td>
                                        <td>{{ $vehiculo->marca }} / {{ $vehiculo->modelo }}</td>
                                        <td>
                                            <div class="pills-container">
                                                @if ($vehiculo->estado === 'disponible')
                                                    <span class="badge bg-success">Disponible</span>
                                                @elseif ($vehiculo->estado === 'arrendado')
                                                    <span class="badge bg-warning text-dark">Arrendado</span>
                                                @elseif ($vehiculo->estado === 'en mantenimiento')
                                                    <span class="badge bg-info text-dark">Mantenimiento</span>
                                                @elseif ($vehiculo->estado === 'de baja')
                                                    <span class="badge bg-danger">De Baja</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $vehiculo->valorArriendoFormated() }}</td>
                                        <td>
                                            @if (Auth::user()->isAdmin())
                                                <a href="{{ route('vehiculos.show', $vehiculo) }}"
                                                    class="btn btn-secondary btn-sm">Detalles</a>
                                                <a href="{{ route('vehiculos.edit', $vehiculo) }}"
                                                    class="btn btn-primary btn-sm">Editar</a>
                                                <form action="{{ route('vehiculos.destroy', $vehiculo) }}" method="POST"
                                                    style="display: inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmDeleteModal{{ $vehiculo->id }}">Eliminar</button>
                                                    <div class="modal fade" id="confirmDeleteModal{{ $vehiculo->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="confirmDeleteModalLabel{{ $vehiculo->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="confirmDeleteModalLabel{{ $vehiculo->id }}">
                                                                        Confirmar Eliminación</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    ¿Estás seguro de que deseas eliminar este vehículo?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancelar</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Eliminar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            @else
                                                <a href="{{ route('vehiculos.show', $vehiculo) }}"
                                                    class="btn btn-secondary btn-sm">Detalles</a>
                                                <a href="{{ route('vehiculos.edit.estado', $vehiculo) }}"
                                                    class="btn btn-primary btn-sm">Cambiar Estado</a>
                                            @endif
                                        </td>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">
                                            No hay vehiculos para listar
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('vehiculos.create') }}" class="btn btn-success">Crear vehiculo</a>
                        @endif
                    </div>
                </div>
            </div>
        @endsection
