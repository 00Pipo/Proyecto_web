@extends('layouts.app')

@section('title', 'Detalles del Vehiculo ' . $vehiculo->id)

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
                    <div class="card-header">{{ __('Detalles del Vehiculo ' . $vehiculo->id) }}</div>
                    <div class="card-body">
                        <p class="mb-0"><strong>ID:</strong> {{ $vehiculo->id }}</p>
                        <p class="mb-0"><strong>Tipo:</strong> {{ $vehiculo->tipo->nombre }}</p>
                        <p class="mb-0"><strong>Marca:</strong> {{ $vehiculo->marca }}</p>
                        <p class="mb-0"><strong>Modelo:</strong> {{ $vehiculo->modelo }}</p>
                        <p class="mb-0"><strong>Valor arriendo:</strong>{{ $vehiculo->valorArriendoFormated() }}</p>
                        <p class="mb-0"><strong>Fecha de creación:</strong> {{ $vehiculo->created_at }}</p>
                        <p><strong>Fecha de actualización:</strong> {{ $vehiculo->updated_at }}</p>                  
                        <a href="{{ route('vehiculos.index') }}" class="btn btn-primary">Volver</a>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-success">Editar</a>
                            <form action="{{ route('vehiculos.destroy', $vehiculo) }}" method="POST"
                                style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
