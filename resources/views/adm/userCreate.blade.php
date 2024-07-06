@extends('layouts.app')

@section('title', 'Crear Usuario')

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
                    <div class="card-header">{{ __('Crear Usuario') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.users.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="rut" class="form-label">{{ __('Rut') }}</label>
                                <input type="text" class="form-control @error('rut') is-invalid @enderror" id="rut"
                                    name="rut" value="{{ old('rut') }}" required>
                                @error('rut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="perfil" class="form-label">{{ __('Perfil') }}</label>
                                <select class="form-select @error('perfil') is-invalid @enderror" id="perfil"
                                    name="perfil" required>
                                    <option value="">Seleccione un perfil</option>
                                    @foreach ($perfiles as $perfil)
                                        <option value="{{ $perfil->id }}">{{ $perfil->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('perfil')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="
                                password"
                                    class="form-label">{{ __('Contraseña') }}</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation"
                                    class="form-label">{{ __('Confirmar Contraseña') }}</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>
                            <a href="{{ route('admin.users') }}" class="btn btn-secondary">{{ __('Cancelar') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Crear Usuario') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
