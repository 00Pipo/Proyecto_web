@extends('layouts.app')

@section('title', 'Editar Tipo' . $tipo->nombre)

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
        -md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">{{ __('Editar Tipo ' . $tipo->nombre) }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tiposVehiculos.update', $tipo) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                    id="nombre" name="nombre" value="{{ old('nombre', $tipo->nombre) }}" required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <a class="btn btn-secondary" href="{{ route('tiposVehiculos.index') }}">Volver</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
