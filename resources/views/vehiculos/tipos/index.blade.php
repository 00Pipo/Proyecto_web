@extends('layouts.app')

@section('title', 'Tipos de Vehiculos')

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
            <div class="col-12 col
        -md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tipos de Vehiculos') }}</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre tipo</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tiposVehiculos as $tipoVehiculo)
                                    <tr>
                                        <td>{{ $tipoVehiculo->id }}</td>
                                        <td>{{ $tipoVehiculo->nombre }}</td>
                                        <td>
                                            <a href="{{ route('tiposVehiculos.show', $tipoVehiculo) }}"
                                                class="btn btn-secondary btn-sm">Detalles</a>
                                            <a href="{{ route('tiposVehiculos.edit', $tipoVehiculo) }}"
                                                class="btn btn-primary btn-sm">Editar</a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal{{ $tipoVehiculo->id }}">Eliminar</button>
                                            <div class="modal fade" id="confirmDeleteModal{{ $tipoVehiculo->id }}"
                                                tabindex="-1"
                                                aria-labelledby="confirmDeleteModalLabel{{ $tipoVehiculo->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="confirmDeleteModalLabel{{ $tipoVehiculo->id }}">
                                                                Confirmar Eliminación</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if ($tipoVehiculo->vehiculos->count() > 0)
                                                                <div class="alert alert-danger">
                                                                    Este tipo de vehículo tiene vehículos asociados. No
                                                                    puedes eliminarlo.

                                                                    Por favor, elimina los vehículos asociados antes de
                                                                    eliminar este tipo de vehículo.

                                                                    vehículos asociados:
                                                                    <ul>
                                                                        @foreach ($tipoVehiculo->vehiculos as $vehiculo)
                                                                            <li>{{ $vehiculo->id }} -
                                                                                {{ $vehiculo->marca }}
                                                                                {{ $vehiculo->modelo }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @else
                                                                ¿Estás seguro de que deseas eliminar este tipo de vehículo?
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancelar</button>
                                                            <form
                                                                action="{{ route('tiposVehiculos.destroy', $tipoVehiculo) }}"
                                                                method="POST" style="display: inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    {{ $tipoVehiculo->vehiculos->count() > 0 ? 'disabled' : '' }}
                                                                    class="btn btn-danger">Eliminar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('tiposVehiculos.create') }}" class="btn btn-success">Crear tipo de vehiculo</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
