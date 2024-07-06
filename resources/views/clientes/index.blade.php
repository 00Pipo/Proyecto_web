@extends('layouts.app')

@section('title', 'Clientes')

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
                    <div class="card-header">{{ __('Clientes') }}</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Rut</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col">Arriendos</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td>{{ $cliente->rut }}</td>
                                        <td>{{ $cliente->nombre }}</td>
                                        <td>{{ $cliente->email }}</td>
                                        <td>{{ $cliente->telefono }}</td>
                                        <td>{{ $cliente->arriendos->count() }}</td>
                                        <td>
                                            <a href="{{ route('clientes.show', $cliente) }}"
                                                class="btn btn-secondary btn-sm">Detalles</a>
                                            <a href="{{ route('clientes.edit', $cliente) }}"
                                                class="btn btn-primary btn-sm">Editar</a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal{{ $cliente->rut }}">Eliminar</button>
                                            <div class="modal fade" id="confirmDeleteModal{{ $cliente->rut }}"
                                                tabindex="-1" aria-labelledby="confirmDeleteModalLabel{{ $cliente->rut }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="confirmDeleteModalLabel{{ $cliente->rut }}">Confirmar
                                                                Eliminación</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if ($cliente->arriendos->count() > 0)
                                                                <div class="alert alert-danger">
                                                                    No es posible eliminar este cliente. Primero debes
                                                                    eliminar los siguientes arriendos:
                                                                    <ul>
                                                                        @foreach ($cliente->arriendos as $arriendo)
                                                                            <li>{{ $arriendo->id }}
                                                                                {{ $arriendo->vehiculo->marca }} -
                                                                                {{ $arriendo->vehiculo->modelo }} |
                                                                                {{ $arriendo->fecha_inicio }} -
                                                                                {{ $arriendo->fecha_termino }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @else
                                                                ¿Estás seguro de que deseas eliminar este cliente?
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('clientes.destroy', $cliente) }}"
                                                                method="POST" style="display: inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    {{ $cliente->arriendos->count() > 0 ? 'disabled' : '' }}
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
                        <a href="{{ route('clientes.create') }}" class="btn btn-success">Crear Cliente</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
