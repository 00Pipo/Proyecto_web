@extends('layouts.app')

@section('title', 'editar perfil')

@section('content')
    <div class="container">
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Bienvenido') }}</div>
                    <div class="card-body">
                        <div class="container">
                            <h3>{{ __('Perfil de Usuario') }}</h3>
                            <small class="text-muted">{{ __('Los campos con * son requeridos') }}</small>
                            <form action="{{ route('perfil.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-3">
                                    <div class="col-md-6 col-12">
                                        <label for="rut">{{ __('Rut*:') }}</label>
                                        <input type="text" name="rut" id="rut" value="{{ $user->rut }}"
                                            class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="name">{{ __('Nombre*:') }}</label>
                                        <input type="text" name="name" id="name"
                                            value="{{ old('name', $user->name) }}"
                                            class="form-control @error('name') is-invalid @enderror" autofocus
                                            placeholder="{{ __('Ingrese su nombre') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-12">
                                        <label for="email">{{ __('Email*:') }}</label>
                                        <input type="email" name="email" id="email"
                                            value="{{ old('email', $user->email) }}"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="{{ __('Ingrese su email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a href="{{ route('perfil') }}" class="btn btn-secondary">{{ __('Cancelar') }}</a>
                                        <button type="submit" class="btn btn-primary">{{ __('Guardar cambios') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
