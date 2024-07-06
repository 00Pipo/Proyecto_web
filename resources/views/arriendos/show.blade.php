@extends('layouts.app')

@section('title', 'Arriendo - ' . $arriendo->id)

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
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
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">{{ __('Arriendo') }}</div>
                    <div class="card-body">
                        <h3>{{ __('Datos del Arriendo') }}</h3>
                        <p class="mb-0"><strong>{{ __('ID:') }}</strong> {{ $arriendo->id }}</p>
                        <p class="mb-0"><strong>{{ __('Fecha de Inicio:') }}</strong> {{ $arriendo->fecha_inicio }}</p>
                        <p class="mb-0"><strong>{{ __('Fecha de Termino:') }}</strong> {{ $arriendo->fecha_termino }}</p>
                        <p class="mb-0"><strong>{{ __('Fecha de Entrega:') }}</strong>
                            {{ $arriendo->fecha_entrega ?? 'N/A' }}
                        </p>
                        <p class="mb-0"><strong>{{ __('Fecha de devolucion:') }}</strong>
                            {{ $arriendo->fecha_devolucion ?? 'Aun no se ha devuelto el vehiculo' }}
                        </p>

                        <strong>{{ __('Vehiculo:') }}</strong>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <ul class="mb-0">
                                    <li>Tipo: {{ $arriendo->vehiculo->tipo->nombre }}</li>
                                    <li>Marca: {{ $arriendo->vehiculo->marca }}</li>
                                    <li>Modelo: {{ $arriendo->vehiculo->modelo }}</li>
                                    <li>Estado: {{ $arriendo->vehiculo->estado }}</li>
                                    <li><a href="{{ route('vehiculos.show', $arriendo->vehiculo->id) }}"
                                            class="btn btn-sm btn-primary">ver mas detalles</a></li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6">
                                <ul class="mb-0">
                                    <li><strong>{{ __('Cliente:') }}</strong></li>
                                    <li>Nombre: {{ $arriendo->cliente->nombre }}</li>
                                    <li>Rut: {{ $arriendo->cliente->rut }}</li>
                                    <li>Correo: {{ $arriendo->cliente->correo }}</li>
                                    <li>Telefono: {{ $arriendo->cliente->telefono }}</li>
                                    <li><a href="{{ route('clientes.show', $arriendo->cliente->rut) }}"
                                            class="btn btn-sm btn-primary">ver cliente</a></li>
                                </ul>
                            </div>
                        </div>
                        <p class="mb-0"><strong>{{ __('Creado por:') }}</strong> {{ $arriendo->usuario->name }} -
                            {{ $arriendo->usuario->rut }}
                            @if (Auth::user()->isAdmin())
                                <a href="{{ route('admin.users.show', $arriendo->usuario->rut) }}"
                                    class="btn btn-sm btn-primary">ver usuario</a>
                            @endif
                        </p>
                        <p class="mb-0"><strong>{{ __('Total:') }}</strong> {{ $arriendo->valorFormated() }}</p>
                        <p class="mb-0"><strong>{{ __('Creado el:') }}</strong>
                            {{ $arriendo->created_at->format('d/m/Y H:i') }}
                        </p>
                        <p class="mb-0"><strong>{{ __('Actualizado el:') }}</strong>
                            {{ $arriendo->updated_at->format('d/m/Y H:i') }}
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('arriendos.index') }}" class="btn btn-secondary">{{ __('Volver') }}</a>
                            <a href="{{ route('arriendos.edit', $arriendo) }}"
                                class="btn btn-primary">{{ __('Editar') }}</a>
                            <form action="{{ route('arriendos.destroy', $arriendo) }}" method="POST"
                                style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ __('Eliminar') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card mb-3">
                    <div class="card-header">{{ __('Fotos de entrega') }}</div>
                    <div class="card-body" style="max-height: 35vh; overflow-y: scroll;">
                        <div class="row">
                            @php
                                if ($arriendo->fotos_entrega) {
                                    $fotos_entrega = explode(',', $arriendo->fotos_entrega);
                                } else {
                                    $fotos_entrega = [];
                                }
                            @endphp
                            @forelse ($fotos_entrega as $foto)
                                <div class="col-12 col-md-6 col-lg-4 mb-3">
                                    <div class="image-container">
                                        <input type="checkbox" name="selectedImages[]" value="{{ trim($foto) }}"
                                            class="form-check-input">
                                        <a href="{{ asset('storage/fotos_entrega/' . trim($foto)) }}" target="_blank">
                                            <img src="{{ asset('storage/fotos_entrega/' . trim($foto)) }}"
                                                class="img-fluid" alt="Foto de entrega">
                                        </a>

                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="mb-0">No hay fotos de entrega</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-success btn-sm">{{ __('Agregar Foto de Entrega') }}</a>
                        <a href="#" class="btn btn-danger btn-sm">{{ __('Eliminar Fotos de Entrega') }}</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Fotos de devolucion') }}</div>
                    <div class="card-body" style="max-height: 35vh; overflow-y: scroll;">
                        <div class="row">
                            @php
                                if ($arriendo->fotos_devolucion) {
                                    $fotos_devolucion = explode(',', $arriendo->fotos_devolucion);
                                } else {
                                    $fotos_devolucion = [];
                                }
                            @endphp
                            @forelse ($fotos_devolucion as $foto)
                                <div class="col-12 col-md-6 col-lg-4 mb-3">
                                    <a href="{{ asset('storage/fotos_devolucion/' . trim($foto)) }}" target="_blank">
                                        <img src="{{ asset('storage/fotos_devolucion/' . trim($foto)) }}" class="img-fluid"
                                            alt="Foto de devolucion">
                                    </a>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="mb-0">No hay fotos de entrega</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-success btn-sm">{{ __('Agregar Foto de Devolucion') }}</a>
                        <a href="#" class="btn btn-danger btn-sm">{{ __('Eliminar Fotos de Devolucion') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
