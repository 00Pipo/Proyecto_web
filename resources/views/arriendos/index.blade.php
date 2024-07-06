@extends('layouts.app')

@section('title', 'Listado de Arriendo de Vehiculos')

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
                    <div class="card-header">{{ __('Listado de Arriendo de Vehiculos') }}</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Vehiculo</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Fecha Inicio</th>
                                    <th scope="col">Fecha Termino</th>
                                    <th scope="col">Fecha Entrega</th>
                                    <th scope="col">Valor Total</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($arriendos as $arriendo)
                                    <tr>
                                        <td>{{ $arriendo->id }}</td>
                                        <td>{{ $arriendo->vehiculo->marca }} {{ $arriendo->vehiculo->modelo }}</td>
                                        <td>{{ $arriendo->cliente->nombre }}</td>
                                        <td>{{ $arriendo->fecha_inicio }}</td>
                                        <td>{{ $arriendo->fecha_termino }}</td>
                                        <td>{{ $arriendo->fecha_entrega ?? 'N/A' }}</td>
                                        <td>{{ $arriendo->valorFormated() }}</td>
                                        <td>
                                            <a href="{{ route('arriendos.show', $arriendo) }}"
                                                class="btn btn-secondary btn-sm">Detalles</a>
                                            <a href="{{ route('arriendos.edit', $arriendo) }}"
                                                class="btn btn-primary btn-sm">Editar</a>
                                            <form action="{{ route('arriendos.destroy', $arriendo) }}" method="POST"
                                                style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal{{ $arriendo->id }}">Eliminar</button>
                                                <div class="modal fade" id="confirmDeleteModal{{ $arriendo->id }}"
                                                    tabindex="-1"
                                                    aria-labelledby="confirmDeleteModalLabel{{ $arriendo->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="confirmDeleteModalLabel{{ $arriendo->id }}">
                                                                    Confirmar Eliminación</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ¿Estás seguro de que deseas eliminar este arriendo?
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
                                        </td>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('arriendos.create') }}" class="btn btn-success">Arrendar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
