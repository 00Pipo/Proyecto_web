@extends('layouts.app')

@section('title', 'Editar Vehiculo')

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
        <div class="row justify-content-center">
            <div class="col-12 col
            -md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">{{ __('Editar Vehiculo') }}</div>
                    <div class="card-body">
                        <form action="{{ route('vehiculos.update', $vehiculo) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input hidden type="text" name="id" id="id" value="{{ $vehiculo->id }}">
                            <div class="mb-3">
                                <label for="tipo_id" class="form-label @error('tipo_id') is-invalid @enderror">Tipo</label>
                                <select name="tipo_id" id="tipo_id" class="form-select">
                                    @foreach ($tiposVehiculos as $tipoVehiculo)
                                        <option value="{{ $tipoVehiculo->id }}"
                                            {{ old('tipo_id', $vehiculo->tipo_id) == $tipoVehiculo->id ? 'selected' : '' }}>
                                            {{ $tipoVehiculo->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('tipo_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="marca" class="form-label">Marca</label>
                                <input type="text" class="form-control @error('marca') is-invalid @enderror"
                                    id="marca" name="marca" value="{{ old('marca', $vehiculo->marca) }}">
                                @error('marca')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="modelo" class="form-label">Modelo</label>
                                <input type="text" class="form-control @error('modelo') is-invalid @enderror"
                                    id="modelo" name="modelo" value="{{ old('modelo', $vehiculo->modelo) }}">
                                @error('modelo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="valor_arriendo"
                                    class="form-label
                                    @error('valor_arriendo') is-invalid @enderror">Valor
                                    Arriendo</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control @error('valor_arriendo') is-invalid @enderror"
                                        id="valor_arriendo" name="valor_arriendo"
                                        value="{{ old('valor_arriendo', $vehiculo->valor_arriendo_diario) }}">
                                </div>
                                @error('valor_arriendo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- estado --}}
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select name="estado" id="estado" class="form-select">
                                    <option value="disponible"
                                        {{ old('estado', $vehiculo->estado) === 'disponible' ? 'selected' : '' }}>
                                        Disponible</option>
                                    <option value="arrendado"
                                        {{ old('estado', $vehiculo->estado) === 'arrendado' ? 'selected' : '' }}>
                                        Arrendado</option>
                                    <option value="en mantenimiento"
                                        {{ old('estado', $vehiculo->estado) === 'en mantenimiento' ? 'selected' : '' }}>
                                        En mantenimiento</option>
                                    <option value="de baja"
                                        {{ old('estado', $vehiculo->estado) === 'de baja' ? 'selected' : '' }}>
                                        De baja</option>
                                </select>
                            </div>
                            <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Volver</a>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
