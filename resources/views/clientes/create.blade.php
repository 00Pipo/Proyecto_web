@extends('layouts.app')

@section('title', 'Crear Cliente')

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
                    <div class="card-header">{{ __('Crear Cliente') }}</div>
                    <div class="card-body">
                        <form action="{{ route('clientes.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="rut" class="form-label @error('rut') is-invalid @enderror">Rut *</label>
                                <input type="text" placeholder="12345678-9"
                                    class="form-control @error('rut') is-invalid @enderror" id="rut" name="rut"
                                    value="{{ old('rut') }}">
                                @error('rut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="ruthelp" class="form-text">
                                    Ingrese su rut sin puntos y con guión. Ejemplo: 12345678-9
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label @error('nombre') is-invalid @enderror">Nombre
                                    *</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                    id="nombre" placeholder="Nombre y Apellido" name="nombre"
                                    value="{{ old('nombre') }}">
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label @error('email') is-invalid @enderror">Email
                                    *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="ejemplo@correo.com"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="telefono"
                                    class="form-label @error('telefono') is-invalid @enderror">Telefono</label>
                                <div class="input-group">
                                    <span class="input-group-text">+56</span>
                                    <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                                        id="telefono" name="telefono" value="{{ old('telefono') }}">
                                </div>
                                @error('telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="telefonoHelp" class="form-text">
                                    Ingrese su número de teléfono con 9 dígitos. Ejemplo: 912345678
                                </div>
                            </div>
                            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver</a>
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
