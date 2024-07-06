@extends('layouts.app')

@section('title', 'cambiar estado Vehiculo')

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
                        <form action="{{ route('vehiculos.update.estado', $vehiculo) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input hidden type="text" name="id" id="id" value="{{ $vehiculo->id }}">
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
