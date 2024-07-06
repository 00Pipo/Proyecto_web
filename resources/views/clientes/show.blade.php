@extends('layouts.app')

@section('title', 'Detalles del Cliente ' . $cliente->nombre)

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
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-header">{{ __('Detalles del Cliente ' . $cliente->nombre) }}</div>
                    <div class="card-body">
                        <p class="mb-0"><strong>Rut:</strong> {{ $cliente->rut }}</p>
                        <p class="mb-0"><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
                        <p class="mb-0"><strong>Email:</strong> {{ $cliente->email }}</p>
                        <p class="mb-0"><strong>Telefono:</strong> {{ $cliente->telefono }}</p>
                        <p class="mb-0"><strong>Arriendos:</strong> {{ $cliente->arriendos->count() }}</p>
                        <p class="mb-0"><strong>Fecha de creación:</strong> {{ $cliente->created_at }}</p>
                        <p><strong>Fecha de actualización:</strong> {{ $cliente->updated_at }}</p>

                        <a href="{{ route('clientes.index') }}" class="btn btn-primary">Volver</a>
                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-success">Editar</a>
                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST"
                            style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Arriendos') }}</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Vehiculo</th>
                                    <th scope="col">Fecha Inicio</th>
                                    <th scope="col">Fecha Termino</th>
                                    <th scope="col">Fecha Entrega</th>
                                    <th scope="col">Valor Total</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cliente->arriendos as $arriendo)
                                    <tr>
                                        <td>{{ $arriendo->id }}</td>
                                        <td>{{ $arriendo->vehiculo->marca }} {{ $arriendo->vehiculo->modelo }}</td>
                                        <td>{{ $arriendo->fecha_inicio }}</td>
                                        <td>{{ $arriendo->fecha_termino }}</td>
                                        <td>
                                            @if ($arriendo->fecha_entrega)
                                                {{ $arriendo->fecha_entrega }}
                                            @else
                                                <form action="#" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Entregar</button>
                                                </form>
                                            @endif
                                        <td>{{ $arriendo->valorFormated() }}</td>
                                        <td>
                                            <a href="{{ route('arriendos.show', $arriendo) }}"
                                                class="btn btn-secondary btn-sm">Detalles</a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
