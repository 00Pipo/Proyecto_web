@extends('layouts.app')

@section('title', 'Editar Arriendo - ' . $arriendo->id)

@section('content')
    <div class="container py-4">
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
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">{{ __('Editar Arriendo') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('arriendos.update', $arriendo) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="fecha_inicio" class="form-label">{{ __('Fecha de Inicio') }}</label>
                                <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror"
                                    id="fecha_inicio" name="fecha_inicio"
                                    value="{{ old('fecha_inicio', $arriendo->fecha_inicio) }}" required>
                                @error('fecha_inicio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="fecha_termino"
                                    class="form-label
                                    ">{{ __('Fecha de Termino') }}</label>
                                <input type="date" class="form-control @error('fecha_termino') is-invalid @enderror"
                                    id="fecha_termino" name="fecha_termino"
                                    value="{{ old('fecha_termino', $arriendo->fecha_termino) }}" required>
                                @error('fecha_termino')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="fecha_entrega"
                                    class="form-label
                                    ">{{ __('Fecha de Entrega') }}</label>
                                <input type="datetime-local"
                                    class="form-control @error('fecha_entrega') is-invalid @enderror" id="fecha_entrega"
                                    name="fecha_entrega" value="{{ old('fecha_entrega', $arriendo->fecha_entrega) }}"
                                    required>
                                @error('fecha_entrega')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="fecha_devolucion"
                                    class="form-label
                                    ">{{ __('Fecha de Devolucion') }}</label>
                                <input type="datetime-local"
                                    class="form-control @error('fecha_devolucion') is-invalid @enderror"
                                    id="fecha_devolucion" name="fecha_devolucion"
                                    value="{{ old('fecha_devolucion', $arriendo->fecha_devolucion) }}" required>
                                @error('fecha_devolucion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="vehiculo_id"
                                    class="form-label
                                    ">{{ __('Vehiculo') }}</label>
                                <select class="form-select @error('vehiculo_id') is-invalid @enderror" id="vehiculo_id"
                                    name="vehiculo_id" required>
                                    <option value="">Seleccione un vehiculo</option>
                                    @foreach ($vehiculos as $vehiculo)
                                        <option value="{{ $vehiculo->id }}"
                                            @if ($vehiculo->id == old('vehiculo_id', $arriendo->vehiculo_id)) selected @endif>
                                            {{ $vehiculo->marca }} {{ $vehiculo->modelo }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('vehiculo_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="cliente_id"
                                    class="form-label
                                    ">{{ __('Cliente') }}</label>
                                <select class="form-select @error('cliente_id') is-invalid @enderror" id="cliente_id"
                                    name="cliente_id" required>
                                    <option value="">Seleccione un cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}"
                                            @if ($cliente->id == old('cliente_id', $arriendo->cliente_id)) selected @endif>
                                            {{ $cliente->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cliente_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="total" class="form-label">{{ __('Total') }}</label>
                                <input type="number" class="form-control @error('total') is-invalid @enderror"
                                    id="total" name="total" value="{{ old('total', $arriendo->valor_total) }}"
                                    required>
                                @error('total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <a href="{{ route('arriendos.show', $arriendo) }}"
                                class="btn btn-secondary">{{ __('Cancelar') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Actualizar Arriendo') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
