@extends('layouts.app')

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
                    <div class="card-header">{{ __('Bienvenido') }}</div>
                    <div class="card-body">
                        <h3>{{ __('Perfil de Usuario') }}</h3>
                        <p class="mb-0"><strong>{{ __('Rut:') }}</strong> {{ $user->formatedRut() }}</p>
                        <p class="mb-0"><strong>{{ __('Nombre:') }}</strong> {{ $user->name }}</p>
                        <p class="mb-0"><strong>{{ __('Email:') }}</strong> {{ $user->email }}</p>
                        <p class="mb-0"><strong>{{ __('Perfil:') }}</strong> {{ $user->perfil->nombre }}</p>
                        <p class="mb-0"><strong>Usuario desde: </strong>
                            {{ $user->created_at->format('d/m/Y H:i') }}
                        </p>
                        @if ($user->email_verified_at)
                            <p class="mb-0"><strong>{{ __('Email verificado el:') }}</strong>
                                {{ $user->email_verified_at->format('d/m/Y H:i') }}
                            </p>
                        @else
                            <div class="alert alert-danger mt-4" role="alert">
                                <p class="mb-0"><strong>
                                        El correo electrónico no ha sido verificado.
                                    </strong></p>
                            </div>
                        @endif
                        <div class="mt-4">
                            <a href="{{ route('admin.users') }}" class="btn btn-secondary">{{ __('Volver') }}</a>
                            @if (Auth::user()->rut == $user->rut)
                                <a href="{{ route('perfil.editar') }}"
                                    class="btn btn-primary">{{ __('Editar tu perfil') }}</a>
                            @else
                                <a href="{{ route('admin.users.edit', $user) }}"
                                    class="btn btn-primary">{{ __('Editar perfil') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
