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
                            <form action="{{ route('perfil.password.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-3">
                                    <div class="col-md-6 col-12">
                                        <label for="rut">{{ __('Rut:') }}</label>
                                        <input type="text" name="rut" id="rut" value="{{ $user->rut }}"
                                            class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="name">{{ __('Nombre:') }}</label>
                                        <input type="text" name="name" id="name" value="{{ $user->name }}"
                                            class="form-control" readonly>

                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-12">
                                        <label for="password">{{ __('Nueva Contraseña:') }} *</label>
                                        <input type="password" name="password" id="password" value="{{ old('password') }}"
                                            class="form-control @error('password') is-invalid @enderror" autofocus
                                            placeholder="**********">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div id="passwordhelp" class="form-text">
                                            <ul>
                                                <li>Debe contener al menos 8 caracteres</li>
                                                <li>Debe contener al menos un número</li>
                                                <li>Debe contener al menos una letra minuscula</li>
                                                <li>Debe contener al menos una letra mayuscula</li>
                                                <li>
                                                    Debe contener al menos un caracter especial (por ejemplo: !, @, #, $, %,
                                                    ^,
                                                    &,)
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="password_confirmation">{{ __('Confirmar contraseña:') }} *</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            value="{{ old('password_confirmation') }}"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            placeholder="**********">
                                        @error('password_confirmation')
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
